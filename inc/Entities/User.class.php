<?php

class User {
    //properties
    //if the number of properties does not match number in the sql file than
    //when you try to retrieve the object from the database, it will not be 
    //initialized properly
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $username;
    private string $password;
    private string $email;

    //getters
    public function getId() {
        return $this->id;
    }
    public function getFirstName() {
        return $this->firstName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    //should you have a getter or setter for password or username? seems like a security risk imo

    //setters
    public function setFirstName(string $newFirstName) {
        $this->firstName = $newFirstName;
    }
    public function setLastName(string $newLastName) {
        $this->lastName = $newLastName;
    }
    public function setEmail(string $newEmail) {
        $this->email = $newEmail;
    }
    public function setUserName(string $newUsernmae) {
        $this->username = $newUsernmae;
    }
    public function setPassword(string $newPassword) {
        $this->password = $newPassword;
    }

    //pass in hashed password and compare it with the hash we have stored in db
    public function verifyPassword(string $passwordToVerify) {
        //return true or false depending if the hashed password matches
        return password_verify($passwordToVerify, $this->getPassword());
    }
}

?>