<?php

class Page {

    static function header($title) { ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="./css/profileStyles.css">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            
            <title><?php echo $title; ?></title>
        </head>
        <body class="h-100">
    <?php }

    static function RegisterForm() { ?>
        <!-- register a user -->
        <div class="container w-25">
            <!-- for proper vertical alignment the flex container must a viewport height set to max -->
            <div class="row d-flex align-items-center justify-content-center vh-100">
                <div class="col border border-4 m-3">   
                    <h2 class="text-center mt-3">Register</h2>
                    <form class="p-4" action="" method="POST">
                        <!-- used to check which form was submitted by check _post action variable = register -->
                        <input type="hidden" name="action" value="register">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button class="w-100 p-2 mt-2 btn btn-primary" type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>      
            </div>        
        </div>  
         
    <?php }

    //we could make a function to display error message when username password combo doesnt match
    static function LoginErrorMessage() { ?>
        <div class="container w-25 border border-4 text-center align-middle py-3 text-danger">
            <span>Your username or password is incorrect.</span>
        </div>   
    <?php }

    static function LoginForm() { ?>
        <!-- user login -->
        <div class="container w-25">
            <!-- for proper vertical alignment the flex container must a viewport height set to max -->
            <div class="row d-flex align-items-center justify-content-center vh-100">
                <div class="col border border-4 m-3">   
                    <h2 class="text-center mt-3">Login</h2>
                    <form class="p-4" action="" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <a class="registerLink" href="?action=register">Register</a>
                        </div>
                        <button class="w-100 p-2 mt-2 btn btn-primary" type="submit" class="btn btn-primary">Log In</button>
                    </form>
                </div>      
            </div>        
        </div>  
        
    <?php }

    static function ProfilePage($userObject) { ?>
        <!-- this will display all of the user's previous posts as well as some of their user information -->
        <div class="container p-5">
            <div class="row">
                <div class="col-11">
                    <h2>Hi <?php echo $userObject->getFirstName(); ?>,</h2>
                </div>
                <div class="col-1">
                <button type="button" class="btn btn-primary w-100"><a class="logoutLink text-white" href="?action=redirect">Logout</a></button>
                </div>
                
            </div>
            <div class="">
                <div>
                    <form class="" action="" method="POST" >
                        <input type="hidden" name="action" value="createPost">
                        <div class="mb-3">
                            <label for="postArea" class="form-label">Post Something!</label>
                            <textarea class="form-control" id="postArea" name="postArea" rows="3" maxlength="1000"></textarea>
                        </div>
                        <button class="w-100 btn btn-primary" type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
        
     <?php }

     static function DisplayYourPosts($allPostObjects) { ?>
        <div class="container px-5 pb-5">
            <div class="row">
                <h3 class="pb-3">Your Posts</h3>    
                <div class="post-container">
                    <?php 
                        //cycle through the post object array and display each post
                        foreach($allPostObjects as $post) {
                            echo '<div class="row border-bottom pb-2 px-2">';

                            echo '<div class="col-10 fs-5">';
                            echo $post->getPostContent();
                            echo '</div>';
                            echo '<div class="col-2 fst-italic">';
                            echo date("F j Y", $post->getPostDate());
                            echo '</div>';

                            echo "</div>";
                            echo "</br>";
                        }
                    ?>
                </div>
            </div>
        </div>    
     <?php }

    static function footer() { ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            </body>
        </html>
    <?php }
}

?>