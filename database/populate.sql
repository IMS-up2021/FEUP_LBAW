DELETE FROM Users;
DELETE FROM Owner;
DELETE FROM Publication;
DELETE FROM QuestionOrAnswer;
DELETE FROM Question;
DELETE FROM Answer;
DELETE FROM Comment;
DELETE FROM Notification;
DELETE FROM QuestionNotif;
DELETE FROM AnswerNotif;
DELETE FROM TagNotif;
DELETE FROM Tag;
DELETE FROM Subscription;
DELETE FROM Bannings;
DELETE FROM Reviews;

-- Insert sample data into the Users table (with email as username + @example.com)
INSERT INTO Users (id, username, email, password, description, profile_picture)
VALUES
    (1, 'JohnAppeased', 'johnappeased@example.com', 'password123', 'John is a software developer with a passion for coding.', NULL),
    (2, 'AliceSmith', 'alicesmith@example.com', 'password456', 'Alice is an artist who loves painting and sculpting.', NULL),
    (3, 'RobertJohnson', 'robertjohnson@example.com', 'password789', 'Robert is a scientist exploring the mysteries of the universe.', NULL),
    (4, 'EmmaBrown', 'emmabrown@example.com', 'password987', 'Emma is a travel enthusiast and a food blogger.', NULL),
    (5, 'WilliamClark', 'williamclark@example.com', 'password654', 'William is a fitness coach and nutrition expert.', NULL),
    (6, 'OliviaAnderson', 'oliviaanderson@example.com', 'password321', 'Olivia is a musician with a passion for playing the piano.', NULL),
    (7, 'SophiaWhite', 'sophiawhite@example.com', 'password654', 'Sophia is a veterinarian who adores animals.', NULL),
    (8, 'LiamHarris', 'liamharris@example.com', 'password123', 'Liam is an avid hiker and nature enthusiast.', NULL),
    (9, 'CharlotteDavis', 'charlottedavis@example.com', 'password987', 'Charlotte is a bookworm and literature lover.', NULL),
    (10, 'JamesMiller', 'jamesmiller@example.com', 'password456', 'James is a chef specializing in international cuisine.', NULL),
    (11, 'OliverMoore', 'olivermoore@example.com', 'password789', 'Oliver is a tech enthusiast and gadget collector.', NULL),
    (12, 'IsabellaMartin', 'isabellamartin@example.com', 'password123', 'Isabella is a fashion designer and trendsetter.', NULL),
    (13, 'EthanTaylor', 'ethantaylor@example.com', 'password654', 'Ethan is a dedicated teacher inspiring young minds.', NULL),
    (14, 'AvaAnderson', 'avaanderson@example.com', 'password987', 'Ava is a movie critic and a cinema aficionado.', NULL),
    (15, 'MiaSmith', 'miasmith@example.com', 'password456', 'Mia is an environmental activist and nature lover.', NULL),
    (16, 'WilliamJohnson', 'williamjohnson@example.com', 'password789', 'William is a photographer capturing life''s moments.', NULL),
    (17, 'SophiaDavis', 'sophiadavis@example.com', 'password123', 'Sophia is a yoga instructor promoting wellness.', NULL),
    (18, 'MichaelBrown', 'michaelbrown@example.com', 'password654', 'Michael is a journalist reporting on global events.', NULL),
    (19, 'EmmaMoore', 'emmamoore@example.com', 'password987', 'Emma is a technology blogger and early adopter.', NULL),
    (20, 'OliviaWilson', 'oliviawilson@example.com', 'password123', 'Olivia is a biologist researching marine life.', NULL),
    (21, 'LucasThomas', 'lucasthomas@example.com', 'password456', 'Lucas is a software engineer with a knack for innovation.', NULL),
    (22, 'AvaWalker', 'avawalker@example.com', 'password789', 'Ava is a travel vlogger exploring the world.', NULL),
    (23, 'SophiaKing', 'sophiaking@example.com', 'password654', 'Sophia is a fitness trainer promoting a healthy lifestyle.', NULL),
    (24, 'OliverWright', 'oliverwright@example.com', 'password321', 'Oliver is an architect designing sustainable buildings.', NULL),
    (25, 'EllaRobinson', 'ellarobinson@example.com', 'password123', 'Ella is a singer-songwriter with a soulful voice.', NULL);

