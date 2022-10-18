-- we will store our tables here and insert values
DROP DATABASE IF EXISTS `UserDB`;

CREATE DATABASE UserDB;

USE UserDB;

DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS POSTS;

CREATE TABLE USERS (
    id INT(11) NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL UNIQUE, 
    CONSTRAINT USERS_PK PRIMARY KEY(id)
);

CREATE TABLE POSTS (
    postId INT(11) NOT NULL AUTO_INCREMENT,
    postContent VARCHAR(1000) NULL,
    postDate VARCHAR(20) NULL,
    userId INT(11) NOT NULL,
    CONSTRAINT POSTID_PK PRIMARY KEY(postId),
    CONSTRAINT USER_POST_FK FOREIGN KEY(userId)
        REFERENCES USERS(id)
);