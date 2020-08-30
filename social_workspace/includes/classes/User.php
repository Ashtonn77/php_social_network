<?php

class User {

    private $user;
    private $connect;
    public function __construct($connect, $user){

        $this->connect = $connect;
        $user_details_query = mysqli_query($connect, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);

    }

    public function get_username(){
        return $this->user['username'];
    }

    public function get_num_posts(){

        $username = $this->user['username'];
        $num_posts_query = mysqli_query($this->connect, "SELECT num_posts FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($num_posts_query);

        return $row['num_posts']; 

    }

    public function get_first_and_last_name(){

        $username = $this->user['username'];
        $first_last_name_query = mysqli_query($this->connect, "SELECT first_name, last_name FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($first_last_name_query);
        return $row['first_name'] . " " . $row['last_name'];

    }

    public function get_profile_pic(){

        $username = $this->user['username'];
        $profile_pic_query = mysqli_query($this->connect, "SELECT profile_pic FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($profile_pic_query);
        $profile_pic = $row['profile_pic'];
        $profile_pic = substr(strrchr($profile_pic, "/"), 1);   

        return  "./resources/images/profile_pics/defaults/" . $profile_pic;

    }

    public function is_closed(){

        $username = $this->user['username'];
        $query_isClosed = mysqli_query($this->connect, "SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query_isClosed);

        if($row['user_closed'] == 'yes'){
            return true;
        }
        else{
            return false;
        }

    }

    public function is_friend($username_to_check){
        $username_comma = "," . $username_to_check . ",";
        if((strstr($this->user['friends_array'], $username_comma)) || $username_to_check == $this->user['username']){
            return true;
        }
        return false;
    }


}


?>