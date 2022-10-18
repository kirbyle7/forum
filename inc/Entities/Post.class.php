<?php
//this class will store information that the user posts to their profile

class Post {
    private int $postId;
    private string $postContent;
    private string $postDate;
    private int $userId; //foregin key to reference user table

    //property getters and settters
    public function getPostContent() {
        return $this->postContent;
    }
    public function getPostId() {
        return $this->postId;
    }
    public function getPostDate() {
        return $this->postDate;
    }

    public function setContents(string $newContents) {
        $this->postContent = $newContents;
    }
    public function setPostDate($date) {
        $this->postDate = $date;
    }

    //foregin key getter and setter
    public function getUserId() {
        return $this->userId;
    }
    public function setUserId(int $nUserId) {
        $this->userId = $nUserId;
    }

}
?>