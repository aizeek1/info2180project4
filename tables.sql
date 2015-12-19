CREATE TABLE User (
id INT AUTO_INCREMENT,
firstname VARCHAR(32),
lastname VARCHAR(32),
username VARCHAR(64),
position VARCHAR(32),
password VARCHAR(32),
PRIMARY KEY(id));

CREATE TABLE Message (
id INT AUTO_INCREMENT,
body VARCHAR(255),
subject VARCHAR(64),
user_id INT (9),
recipient_ids VARCHAR(255),
PRIMARY KEY(id));

CREATE TABLE Message_read (
id INT AUTO_INCREMENT,
message_id INT(9),
reader_id INT(9),
message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
PRIMARY KEY(id));
