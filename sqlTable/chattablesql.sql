
--Table structure for table chat
CREATE TABLE chat (
  cid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(128) NOT NULL,
  date datetime NOT NULL,
  message TEXT NOT NULL,
  votes int(11) NOT NULL,
  roomID VARCHAR(255) NOT NULL,
  FOREIGN KEY (roomID) REFERENCES users(roomID)
);


--Table Structure for table 'users'

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    roomID VARCHAR(255) NOT NULL,
    FOREIGN KEY (roomID) REFERENCES users(roomID)
);



--Table Structure for table'archives'
CREATE TABLE archive (
  cid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(128) NOT NULL,
  date datetime NOT NULL,
  message TEXT NOT NULL,
  votes int(11) NOT NULL,
  roomID VARCHAR(255) NOT NULL
);


CREATE TABLE questions (
  question_number int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  question_text text NOT NULL,
  id int(11) NOT NULL,
  roomID varchar(25) NOT NULL
);

CREATE TABLE answers (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  question_number int(11) NOT NULL,
  is_correct tinyint(1) NOT NULL DEFAULT 0,
  coption text NOT NULL,
  roomID varchar(25) NOT NULL
);


-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `users` (`roomID`);

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `fk_2_id` FOREIGN KEY (`roomID`) REFERENCES `users` (`roomID`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_l_id` FOREIGN KEY (`roomID`) REFERENCES `users` (`roomID`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `users` (`roomID`);
