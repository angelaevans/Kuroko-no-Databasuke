------------------------------
- Updated Creation Commands
------------------------------
DROP TABLE IF EXISTS Conversation CASCADE;

DROP TABLE IF EXISTS Pictures CASCADE;

DROP TABLE IF EXISTS Users CASCADE;

CREATE TABLE Users(userID SERIAL PRIMARY KEY, username VARCHAR(30) UNIQUE not null);  

CREATE TABLE Pictures(picID SERIAL PRIMARY KeY, authorID INTEGER REFERENCES Users(userID) not null, picPath VARCHAR(200) not null);

CREATE TABLE Conversation(conID SERIAL PRIMARY KEY, userID INTEGER REFERENCES Users(userID) not null, friendID INTEGER not null, sentMessage INTEGER REFERENCES Pictures(picID));  

INSERT INTO Users (username) VALUES  ('Kagami'), ('Kuroko'), ('Hyuga'), ('Kiyoshi'), ('Izuki'), ('Mitobe'), ('Koganei'), ('Tsuchida'),  ('Furihata'), ('Kawahara'), ('Fukuda'), ('Riko'),  ('Midorima'), ('Aomine'), ('Kise'), ('Murasakibara'),  ('Momoi'), ('Akashi'), ('Himuro'), ('Takao');

INSERT INTO Pictures(authorID, picPath) VALUES (1, 'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851575_392310030866309_792706737_n.png' ), (14, 'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851539_167788253418461_193227798_n.png'), (2, 'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p240x240/851568_555287751225746_516387701_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851569_460938430694672_880710192_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851582_584600344965831_1381120785_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851583_584600148299184_823237821_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851561_460938544027994_140916474_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851577_460938497361332_1240611976_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/s240x240/851557_185128411661425_684391113_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851585_229801723835110_1542794558_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851575_229801737168442_53735023_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851579_229801833835099_1670506868_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851537_167788063418480_45164264_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851558_665073526837501_1268020686_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851556_387545771371307_1379655167_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851586_387545604704657_1384231130_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851559_1398251847059665_2003202169_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/t39.1997-6/p128x128/851583_1398251853726331_271399221_n.png'), (1,'https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-ash3/t39.1997-6/p128x128/851556_499671000115403_1128430710_n.png');

INSERT INTO Conversation(userID, friendID) VALUES (1, 8), (1, 2), (1, 4), (1, 19),  (1, 5), (2, 10), (2, 4), (2, 18),  (2, 16), (2, 7), (3, 5), (3, 1),  (3, 10), (3, 18), (3, 14), (4, 14),  (4, 16), (4, 17), (4, 3), (5, 11),  (5, 8), (5, 20), (5, 6), (5, 13),  (6, 16), (6, 8), (6, 7),  (7, 17), (7, 19), (7, 1), (7, 14),  (7, 11), (8, 19), (8, 15), (8, 6),  (8, 2), (9, 6), (9, 19),  (9, 20), (9, 8), (10, 7), (10, 5),  (10, 12), (10, 4), (11, 1), (11, 20),  (11, 13), (11, 12), (12, 13), (12, 11),  (12, 5), (12, 9), (13, 20), (13, 10),  (13, 15), (13, 6), (14, 3), (14, 11),  (14, 5), (14, 10), (15, 2), (15, 18),  (15, 9), (15, 8), (15, 20), (16, 15),  (16, 13), (16, 3), (16, 17), (17, 12),  (17, 9), (17, 18), (18, 9), (18, 3),  (18, 16), (18, 11), (18, 1), (19, 18),  (19, 14), (19, 7), (19, 15), (20, 4),  (20, 6), (20, 2), (20, 19);


------------------------------
- All used SQL/PostgreSQL
------------------------------

-- Function for duality on the conversation table. 
-- It starts by checking if the duality exists and if not inserts the duality. Leftover cases are cleaned up by the Tr_DoubleFriends rule.
CREATE OR REPLACE FUNCTION CreateDuality() RETURNS TRIGGER AS $CreateDuality$ BEGIN IF (NOT EXISTS (SELECT userid, friendid FROM Conversation a WHERE a.userid = NEW.friendid and a.friendid = NEW.userid)) THEN INSERT INTO Conversation(userID, friendID) VALUES(new.friendID, new.userID); END IF; RETURN NEW; END; $CreateDuality$ LANGUAGE plpgsql;

-- Trigger that happens after inserting data onto the conversation. It calls CreateDuality after inserting.
-- If the insert already exists, then the Tr_DoubleFriends rule will cleaned up.
CREATE TRIGGER Tr_Friending AFTER INSERT ON conversation FOR EACH ROW EXECUTE PROCEDURE CreateDuality();

-- Rule that insures if the insert already exists on the conversation table then do not insert.
CREATE OR REPLACE RULE Tr_DoubleFriends AS ON INSERT TO Conversation WHERE EXISTS (SELECT userid, friendid FROM Conversation a WHERE a.userid = NEW.userid and a.friendid = NEW.friendid) DO INSTEAD NOTHING;

