CREATE USER 'simpleticket2'@'%' IDENTIFIED BY '123';
CREATE DATABASE simpleticket2 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALTER, CREATE, DELETE, DROP, INDEX, INSERT, LOCK TABLES, REFERENCES, SELECT, UPDATE ON simpleticket2.* TO 'simpleticket2'@'%';
FLUSH PRIVILEGES;

