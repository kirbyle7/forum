<?php

//this class will handle database queries for post objects
class PostDAO {
    private static $_db;
    
    //initilize pdo
    static function initialize() {
        self::$_db = new PDOAgent('Post');
    }
    
    //get post from the database
    static function getPost(string $postId) {
        $sql = 'SELECT * FROM POSTS WHERE postId = :nPostId;';

        self::$_db->query($sql);

        self::$_db->bind("nPostId", $postId);

        self::$_db->execute();

        return self::$_db->singleResult();
    }

    //get all posts from the POSTS table
    static function getAllPosts(string $userId) {
        $sql = 'SELECT * FROM POSTS WHERE userId = :nid;';
        
        self::$_db->query($sql);

        self::$_db->bind(":nid", $userId);

        self::$_db->execute();

        return self::$_db->getResultSet();
    }

    //add a post to the database
    static function addPost($postObject) {
        $sql = 'INSERT INTO POSTS (postContent, postDate, userId) 
            VALUES (:nPostContent, :nPostDate, :nUserId);';

        self::$_db->query($sql);

        self::$_db->bind(":nPostContent", $postObject->getPostContent());
        self::$_db->bind(":nPostDate", $postObject->getPostDate());
        self::$_db->bind(":nUserId", $postObject->getUserId());

        self::$_db->execute();

        return self::$_db->lastInsertId();
    }
}

?>