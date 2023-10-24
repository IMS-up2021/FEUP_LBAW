-- Insert sample data into the Users table
INSERT INTO Users (username, email, password, description, profile_picture)
VALUES
    ('JohnAppeased', 'john@example.com', 'password123', 'John is a software developer with a passion for coding.', NULL),
    ('AliceSmith', 'alice@example.com', 'password456', 'Alice is an artist who loves painting and sculpting.', NULL),
    ('RobertJohnson', 'robert@example.com', 'password789', 'Robert is a scientist exploring the mysteries of the universe.', NULL),
    ('EmmaBrown', 'emma@example.com', 'password987', 'Emma is a travel enthusiast and a food blogger.', NULL),
    ('WilliamClark', 'william@example.com', 'password654', 'William is a fitness coach and nutrition expert.', NULL),
    ('OliviaAnderson', 'olivia@example.com', 'password321', 'Olivia is a musician with a passion for playing the piano.', NULL),
    ('SophiaWhite', 'sophia@example.com', 'password654', 'Sophia is a veterinarian who adores animals.', NULL),
    ('LiamHarris', 'liam@example.com', 'password123', 'Liam is an avid hiker and nature enthusiast.', NULL),
    ('CharlotteDavis', 'charlotte@example.com', 'password987', 'Charlotte is a bookworm and literature lover.', NULL),
    ('JamesMiller', 'james@example.com', 'password456', 'James is a chef specializing in international cuisine.', NULL),
    ('OliverMoore', 'oliver@example.com', 'password789', 'Oliver is a tech enthusiast and gadget collector.', NULL),
    ('IsabellaMartin', 'isabella@example.com', 'password123', 'Isabella is a fashion designer and trendsetter.', NULL),
    ('EthanTaylor', 'ethan@example.com', 'password654', 'Ethan is a dedicated teacher inspiring young minds.', NULL),
    ('AvaAnderson', 'ava@example.com', 'password987', 'Ava is a movie critic and a cinema aficionado.', NULL),
    ('MiaSmith', 'mia@example.com', 'password456', 'Mia is an environmental activist and nature lover.', NULL),
    ('WilliamJohnson', 'william@example.com', 'password789', 'William is a photographer capturing life\'s moments.', NULL),
    ('SophiaDavis', 'sophia@example.com', 'password123', 'Sophia is a yoga instructor promoting wellness.', NULL),
    ('MichaelBrown', 'michael@example.com', 'password654', 'Michael is a journalist reporting on global events.', NULL),
    ('EmmaMoore', 'emma@example.com', 'password987', 'Emma is a technology blogger and early adopter.', NULL),
    ('OliviaWilson', 'olivia@example.com', 'password123', 'Olivia is a biologist researching marine life.', NULL),
    ('LucasThomas', 'lucas@example.com', 'password456', 'Lucas is a software engineer with a knack for innovation.', NULL),
    ('AvaWalker', 'ava@example.com', 'password789', 'Ava is a travel vlogger exploring the world.', NULL),
    ('SophiaKing', 'sophia@example.com', 'password654', 'Sophia is a fitness trainer promoting a healthy lifestyle.', NULL),
    ('OliverWright', 'oliver@example.com', 'password321', 'Oliver is an architect designing sustainable buildings.', NULL),
    ('EllaRobinson', 'ella@example.com', 'password123', 'Ella is a singer-songwriter with a soulful voice.', NULL);
    
    -- Sample data for Publications (mix of questions, answers, and comments)