-- Rule that insures if the insert already exists on the users table then do not insert.
CREATE OR REPLACE RULE Tr_Doubleuser AS ON INSERT TO Users WHERE EXISTS (SELECT userid FROM Users a WHERE a.userid = NEW.userid or a.username = NEW.username) DO INSTEAD NOTHING;


-- Function that takes in a name argument, quarries, and returns the userid
CREATE OR REPLACE FUNCTION usernametoid(name text) RETURNS setof integer AS $body$ SELECT userid from Users a where a.username = name;  $body$ LANGUAGE sql;

-- Function that takes in two name argument, converts the two to userids, and then inserts it into the conversation table
CREATE OR REPLACE FUNCTION Addfriend(main text, tobe text) RETURNS void AS $Addfriend$ DECLARE	mainuser int;	tobefriend int; BEGIN 	Select usernametoid(main) into mainuser;	Select usernametoid(tobe) into tobefriend; INSERT INTO Conversation(userID, friendID) VALUES (mainuser, tobefriend); END; $Addfriend$ LANGUAGE plpgsql;

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

--Creates a Natrual Inner Join to connect Username and conID
CREATE TEMP VIEW conversationNames AS (SELECT username,conid FROM users NATURAL INNER JOIN conversation);

--Creates an index on userID in Users
CREATE UNIQUE INDEX userid_idx ON users (userid);

--Creates a function that adds a user to the database
CREATE OR REPLACE FUNCTION insertUser(uname text) 
RETURNS VOID AS
$BODY$
INSERT INTO Users(username) VALUES (uname);
$BODY$
LANGUAGE sql;

--Creates a function that deletes both sides of a conversation
CREATE OR REPLACE FUNCTION deleteFriend(uname text, fname text) RETURNS VOID AS $deleteFriend$ DECLARE uid int;	fid int; BEGIN Select usernametoid(uname) into uid;	Select usernametoid(fname) into fid; DELETE FROM Conversation WHERE conid = (SELECT conid from conversation where (userId = uid and friendid =fid)); DELETE FROM Conversation WHERE conid = (SELECT conid from conversation where (userId = fid and friendid =uid)); END; $deleteFriend$ LANGUAGE plpgsql;

--Default value for a sent message is 1
CREATE OR REPLACE FUNCTION Defaultpicture() RETURNS TRIGGER AS $Defaultpicture$ BEGIN New.sentMessage = 1; RETURN NEW; END; $Defaultpicture$ LANGUAGE plpgsql;

--When insterting, will make the sent message be default. should not run when not insert aka updating/sending a new message
CREATE TRIGGER Tr_ConversationPictureDefault BEFORE INSERT ON Conversation FOR EACH ROW EXECUTE PROCEDURE Defaultpicture();

--alters table to a new message
CREATE OR REPLACE FUNCTION Sendnewmessage(username text, friendname text, pictureid integer) RETURNS VOID AS $SendNewMessage$ DECLARE	useridvar int;	friendidvar int; BEGIN Select usernametoid(username) into useridvar;	Select usernametoid(friendname) into friendidvar; UPDATE Conversation SET sentMessage = pictureid WHERE (userID = useridvar AND friendID = friendidvar); END; $SendNewMessage$ LANGUAGE plpgsql;

--Creates a function which returns the list of friends of a username, with the username as the input--
CREATE OR REPLACE FUNCTION friendList(uname text) 
RETURNS SETOF text AS
$body$ 
	SELECT username 	FROM Users 	WHERE userID IN 		(SELECT friendID 		FROM Users, Conversation 		WHERE Conversation.userID = (SELECT usernametoid(uname))) 
$body$ 
LANGUAGE sql;

-- CHecks if they're friends and returns the FIRST conversation that proves it true
CREATE OR REPLACE FUNCTION aretheyfriends(uname text, fname text) RETURNS BOOLEAN AS $aretheyfriends$ DECLARE uid int; fid int; BEGIN	Select usernametoid(uname) into uid; Select usernametoid(fname) into fid; PERFORM conID FROM conversation WHERE (userID=uid AND friendID=fid) OR (userID=fid AND friendID=uid) LIMIT 1; IF FOUND THEN RETURN TRUE; END IF; RETURN FALSE; END; $aretheyfriends$ LANGUAGE plpgsql;

-- Finds a conversation and returns the sendmessage's picid
CREATE OR REPLACE FUNCTION getpicidfromConversation(username text, friendname text) RETURNS SETOF integer AS $getpicidfromConversation$ DECLARE	mainuser int; friend int; BEGIN Select usernametoid(username) into mainuser; Select usernametoid(friendname) into friend; RETURN QUERY SELECT sentMessage FROM conversation WHERE (userID=mainuser AND friendID=friend);  end; $getpicidfromConversation$ LANGUAGE plpgsql;
