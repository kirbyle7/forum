<?php

//create methods for getting user and insertion

class UserDAO {
    //we need to store the pdo agent a object as a static variable so we can access it anywhere in our dao class
    private static $_db;

    //first thing to do is to initialize the pdo object, which we will than have to call in our controller
    static function initialize() {
        self::$_db = new PDOAgent('User');
    }

    //we need to get a single user when we make a request to get the user related to the user-pass combo
    //we have to pass in username so we know which user to pull
    static function getUser(string $username) {
        //query
        $sql = "SELECT * FROM USERS WHERE username = :selectedUser;";
        
        //prepare
        self::$_db->query($sql);
        //bind
        self::$_db->bind(":selectedUser", $username);
        //execute
        self::$_db->execute();

        //return singe result. returns the user object
        return self::$_db->singleResult();
    }

    static function addUser($userObject) {
        //query
        $sql = "INSERT INTO USERS (firstName, lastName, username, password, email) 
            VALUES (:nFirstName, :nLastName, :nUsername, :nPassword, :nEmail);";

        //prepare
        self::$_db->query($sql);
        //bind
        self::$_db->bind(":nFirstName", $userObject->getFirstName());
        self::$_db->bind(":nLastName", $userObject->getLastName());
        self::$_db->bind(":nUsername", $userObject->getUsername());
        self::$_db->bind(":nPassword", $userObject->getPassword());
        self::$_db->bind(":nEmail", $userObject->getEmail());
        //execute
        self::$_db->execute();

        //return 
        return self::$_db->lastInsertId();
    }
}