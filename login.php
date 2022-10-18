<?php
//this page will display the user login page 
//we call session start when we want to store data into the session superglobal. the session superglobal allows us
//to pass data to other pages of the website

//require
require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/UserDAO.class.php');
require_once('inc/Utility/Page.class.php');

//validate the username and password combo
//check if user clicked login
if(isset($_POST['action']) && $_POST['action'] == 'login') {
    //initlize dao
    UserDAO::initialize();
    
    //if user submitted login form, get the user associated with that username and 
    //then verify that the entered password matches the stored password
    //will return false if the user is not found in the db
    $currentUser = UserDAO::getUser($_POST['username']);

    //if user and pass combo is verifed, start session and redirect to profile page
    if(isset($currentUser) && !empty($currentUser)) {
        if($currentUser->verifyPassword($_POST['password'])) {
            //well we need to display the users info so we can pass it through the session superglobal. 
            //we can't request the data from the database again because
            //we have to create another form submission and ask for the user cause the post data is not transfered to the
            //new page nor do we have a form. so i think sessions would be the best way to do it
            session_start();
    
            $_SESSION['firstName'] = $currentUser->getFirstName();
            $_SESSION['lastName'] = $currentUser->getLastName();
            $_SESSION['email'] = $currentUser->getEmail();
            $_SESSION['username'] = $currentUser->getUsername();
    
            header("Location: profile.php");
        } else {
            //if the password does not match, we will need to display some sort of error on the page
            //clear the post data so the error message doesn't stay if you refresh page
            Page::LoginErrorMessage();
        }
    }
    
}

//if user clicks on the register link then redirect to the register page
if(isset($_GET['action']) && $_GET['action'] == "register") {
    header("Location: register.php");
}

Page::header("Login");
Page::LoginForm();
Page::footer();


?>