INSERT INTO Owner (owner_id)
VALUES
    (1),
    (2),
    (3),
    (4),
    (5),
    (6),
    (7),
    (8),
    (9),
    (10),
    (11),
    (12),
    (13),
    (14),
    (15),
    (16),
    (17),
    (18),
    (19),
    (20),
    (21),
    (22),
    (23),
    (24),
    (25);

-- Sample data for Publications (mix of questions, answers, and comments)
INSERT INTO Publication (id, owner_id, content, date)
VALUES
    (1, 1, 'What are the best practices for software development?', CURRENT_DATE),
    (2, 2, 'I think following SOLID principles is key.', CURRENT_DATE - 1),
    (3, 3, 'Einstein''s theory of relativity is fascinating!', CURRENT_DATE - 2),
    (4, 4, 'I love sushi, especially in Tokyo!', CURRENT_DATE - 3),
    (5, 5, 'I recommend starting with a 30-minute workout.', CURRENT_DATE - 4),
    (6, 6, 'Olivia''s piano concert was amazing.', CURRENT_DATE - 5),
    (7, 7, 'I have a cute cat named Whiskers.', CURRENT_DATE - 6),
    (8, 8, 'The Rockies have stunning hiking trails.', CURRENT_DATE - 7),
    (9, 9, 'What classic novels do you enjoy reading?', CURRENT_DATE - 8),
    (10, 10, 'Here''s my lasagna recipe.', CURRENT_DATE - 9),
    (11, 11, 'I''m excited about the new iPhone release.', CURRENT_DATE - 10),
    (12, 12, 'Check out the latest fashion trends!', CURRENT_DATE - 11),
    (13, 13, 'A student shared a touching story in class today.', CURRENT_DATE - 12),
    (14, 14, 'I loved that movie; highly recommended!', CURRENT_DATE - 13),
    (15, 15, 'Let''s protect the environment together.', CURRENT_DATE - 14),
    (16, 16, 'Photography is my passion.', CURRENT_DATE - 15),
    (17, 17, 'Yoga and mindfulness promote well-being.', CURRENT_DATE - 16),
    (18, 18, 'Breaking news: Major event in the world!', CURRENT_DATE - 17),
    (19, 19, 'Tech enthusiasts, stay updated!', CURRENT_DATE - 18),
    (20, 20, 'Exploring marine life is fascinating.', CURRENT_DATE - 19),
    (21, 21, 'Innovations in software engineering are exciting.', CURRENT_DATE - 20),
    (22, 22, 'Ava''s travel vlog: Discover new places!', CURRENT_DATE - 21),
    (23, 23, 'Promote a healthier lifestyle with yoga.', CURRENT_DATE - 22),
    (24, 24, 'Sustainable architecture: A green future.', CURRENT_DATE - 23),
    (25, 25, 'Enjoy Ella''s soulful music.', CURRENT_DATE - 24);


-- Sample data for QuestionOrAnswer (mix of questions and answers)
INSERT INTO QuestionOrAnswer (questionAnswer_id, score)
VALUES
    (1, 12),  -- Question 1 with a score of 12
    (2, 8),   -- Answer to Question 1 with a score of 8
    (3, 5),   -- Question 3 with a score of 5
    (4, 10),  -- Answer to Question 3 with a score of 10
    (5, 3),   -- Question 4 with a score of 3
    (6, 15),  -- Answer to Question 4 with a score of 15
    (7, 7),   -- Question 6 with a score of 7
    (8, 11),  -- Answer to Question 6 with a score of 11
    (9, 9),   -- Question 9 with a score of 9
    (10, 6),  -- Answer to Question 9 with a score of 6
    (11, 4),  -- Question 11 with a score of 4
    (12, 14), -- Answer to Question 11 with a score of 14
    (13, 6),  -- Question 13 with a score of 6
    (14, 12), -- Answer to Question 13 with a score of 12
    (15, 8),  -- Question 15 with a score of 8
    (16, 10), -- Answer to Question 15 with a score of 10
    (17, 10), -- Question 17 with a score of 10
    (18, 7),  -- Answer to Question 17 with a score of 7
    (19, 12), -- Question 19 with a score of 12
    (20, 9),  -- Answer to Question 19 with a score of 9
    (21, 14), -- Question 21 with a score of 14
    (22, 11), -- Answer to Question 21 with a score of 11
    (23, 3),  -- Question 23 with a score of 3
    (24, 13), -- Answer to Question 23 with a score of 13
    (25, 5);  -- Question 25 with a score of 5
    

