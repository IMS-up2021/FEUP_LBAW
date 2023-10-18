-- Drop the tables if they exist
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Action CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS Post CASCADE;
DROP TABLE IF EXISTS Moderator CASCADE;
DROP TABLE IF EXISTS Admin CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Tag CASCADE;

-- We modified the table "User" to "Users", otherwise PostgreSQL gives an error
CREATE TABLE Users (
    id SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL UNIQUE,
    email VARCHAR NOT NULL UNIQUE,
    password VARCHAR NOT NULL,
    description VARCHAR,
    profile_picture VARCHAR
);

-- Create the Admin table 
CREATE TABLE Admin (
    admin_id INTEGER PRIMARY KEY,
    FOREIGN KEY (admin_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Create the Moderator table
CREATE TABLE Moderator (
    moderator_id INTEGER PRIMARY KEY,
    FOREIGN KEY (moderator_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Create the Tag table
CREATE TABLE Tag (
    id SERIAL PRIMARY KEY,
    tagName VARCHAR NOT NULL UNIQUE
);

-- Create the Post table 
CREATE TABLE Post (
    post_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES Tag(id) ON DELETE CASCADE,
    title VARCHAR NOT NULL,
    content VARCHAR NOT NULL,
    status VARCHAR NOT NULL CHECK (status IN ('open', 'closed')),
    score INTEGER NOT NULL DEFAULT 0,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- Create the Comment table
CREATE TABLE Comment (
    comment_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    post_id INTEGER NOT NULL REFERENCES Post(post_id) ON DELETE CASCADE,
    content VARCHAR NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    score INTEGER NOT NULL DEFAULT 0
);

-- Create the Notification table 
CREATE TABLE Notification (
    notification_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE, 
    post_id INTEGER REFERENCES Post(post_id) ON DELETE CASCADE, -- Pode ser NOT NULL?
    comment_id INTEGER REFERENCES Comment(comment_id) ON DELETE CASCADE,
    type VARCHAR NOT NULL CHECK (type IN ('comment', 'post'))
);

-- Create the Action table
CREATE TABLE Action (
    action_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES Users(id) ON DELETE CASCADE,
    post_id INTEGER REFERENCES Post(post_id) ON DELETE CASCADE,
    comment_id INTEGER REFERENCES Comment(comment_id) ON DELETE CASCADE,
    tag_id INTEGER REFERENCES Tag(id) ON DELETE CASCADE,
    action VARCHAR NOT NULL, 
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
