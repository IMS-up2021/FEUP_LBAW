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
    remember_token VARCHAR,
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
    tag_name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE publication (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE SET NULL,
    tag_id INTEGER REFERENCES tag(id) ON DELETE SET NULL,
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


--------------POPULATE----------------

INSERT INTO users VALUES (
  1000,
  'John Doe',
  'admin@gmail.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  'Description'
); -- 

INSERT INTO users VALUES (
  2000,
  'Sarah Doe',
  'admin2@gmail.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  'Description'
); -- 

INSERT INTO users VALUES (
  3000,
  'Admin',
  'real_admin@gmail.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  'Description'
); -- 

INSERT INTO admin VALUES (
  3000
); 

INSERT INTO tag (id, tag_name) VALUES
  (1000, 'Technology'),
  (1001, 'Programming'),
  (1002, 'Travel'),
  (1003, 'Food'),
  (1004, 'Music');

-- User 1 publications
INSERT INTO publication (id,user_id, tag_id, content, date) VALUES
  (1000, 1000, 1000, 'Exploring the latest trends in technology.', CURRENT_TIMESTAMP),
  (1001, 1000, 1001, 'Coding tips for beginners.', CURRENT_TIMESTAMP),
  (1002, 1000, 1002, 'My recent travel adventures.', CURRENT_TIMESTAMP),
  (1003, 1000, 1003, 'Delicious food discoveries.', CURRENT_TIMESTAMP),
  (1004, 1000, 1004, 'The impact of music on our lives.', CURRENT_TIMESTAMP);

-- User 2 publications
INSERT INTO publication (id,user_id, tag_id, content, date) VALUES
  (1005, 2000, 1000, 'Reviewing the newest tech gadgets.', CURRENT_TIMESTAMP),
  (1006, 2000, 1001, 'Advanced programming techniques.', CURRENT_TIMESTAMP),
  (1007, 2000, 1002, 'A journey to unexplored destinations.', CURRENT_TIMESTAMP),
  (1008, 2000, 1003, 'Cooking experiences from around the world.', CURRENT_TIMESTAMP),
  (1009, 2000, 1004, 'The intersection of music and culture.', CURRENT_TIMESTAMP),
  (1010, 2000, 1004, 'Comentário Teste', CURRENT_TIMESTAMP);

-- Questions and Answers
INSERT INTO question_or_answer (question_answer_id, score) VALUES
  (1000, 10), -- Assuming question_answer_id 1 corresponds to the first publication
  (1001, 5),
  (1002, 8),
  (1003, 2),
  (1004, 15),
  (1005, 7),
  (1006, 12),
  (1007, 3),
  (1008, 9),
  (1009, 11);

-- Questions
INSERT INTO question (question_id, title, status) VALUES
  (1000, 'How can technology shape our future?', 'open'),
  (1001, 'Best practices for coding in 2023?', 'closed'),
  (1002, 'Share your favorite travel destination.', 'open'),
  (1003, 'What''s your go-to dish to cook at home?', 'closed'),
  (1004, 'How does music influence your daily life?', 'open');
-- Answers
INSERT INTO answer (answer_id, question_id) VALUES
  (1005, 1000),
  (1006, 1001),
  (1007, 1002),
  (1008, 1003),
  (1009, 1004);

-- Comments
INSERT INTO comment (comment_id, question_answer_id) VALUES
  (1010,1004)