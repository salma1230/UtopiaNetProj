
--Table structure for table chat
CREATE TABLE chat (
  cid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(128) NOT NULL,
  date datetime NOT NULL,
  message TEXT NOT NULL,
  votes int(11) NOT NULL
);


--Table Structure for table 'users'

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


--Admin Credentials--
--username:'admin'
--password:'admin_pwd123'

--Table Structure for tabloe'archives'
CREATE TABLE archive (
  cid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(128) NOT NULL,
  date datetime NOT NULL,
  message TEXT NOT NULL,
  votes int(11) NOT NULL
);
