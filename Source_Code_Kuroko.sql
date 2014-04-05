------------------------------
- Updated Creation Commands
------------------------------
CREATE TABLE Users( userID SERIAL PRIMARY KEY, username VARCHAR(30) UNIQUE);  

CREATE TABLE Conversation(conID SERIAL PRIMARY KEY, userID INTEGER REFERENCES Users(userID), friendID INTEGER, userMessage VARCHAR(100), sentMessage VARCHAR(100)  );  

CREATE TABLE Pictures(picID SERIAL PRIMARY KeY, authorID INTEGER REFERENCES Users(userID), picPath VARCHAR(50));

INSERT INTO Users (username) VALUES  ('Kagami'), ('Kuroko'), ('Hyuga'), ('Kiyoshi'), ('Izuki'), ('Mitobe'), ('Koganei'), ('Tsuchida'),  ('Furihata'), ('Kawahara'), ('Fukuda'), ('Riko'),  ('Midorima'), ('Aomine'), ('Kise'), ('Murasakibara'),  ('Momoi'), ('Akashi'), ('Himuro'), ('Takao');

INSERT INTO Conversation(userID, friendID) VALUES (1, 8), (1, 2), (1, 4), (1, 19),  (1, 5), (2, 10), (2, 4), (2, 18),  (2, 16), (2, 7), (3, 5), (3, 1),  (3, 10), (3, 18), (3, 14), (4, 14),  (4, 16), (4, 17), (4, 3), (5, 11),  (5, 8), (5, 20), (5, 6), (5, 13),  (6, 16), (6, 8), (6, 7),  (7, 17), (7, 19), (7, 1), (7, 14),  (7, 11), (8, 19), (8, 15), (8, 6),  (8, 2), (9, 6), (9, 19),  (9, 20), (9, 8), (10, 7), (10, 5),  (10, 12), (10, 4), (11, 1), (11, 20),  (11, 13), (11, 12), (12, 13), (12, 11),  (12, 5), (12, 9), (13, 20), (13, 10),  (13, 15), (13, 6), (14, 3), (14, 11),  (14, 5), (14, 10), (15, 2), (15, 18),  (15, 9), (15, 8), (15, 20), (16, 15),  (16, 13), (16, 3), (16, 17), (17, 12),  (17, 9), (17, 18), (18, 9), (18, 3),  (18, 16), (18, 11), (18, 1), (19, 18),  (19, 14), (19, 7), (19, 15), (20, 4),  (20, 6), (20, 2), (20, 19);

------------------------------
- All used SQL/PostgreSQL
------------------------------

-- Function for duality on the conversation table. 
-- It starts by checking if the duality exists and if not inserts the duality. Leftover cases are cleaned up by the Tr_DoubleFriends rule.
CREATE or replace FUNCTION CreateDuality() RETURNS TRIGGER AS $CreateDuality$ BEGIN IF (NOT EXISTS (SELECT userid, friendid FROM Conversation a WHERE a.userid = NEW.friendid and a.friendid = NEW.userid)) THEN INSERT INTO Conversation(userID, friendID) VALUES(new.friendID, new.userID); END IF; RETURN NEW; END; $CreateDuality$ LANGUAGE plpgsql;

-- Trigger that happens after inserting data onto the conversation. It calls CreateDuality after inserting.
-- If the insert already exists, then the Tr_DoubleFriends rule will cleaned up.
CREATE TRIGGER Tr_Friending AFTER INSERT ON conversation FOR EACH ROW EXECUTE PROCEDURE CreateDuality();

-- Rule that insures if the insert already exists on the conversation table then do not insert.
CREATE OR REPLACE RULE Tr_DoubleFriends AS ON INSERT TO Conversation WHERE EXISTS (SELECT userid, friendid FROM Conversation a WHERE a.userid = NEW.userid and a.friendid = NEW.friendid) DO NOTHING;

-- Rule that insures if the insert already exists on the users table then do not insert.
CREATE OR REPLACE RULE Tr_Doubleuser AS ON INSERT TO Users WHERE EXISTS (SELECT userid FROM Users a WHERE a.userid = NEW.userid or a.username = NEW.username) DO NOTHING;


-- Function that takes in a name argument, quarries, and returns the userid
CREATE or replace FUNCTION usernametoid(name text) RETURNS setof integer AS $body$ SELECT userid from Users a where a.username = name;  $body$ LANGUAGE sql;

-- Function that takes in two name argument, converts the two to userids, and then inserts it into the conversation table
CREATE or replace FUNCTION Addfriend(main text, tobe text) RETURNS void AS $Addfriend$ DECLARE	mainuser int;	tobefriend int; BEGIN 	Select usernametoid(main) into mainuser;	Select usernametoid(tobe) into tobefriend; INSERT INTO Conversation(userID, friendID) VALUES (mainuser, tobefriend); END; $Addfriend$ LANGUAGE plpgsql;

--Function to get the conID pair of a conversation
CREATE OR REPLACE FUNCTION getConversation(uid integer, fid integer) 
RETURNS SETOF integer AS
$BODY$
    SELECT conID
    FROM conversation
    WHERE (userID=uid AND friendID=fid) OR (userID=fid AND friendID=uid);
$BODY$ 
LANGUAGE sql;

--Creating Materialized View with userID and a friend count
CREATE VIEW friendCount AS (SELECT userid,count(friendid) FROM conversation GROUP BY userid);

-Creates a Natrual Inner Join to connect Username and conID
CREATE TEMP VIEW conversationNames AS (SELECT username,conid FROM users NATURAL INNER JOIN conversation);

--Creates an index on userID in Users
CREATE UNIQUE INDEX userid_idx ON users (userid);

—-Creates a function that adds a user to the database
CREATE OR REPLACE FUNCTION insertUser(uname varchar(30)) 
RETURNS VOID AS
$BODY$
INSERT INTO Users(username) VALUES (uname);
$BODY$
LANGUAGE sql;

—Creates a function that deletes both sides of a conversation
CREATE OR REPLACE FUNCTION 
deleteFriend(uid integer, fid integer)
RETURNS VOID AS
$BODY$
DELETE FROM Conversation WHERE conid IN (SELECT getConversation(uid, fid));
$BODY$
LANGUAGE sql;