-- Sample data for Question (questions)
INSERT INTO Question (question_id, title, status)
VALUES
    (1, 'Best practices for software development?', 'open'),
    (2, 'Einstein''s theory of relativity?', 'open'),
    (3, 'How to start a 30-minute workout routine?', 'open'),
    (4, 'Olivia''s piano concert details?', 'open'),
    (5, 'Classic novels recommendations?', 'closed'),
    (6, 'Exciting features of the new iPhone?', 'open'),
    (7, 'Touching stories shared in class?', 'open'),
    (8, 'Movie recommendations?', 'closed'),
    (9, 'Hiking trails in the Rockies?', 'open'),
    (10, 'Latest tech developments?', 'open'),
    (11, 'Ava''s travel vlog: New places to explore?', 'open'),
    (12, 'Promoting a healthier lifestyle with yoga?', 'open');
    

-- Sample data for Answer (answers to questions)
INSERT INTO Answer (answer_id, question_id)
VALUES
    (2, 1),  -- Answer to Question 1
    (4, 2),  -- Answer to Question 3
    (6, 3),  -- Answer to Question 5
    (8, 4),  -- Answer to Question 6
    (10, 5), -- Answer to Question 9
    (12, 6),  -- Answer to Question 11
    (14, 7),  -- Answer to Question 13
    (16, 8),  -- Answer to Question 15
    (18, 9),  -- Answer to Question 17
    (20, 10),  -- Answer to Question 19
    (22, 11),  -- Answer to Question 21
    (24, 12); -- Answer to Question 23
    
INSERT INTO Comment (comment_id, questionAnswer_id)
VALUES
    (1, 2),  -- Comment on Answer 2
    (2, 2),  -- Another Comment on Answer 2
    (3, 4),  -- Comment on Answer 4
    (4, 8),  -- Comment on Answer 8
    (5, 10), -- Comment on Answer 10
    (6, 12), -- Comment on Answer 12
    (7, 16), -- Comment on Answer 16
    (8, 18), -- Comment on Answer 18
    (9, 20), -- Comment on Answer 20
    (10, 22), -- Comment on Answer 22
    (11, 24); -- Comment on Answer 24

-- Sample data for Notification
INSERT INTO Notification (id, user_id, description)
VALUES
    (1, 1, 'You have a new follower.'),
    (2, 2, 'Your question received a new answer.'),
    (3, 3, 'Your comment was upvoted.'),
    (4, 4, 'New updates in technology.'),
    (5, 5, 'Congratulations on your successful event.'),
    (6, 6, 'An interesting article on science.'),
    (7, 7, 'Your post received a comment.'),
    (8, 8, 'Important news: Stay informed.'),
    (9, 9, 'Your answer was marked as the best.'),
    (10, 10, 'A new tag was created.'),
    (11, 11, 'Announcing a giveaway!'),
    (12, 12, 'Your post was featured.'),
    (13, 13, 'Stay active and engaged.'),
    (14, 14, 'Upcoming travel destination recommendations.'),
    (15, 15, 'Join our fitness challenge!'),
    (16, 16, 'Discussion on art and creativity.'),
    (17, 17, 'Mindfulness and well-being tips.'),
    (18, 18, 'Breaking news: Major event in the world.'),
    (19, 19, 'Tech enthusiasts, stay updated.'),
    (20, 20, 'Exploring marine life is fascinating.'),
    (21, 21, 'Innovations in software engineering are exciting.'),
    (22, 22, 'Ava''s travel vlog: Discover new places.'),
    (23, 23, 'Promote a healthier lifestyle with yoga.'),
    (24, 24, 'Sustainable architecture: A green future.'),
    (25, 25, 'Enjoy Ella''s soulful music.');
    
-- Sample data for QuestionNotif
INSERT INTO QuestionNotif (notification_id, question_id)
VALUES
    (1, 1),    -- Notification 1 related to Question 1
    (2, 1),    -- Notification 2 related to Question 1
    (3, 4),    -- Notification 3 related to Question 4
    (4, 4),    -- Notification 4 related to Question 4
    (5, 6),    -- Notification 5 related to Question 6
    (6, 6),    -- Notification 6 related to Question 6
    (7, 9),    -- Notification 7 related to Question 9
    (8, 9),    -- Notification 8 related to Question 9
    (9, 12),   -- Notification 9 related to Question 13
    (10, 10),  -- Notification 10 related to Question 13
    (11, 7),  -- Notification 11 related to Question 15
    (12, 11);  -- Notification 12 related to Question 15


