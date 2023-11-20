DROP SCHEMA IF EXISTS lbaw23136 CASCADE;
CREATE SCHEMA lbaw23136;
SET search_path TO lbaw23136;

DROP TABLE IF EXISTS tag_notif CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS answer_notif CASCADE;
DROP TABLE IF EXISTS question_notif CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS answer CASCADE;
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS question_or_answer CASCADE;
DROP TABLE IF EXISTS publication CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS moderator CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS subscription CASCADE;
DROP TABLE IF EXISTS bannings CASCADE;
DROP TABLE IF EXISTS reviews CASCADE;

-----------------------------------------
-- Domains
-----------------------------------------
DROP DOMAIN IF EXISTS TODAY;
DROP DOMAIN IF EXISTS STATUS;

CREATE DOMAIN TODAY AS TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
CREATE DOMAIN STATUS AS VARCHAR(255) NOT NULL CHECK (VALUE IN ('open', 'closed')) DEFAULT 'open';

-----------------------------------------
-- Tables
-----------------------------------------

-- We modified the table "User" to "users", otherwise PostgreSQL gives an error
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    description TEXT,
    profile_picture BYTEA
);

CREATE TABLE moderator (
    moderator_id INTEGER PRIMARY KEY,
    FOREIGN KEY (moderator_id) REFERENCES users(id) ON DELETE CASCADE 
);

CREATE TABLE admin (
    admin_id INTEGER PRIMARY KEY,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tag (
    id SERIAL PRIMARY KEY,
    tagName VARCHAR NOT NULL UNIQUE
);

CREATE TABLE publication (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE,
    content TEXT NOT NULL,
    date TODAY
);

CREATE TABLE question_or_answer(
    question_answer_id INTEGER PRIMARY KEY,
    FOREIGN KEY (question_answer_id) REFERENCES publication(id) ON DELETE CASCADE,
    score INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE question(
    question_id INTEGER PRIMARY KEY,
    FOREIGN KEY (question_id) REFERENCES question_or_answer(question_answer_id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL CHECK (status IN ('open', 'closed')) DEFAULT 'open'
);

CREATE TABLE answer(
    answer_id INTEGER PRIMARY KEY,
    FOREIGN KEY (answer_id) REFERENCES question_or_answer(question_answer_id) ON DELETE CASCADE,
    question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
);

CREATE TABLE comment(
    comment_id INTEGER PRIMARY KEY,
    FOREIGN KEY (comment_id) REFERENCES publication(id) ON DELETE CASCADE,
    question_answer_id INTEGER NOT NULL REFERENCES question_or_answer(question_answer_id) ON DELETE CASCADE
);

CREATE TABLE notification(
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    description TEXT NOT NULL
);

CREATE TABLE question_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
);

CREATE TABLE answer_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer(answer_id) ON DELETE CASCADE
);

CREATE TABLE tag_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE
);  

CREATE TABLE subscription(
    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, tag_id),
    date TODAY
);

CREATE TABLE bannings(
    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    admin_id INTEGER NOT NULL REFERENCES admin(admin_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, admin_id),
    date TODAY
);

CREATE TABLE reviews(
    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    question_answer_id INTEGER NOT NULL REFERENCES question_or_answer(question_answer_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, question_answer_id),
    positive BOOLEAN,
    date TODAY 
);



-----------------------------------------
-- INDEXES
-----------------------------------------

CREATE INDEX user_notification ON notification USING btree (user_id);

CREATE INDEX score_index ON question_or_answer USING btree (score);

CREATE INDEX date_index ON publication USING btree (date);

-- FTS INDEXES

-- Add a column to store computed ts_vectors.
ALTER TABLE Question
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE OR REPLACE FUNCTION question_search_update() RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND NEW.title <> OLD.title) THEN
    NEW.tsvectors = to_tsvector('english', NEW.title);
  END IF;
  RETURN NEW;
END
$$ LANGUAGE plpgsql;

-- Create a trigger before insert or update on Question.
CREATE TRIGGER question_search_update
BEFORE INSERT OR UPDATE ON Question
FOR EACH ROW
EXECUTE PROCEDURE question_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX question_title_idx ON question USING GIN (tsvectors);


/*
-----------------------------------------
-- TRIGGERS 
-----------------------------------------
-- TRIGGER01 
-- Create a trigger to update the score of a question or answer after a review
CREATE OR REPLACE FUNCTION update_score_after_review() RETURNS TRIGGER AS $$
BEGIN
  IF NEW.positive = 1 THEN
    -- Increase the score by 1 if the review is positive
    UPDATE question_or_answer
    SET score = score + 1
    WHERE question_answer_id = NEW.question_or_answer_id;
  ELSIF NEW.positive = 0 THEN
    -- Decrease the score by 1 if the review is not positive
    UPDATE question_or_answer
    SET score = score - 1
    WHERE question_answer_id = NEW.question_or_answer_id;
  END IF;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Create a trigger to execute the update_score_after_review function
CREATE TRIGGER update_score_trigger
AFTER INSERT ON reviews
FOR EACH ROW
EXECUTE FUNCTION update_score_after_review();


-- TRIGGER02 
-- Create a trigger to insert a notification after a new publication
CREATE OR REPLACE FUNCTION trigger_notifications_function() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.user_id IS NOT NULL THEN
        -- Insert a notification of type 'answer_notif'
        INSERT INTO notification (user_id, description)
        VALUES (NEW.user_id, 'New answer or comment on your question.');
    END IF;
    
    IF NEW.question_answer_id IS NOT NULL THEN
        -- Insert a notification of type 'answer_notif'
        INSERT INTO notification (user_id, description)
        VALUES (NEW.user_id, 'New comment on your answer');
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_notifications
AFTER INSERT ON question_or_answer
FOR EACH ROW
EXECUTE FUNCTION trigger_notifications_function();
*/

INSERT INTO users VALUES (
  DEFAULT,
  'John Doe',
  'admin@gmail.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  'Description'
); -- 

CREATE TABLE cards (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL,
  user_id INTEGER REFERENCES users NOT NULL
);

CREATE TABLE items (
  id SERIAL PRIMARY KEY,
  card_id INTEGER NOT NULL REFERENCES cards ON DELETE CASCADE,
  description VARCHAR NOT NULL,
  done BOOLEAN NOT NULL DEFAULT FALSE
);


INSERT INTO cards VALUES (DEFAULT, 'Things to do', 1);
INSERT INTO items VALUES (DEFAULT, 1, 'Buy milk');
INSERT INTO items VALUES (DEFAULT, 1, 'Walk the dog', true);

INSERT INTO cards VALUES (DEFAULT, 'Things not to do', 1);
INSERT INTO items VALUES (DEFAULT, 2, 'Break a leg');
INSERT INTO items VALUES (DEFAULT, 2, 'Crash the car');

INSERT INTO tag VALUES (1, 'tag1');
INSERT INTO tag VALUES (2, 'tag2');