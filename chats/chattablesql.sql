
--Table structure for table chat
CREATE TABLE chat (
  cid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(128) NOT NULL,
  date datetime NOT NULL,
  message TEXT NOT NULL
);


--Table Structure for table 'users'

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
)