INSERT INTO Publication (owner_id, content, date)
VALUES
    (1, 'What are the best practices for software development?', CURRENT_DATE),
    (2, 'I think following SOLID principles is key.', CURRENT_DATE - 1),
    (3, 'Einstein\'s theory of relativity is fascinating!', CURRENT_DATE - 2),
    (4, 'I love sushi, especially in Tokyo!', CURRENT_DATE - 3),
    (5, 'I recommend starting with a 30-minute workout.', CURRENT_DATE - 4),
    (6, 'Olivia\'s piano concert was amazing.', CURRENT_DATE - 5),
    (7, 'I have a cute cat named Whiskers.', CURRENT_DATE - 6),
    (8, 'The Rockies have stunning hiking trails.', CURRENT_DATE - 7),
    (9, 'What classic novels do you enjoy reading?', CURRENT_DATE - 8),
    (10, 'Here\'s my lasagna recipe.', CURRENT_DATE - 9),
    (11, 'I\'m excited about the new iPhone release.', CURRENT_DATE - 10),
    (12, 'Check out the latest fashion trends!', CURRENT_DATE - 11),
    (13, 'A student shared a touching story in class today.', CURRENT_DATE - 12),
    (14, 'I loved that movie; highly recommended!', CURRENT_DATE - 13),
    (15, 'Let\'s protect the environment together.', CURRENT_DATE - 14),
    (16, 'Photography is my passion.', CURRENT_DATE - 15),
    (17, 'Yoga and mindfulness promote well-being.', CURRENT_DATE - 16),
    (18, 'Breaking news: Major event in the world!', CURRENT_DATE - 17),
    (19, 'Tech enthusiasts, stay updated!', CURRENT_DATE - 18),
    (20, 'Exploring marine life is fascinating.', CURRENT_DATE - 19),
    (21, 'Innovations in software engineering are exciting.', CURRENT_DATE - 20),
    (22, 'Ava\'s travel vlog: Discover new places!', CURRENT_DATE - 21),
    (23, 'Promote a healthier lifestyle with yoga.', CURRENT_DATE - 22),
    (24, 'Sustainable architecture: A green future.', CURRENT_DATE - 23),
    (25, 'Enjoy Ella\'s soulful music.', CURRENT_DATE - 24),
    (26, 'Discussion: Artificial intelligence in healthcare', CURRENT_DATE - 25),
    (27, 'How to bake the perfect chocolate cake', CURRENT_DATE - 26),
    (28, 'Traveling through Europe on a budget', CURRENT_DATE - 27),
    (29, 'Effective time management techniques', CURRENT_DATE - 28),
    (30, 'The beauty of astronomy and stargazing', CURRENT_DATE - 29),
    (31, 'My experience with entrepreneurship', CURRENT_DATE - 30),
    (32, 'Discovering hidden gems in your city', CURRENT_DATE - 31),
    (33, 'The power of meditation for mental health', CURRENT_DATE - 32),
    (34, 'My favorite recipes from around the world', CURRENT_DATE - 33),
    (35, 'Tips for a successful job interview', CURRENT_DATE - 34),
    (36, 'Photography tips: Capturing the perfect shot', CURRENT_DATE - 35),
    (37, 'Exploring the wonders of marine biology', CURRENT_DATE - 36),
    (38, 'A guide to sustainable gardening practices', CURRENT_DATE - 37),
    (39, 'Latest developments in artificial intelligence', CURRENT_DATE - 38),
    (40, 'My journey through South America', CURRENT_DATE - 39),
    (41, 'Achieving work-life balance in a fast-paced world', CURRENT_DATE - 40),
    (42, 'Recommendations for must-read novels', CURRENT_DATE - 41),
    (43, 'Exploring the world of virtual reality', CURRENT_DATE - 42),
    (44, 'How to start a successful online business', CURRENT_DATE - 43),
    (45, 'Hiking adventures in the Pacific Northwest', CURRENT_DATE - 44),
    (46, 'The art of storytelling in cinema', CURRENT_DATE - 45),
    (47, 'Exploring the cosmos through a telescope', CURRENT_DATE - 46),
    (48, 'Promoting eco-friendly habits in daily life', CURRENT_DATE - 47),
    (49, 'The impact of 5G technology on our world', CURRENT_DATE - 48),
    (50, 'The art of painting and creative expression', CURRENT_DATE - 49),
    (51, 'Music: A universal language', CURRENT_DATE - 50),
    (52, 'Exploring the world of fashion design', CURRENT_DATE - 51),
    (53, 'Fitness tips for a healthier you', CURRENT_DATE - 52),
    (54, 'Traveling to exotic destinations', CURRENT_DATE - 53),
    (55, 'The joy of cooking and culinary adventures', CURRENT_DATE - 54),
    (56, 'Technology trends: What\'s next?', CURRENT_DATE - 55),
    (57, 'A journey through history and ancient civilizations', CURRENT_DATE - 56),
    (58, 'My inspiring journey in education', CURRENT_DATE - 57),
    (59, 'Movie magic: Behind the scenes', CURRENT_DATE - 58),
    (60, 'Environmental conservation and the great outdoors', CURRENT_DATE - 59),
    (61, 'Exploring the world of computer science', CURRENT_DATE - 60),
    (62, 'A culinary adventure: Tasting world cuisines', CURRENT_DATE - 61),
    (63, 'Health and wellness for a balanced life', CURRENT_DATE - 62),
    (64, 'Art and design: Creativity unleashed', CURRENT_DATE - 63),
    (65, 'Inspiring stories of personal growth', CURRENT_DATE - 64),
    (66, 'Movie recommendations for a cozy night', CURRENT_DATE - 65),
    (67, 'Nature\'s wonders: Protecting our planet', CURRENT_DATE - 66),
    (68, 'Photography: Capturing memories', CURRENT_DATE - 67),
    (69, 'Mind, body, and soul: Achieving harmony', CURRENT_DATE - 68),
    (70, 'Latest news and global happenings', CURRENT_DATE - 69),
    (71, 'Technology insights: Stay informed', CURRENT_DATE - 70),
    (72, 'Marine life: A world beneath the waves', CURRENT_DATE - 71),
    (73, 'Software engineering: Innovation at its best', CURRENT_DATE - 72),
    (74, 'Travel adventures and hidden gems', CURRENT_DATE - 73),
    (75, 'A path to well-being and health', CURRENT_DATE - 74),
    (76, 'Sustainable architecture and design', CURRENT_DATE - 75),
    (77, 'Soothing melodies and musical enchantment', CURRENT_DATE - 76),
    (78, 'Unlocking the mysteries of the universe', CURRENT_DATE - 77),
    (79, 'Culinary delights from around the world', CURRENT_DATE - 78),
    (80, 'Inspirational stories for personal growth', CURRENT_DATE - 79),
    (81, 'Movie magic and cinematic adventures', CURRENT_DATE - 80),
    (82, 'Environmental conservation and eco-conscious living', CURRENT_DATE - 81),
    (83, 'The art of photography: Capturing moments', CURRENT_DATE - 82),
    (84, 'Yoga and mindfulness for inner peace', CURRENT_DATE - 83),
    (85, 'Global events and world-changing news', CURRENT_DATE - 84),
    (86, 'Tech insights: The future is here', CURRENT_DATE - 85),
    (87, 'Exploring marine ecosystems and underwater beauty', CURRENT_DATE - 86),
    (88, 'Innovations in software development', CURRENT_DATE - 87),
    (89, 'Wanderlust: Journey to breathtaking destinations', CURRENT_DATE - 88),
    (90, 'Achieving a balanced and healthy lifestyle', CURRENT_DATE - 89),
    (91, 'Sustainable living and green practices', CURRENT_DATE - 90),
    (92, 'Melodic tunes and musical treasures', CURRENT_DATE - 91),
    (93, 'A cosmic adventure: Stargazing at its finest', CURRENT_DATE - 92),
    (94, 'Fashion design: Creativity and style', CURRENT_DATE - 93),
    (95, 'Fitness and wellness for a better you', CURRENT_DATE - 94),
    (96, 'Journey to extraordinary places', CURRENT_DATE - 95),
    (97, 'Culinary delights and gastronomic experiences', CURRENT_DATE - 96),
    (98, 'Tech trends and the digital landscape', CURRENT_DATE - 97),
    (99, 'Discovering history and ancient civilizations', CURRENT_DATE - 98),
    (100, 'The power of education and personal growth', CURRENT_DATE - 99);

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
    (25, 5),  -- Question 25 with a score of 5
    (26, 10), -- Answer to Question 25 with a score of 10;
    