-- Sample data for AnswerNotif
INSERT INTO AnswerNotif (notification_id, answer_id)
VALUES
    (1, 2),   -- Notification 1 related to Answer 2
    (2, 4),   -- Notification 2 related to Answer 4
    (3, 6),   -- Notification 3 related to Answer 6
    (4, 8),   -- Notification 4 related to Answer 8
    (5, 10),  -- Notification 5 related to Answer 10
    (6, 12),  -- Notification 6 related to Answer 12
    (7, 14),  -- Notification 7 related to Answer 14
    (8, 16),  -- Notification 8 related to Answer 16
    (9, 18),  -- Notification 9 related to Answer 18
    (10, 20), -- Notification 10 related to Answer 20
    (11, 22), -- Notification 11 related to Answer 22
    (12, 24); -- Notification 12 related to Answer 24

-- Sample data for Tag
INSERT INTO Tag (id, tagName)
VALUES
    (1, 'programming'),
    (2, 'science'),
    (3, 'technology'),
    (4, 'music'),
    (5, 'fitness'),
    (6, 'travel'),
    (7, 'art'),
    (8, 'literature'),
    (9, 'health'),
    (10, 'movies'),
    (11, 'nature'),
    (12, 'cooking'),
    (13, 'history'),
    (14, 'mathematics'),
    (15, 'environment');

-- Sample data for TagNotif
INSERT INTO TagNotif (notification_id, tag_id)
VALUES
    (1, 1),   -- Notification 1 related to Tag 1
    (2, 3),   -- Notification 2 related to Tag 3
    (3, 5),   -- Notification 3 related to Tag 5
    (4, 7),   -- Notification 4 related to Tag 7
    (5, 9),   -- Notification 5 related to Tag 9
    (6, 11),  -- Notification 6 related to Tag 11
    (7, 13),  -- Notification 7 related to Tag 13
    (8, 15),  -- Notification 8 related to Tag 15
    (9, 2),   -- Notification 9 related to Tag 2
    (10, 4),  -- Notification 10 related to Tag 4
    (11, 6),  -- Notification 11 related to Tag 6
    (12, 8);  -- Notification 12 related to Tag 8

INSERT INTO Subscription (user_id, tag_id, date)
VALUES
    (1, 1, '2023-10-24'),
    (2, 3, '2023-10-25'),
    (3, 5, '2023-10-26'),
    (4, 7, '2023-10-27'),
    (5, 9, '2023-10-28'),
    (6, 11, '2023-10-29'),
    (7, 13, '2023-10-30'),
    (8, 15, '2023-10-31'),
    (9, 2, '2023-11-01'),
    (10, 4, '2023-11-02'),
    (11, 6, '2023-11-03'),
    (12, 8, '2023-11-04');

INSERT INTO Admin (admin_id)
VALUES
    (13),
    (14),
    (15),
    (16),
    (17),
    (18),
    (19),
    (20),
    (21),
    (22);

INSERT INTO Bannings (user_id, admin_id, date)
VALUES
    (1, 13, '2023-10-24'),
    (2, 14, '2023-10-25'),
    (3, 15, '2023-10-26'),
    (4, 16, '2023-10-27'),
    (5, 17, '2023-10-28'),
    (6, 18, '2023-10-29'),
    (7, 19, '2023-10-30'),
    (8, 20, '2023-10-31'),
    (9, 21, '2023-11-01'),
    (10, 22, '2023-11-02');

-- Sample data for Reviews
INSERT INTO Reviews (user_id, questionAnswer_id, positive, date)
VALUES
    (1, 2, true, '2023-10-24'),
    (2, 4, true, '2023-10-25'),
    (3, 6, true, '2023-10-26'),
    (4, 8, true, '2023-10-27'),
    (5, 10, true, '2023-10-28'),
    (6, 12, true, '2023-10-29'),
    (7, 14, true, '2023-10-30'),
    (8, 16, true, '2023-10-31'),
    (9, 18, true, '2023-11-01'),
    (10, 20, true, '2023-11-02');



    

