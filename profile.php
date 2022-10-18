<?php
//display the user's posts and some of their basic information

//require
require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Entities/Post.class.php');
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/UserDAO.class.php');
require_once('inc/Utility/PostDAO.class.php');
require_once('inc/Utility/LoginManager.class.php');
require_once('inc/Utility/Page.class.php');

//start session so you have access to current session variables
session_start();

//if the user is logged in, this means there is session data so we want to return true and keep the user logged in 
//and display their profile
//if the user is not logged in then we redirect the user back to the login page
LoginManager::verifyLogin();

//we need a way to check if we are currently logged in. this way, if the user deletes the tab and goes 
//back, we can remain logged in. if the user clicks the logout button then we can redirect the user
//back to the login page and destory the current session so no information is saved in session

//initialize the dao
UserDAO::initialize();
PostDAO::initialize();

//we can just use the session username to get the user object again from the database and then pass this
//to the profile page.
//we get an error if there has not been a session created yet
$currentUser = UserDAO::getUser($_SESSION['username']);

//display the profile 
Page::ProfilePage($currentUser);

//do something with submitted text
if(isset($_POST['action']) && $_POST['action'] == 'createPost') {
    //create post object and set the contents of the post
    $newPost = new Post();
    $newPost->setContents($_POST['postArea']);
    
    //easier to sort by unix timestamp than an actual date
    //generate a time stamp and set the post date property    
    $newPost->setPostDate(time());

    $newPost->setUserId($currentUser->getId());

    //store the post in the db. returns the postid of the new post
    $newPostId = PostDAO::addPost($newPost);

    //get the post object. the returned object will have the postid initialized
    //whereas the one declared here does not have the postid initialized
    $currentPost = PostDAO::getPost($newPostId);

    header('Location: profile.php', true, 303);
    unset($_SESSION);
    var_dump($_POST);
}

//if the user clicks the logout button, redirect to the login page, unset the session variable, and destory the session
if(isset($_GET['action']) && $_GET['action'] == "redirect") {
    //if we are logging the user out, we should probably clear the session variable. if we clear the session variable
    //then the login manager should destroy the session for us
    session_unset();
    
    //redirect the user to the login page
    header('Location: login.php');
}

//so we can display all the posts when the user logs in
$allPostObjects = PostDAO::getAllPosts($currentUser->getId());

Page::DisplayYourPosts($allPostObjects);
Page::header("Profile");
Page::footer();
?>