-- Sample data for Question (questions)
INSERT INTO Question (question_id, title, status)
VALUES
    (1, 'Best practices for software development?', 'open'),
    (3, 'Einstein\'s theory of relativity?', 'open'),
    (5, 'How to start a 30-minute workout routine?', 'open'),
    (6, 'Olivia's piano concert details?', 'open'),
    (9, 'Classic novels recommendations?', 'closed'),
    (11, 'Exciting features of the new iPhone?', 'open'),
    (13, 'Touching stories shared in class?', 'open'),
    (15, 'Movie recommendations?', 'closed'),
    (17, 'Hiking trails in the Rockies?', 'open'),
    (19, 'Latest tech developments?', 'open'),
    (21, 'Ava's travel vlog: New places to explore?', 'open'),
    (23, 'Promoting a healthier lifestyle with yoga?', 'open');
    

-- Sample data for Answer (answers to questions)
INSERT INTO Answer (answer_id, question_id)
VALUES
    (2, 1),  -- Answer to Question 1
    (4, 3),  -- Answer to Question 3
    (6, 5),  -- Answer to Question 5
    (8, 6),  -- Answer to Question 6
    (10, 9), -- Answer to Question 9
    (12, 11),  -- Answer to Question 11
    (14, 13),  -- Answer to Question 13
    (16, 15),  -- Answer to Question 15
    (18, 17),  -- Answer to Question 17
    (20, 19),  -- Answer to Question 19
    (22, 21),  -- Answer to Question 21
    (24, 23); -- Answer to Question 23
    
INSERT INTO Comment (comment_id, questionAnswer_id)
VALUES
    (27, 2),  -- Comment on Answer 2
    (28, 2),  -- Another Comment on Answer 2
    (30, 4),  -- Comment on Answer 4
    (33, 8),  -- Comment on Answer 8
    (36, 10), -- Comment on Answer 10
    (39, 12), -- Comment on Answer 12
    (42, 16), -- Comment on Answer 16
    (45, 18), -- Comment on Answer 18
    (48, 20), -- Comment on Answer 20
    (51, 22), -- Comment on Answer 22
    (54, 24); -- Comment on Answer 24

-- Sample data for Notification
INSERT INTO Notification (user_id, description)
VALUES
    (1, 'You have a new follower.'),
    (2, 'Your question received a new answer.'),
    (3, 'Your comment was upvoted.'),
    (4, 'New updates in technology.'),
    (5, 'Congratulations on your successful event.'),
    (6, 'An interesting article on science.'),
    (7, 'Your post received a comment.'),
    (8, 'Important news: Stay informed.'),
    (9, 'Your answer was marked as the best.'),
    (10, 'A new tag was created.'),
    (11, 'Announcing a giveaway!'),
    (12, 'Your post was featured.'),
    (13, 'Stay active and engaged.'),
    (14, 'Upcoming travel destination recommendations.'),
    (15, 'Join our fitness challenge!'),
    (16, 'Discussion on art and creativity.'),
    (17, 'Mindfulness and well-being tips.'),
    (18, 'Breaking news: Major event in the world.'),
    (19, 'Tech enthusiasts, stay updated.'),
    (20, 'Exploring marine life is fascinating.'),
    (21, 'Innovations in software engineering are exciting.'),
    (22, 'Ava's travel vlog: Discover new places.'),
    (23, 'Promote a healthier lifestyle with yoga.'),
    (24, 'Sustainable architecture: A green future.'),
    (25, 'Enjoy Ella's soulful music.');
    
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
    (9, 13),   -- Notification 9 related to Question 13
    (10, 13),  -- Notification 10 related to Question 13
    (11, 15),  -- Notification 11 related to Question 15
    (12, 15),  -- Notification 12 related to Question 15
    (13, 17),  -- Notification 13 related to Question 17
    (14, 17),  -- Notification 14 related to Question 17
    (15, 21),  -- Notification 15 related to Question 21
    (16, 21),  -- Notification 16 related to Question 21
    (17, 25),  -- Notification 17 related to Question 25
    (18, 25);  -- Notification 18 related to Question 25

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
INSERT INTO Tag (tagName)
VALUES
    ('programming'),
    ('science'),
    ('technology'),
    ('music'),
    ('fitness'),
    ('travel'),
    ('art'),
    ('literature'),
    ('health'),
    ('movies'),
    ('nature'),
    ('cooking'),
    ('history'),
    ('mathematics'),
    ('environment');
    
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



    

