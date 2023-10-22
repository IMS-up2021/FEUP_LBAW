DROP TABLE IF EXISTS TagNotif CASCADE;
DROP TABLE IF EXISTS Tag CASCADE;
DROP TABLE IF EXISTS AnswerNotif CASCADE;
DROP TABLE IF EXISTS QuestionNotif CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS Answer CASCADE;
DROP TABLE IF EXISTS Question CASCADE;
DROP TABLE IF EXISTS QuestionOrAnswer CASCADE;
DROP TABLE IF EXISTS Publication CASCADE;
DROP TABLE IF EXISTS Admin CASCADE;
DROP TABLE IF EXISTS Moderator CASCADE;
DROP TABLE IF EXISTS Owner CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Subscription CASCADE;
DROP TABLE IF EXISTS Bannings CASCADE;
DROP TABLE IF EXISTS Reviews CASCADE;

-----------------------------------------
-- Domains
-----------------------------------------
DROP DOMAIN IF EXISTS TODAY;
DROP DOMAIN IF EXISTS STATUS;

CREATE DOMAIN TODAY AS DATE NOT NULL DEFAULT CURRENT_DATE;
CREATE DOMAIN STATUS AS VARCHAR(255) NOT NULL CHECK (VALUE IN ('open', 'closed')) DEFAULT 'open';

-----------------------------------------
-- Tables
-----------------------------------------

-- We modified the table "User" to "Users", otherwise PostgreSQL gives an error
CREATE TABLE Users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    description TEXT,
    profile_picture BYTEA
);

CREATE TABLE Owner (
    owner_id INTEGER PRIMARY KEY,
    FOREIGN KEY (owner_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Moderator (
    moderator_id INTEGER PRIMARY KEY,
    FOREIGN KEY (moderator_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Admin (
    admin_id INTEGER PRIMARY KEY,
    FOREIGN KEY (admin_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Publication (
    id SERIAL PRIMARY KEY,
    owner_id INTEGER REFERENCES Owner(owner_id) ON DELETE CASCADE,
    content TEXT NOT NULL,
    date TODAY
);

CREATE TABLE QuestionOrAnswer(
    questionAnswer_id INTEGER PRIMARY KEY,
    FOREIGN KEY (questionAnswer_id) REFERENCES Publication(id) ON DELETE CASCADE,
    score INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE Question(
    question_id INTEGER PRIMARY KEY,
    FOREIGN KEY (question_id) REFERENCES QuestionOrAnswer(questionAnswer_id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    status STATUS
);

CREATE TABLE Answer(
    answer_id INTEGER PRIMARY KEY,
    FOREIGN KEY (answer_id) REFERENCES QuestionOrAnswer(questionAnswer_id) ON DELETE CASCADE,
    question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
);

CREATE TABLE Comment(
    comment_id INTEGER PRIMARY KEY,
    FOREIGN KEY (comment_id) REFERENCES Publication(id) ON DELETE CASCADE,
    questionAnswer_id INTEGER NOT NULL REFERENCES QuestionOrAnswer(questionAnswer_id) ON DELETE CASCADE
);

CREATE TABLE Notification(
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    description TEXT NOT NULL
);

CREATE TABLE QuestionNotif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES Notification(id) ON DELETE CASCADE,
    question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
);

CREATE TABLE AnswerNotif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES Notification(id) ON DELETE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES Answer(answer_id) ON DELETE CASCADE
);

CREATE TABLE Tag (
    id SERIAL PRIMARY KEY,
    tagName VARCHAR NOT NULL UNIQUE
);

CREATE TABLE TagNotif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES Notification(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES Tag(id) ON DELETE CASCADE
);

CREATE TABLE Subscription(
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES Tag(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, tag_id),
    date TODAY
);

CREATE TABLE Bannings(
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    admin_id INTEGER NOT NULL REFERENCES Admin(admin_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, admin_id),
    date TODAY
);

CREATE TABLE Reviews(
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    questionAnswer_id INTEGER NOT NULL REFERENCES QuestionOrAnswer(questionAnswer_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, questionAnswer_id),
    positive BOOLEAN,
    date TODAY 
);
