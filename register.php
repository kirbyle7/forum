<?php
//this will allow users to register for an account. we will hash the password here and store other post data into a user object. then we will pass
//this information into our database

//require
require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/UserDAO.class.php');
require_once('inc/Utility/Page.class.php');

//initialize the pdoagent
UserDAO::initialize();

//get post data, create user object, pass object to pdo for insertion
if(isset($_POST['action']) && $_POST['action'] == 'register') {
    //create user object

    $newUser = new User();

    $newUser->setFirstName($_POST['firstName']);
    $newUser->setLastName($_POST['lastName']);
    $newUser->setEmail($_POST['email']);
    $newUser->setUserName($_POST['username']);

    //so we need to set the password but we gotta hash it first
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newUser->setPassword($hashedPassword);

    //insert the user into the database after hashing the password
    UserDAO::addUser($newUser);

    //we want to redirct the user to the login page after registering
    header('Location: login.php');
}

Page::header("Register");
Page::RegisterForm();
Page::footer();


?>