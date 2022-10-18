<?php

class LoginManager {

    //this will check if the user is still logged into their account even when they exit the tab and
    //come back. depending on whether they are still logged in or not, we will create or destory the
    //session
    
    //if the user clicks the logout button then we will destroy the session and then redirect them
    //to the log in page
    
    static function verifyLogin() {

        //first, check to see if a session exists and if the session variable is not set then we want to start the session
        if(!isset($_SESSION['username'])) {
            session_start();
        }

        //if there is session data, return true. if there is no session data then the user is not logged in so we want
        //to clear any remaining session variables and destory the session
        if(isset($_SESSION['username'])) {
            return true;
        } else {
            //clear the session variable
            session_unset();

            //destroy the session
            session_destroy();

            //redirect user to the login page
            header('Location: login.php');
        }
    }
}

?>
