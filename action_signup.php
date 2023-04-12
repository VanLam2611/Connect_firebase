<?php
include("config.php");
include("firebaseRDB.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if($email == ''){
    echo "Email is required";
}else if($name == ''){
    echo "Name is required";
}else if($password == ''){
    echo "Password is required";
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "email", "equal", $email);
    $data = json_decode($retrieve, 1);

    if(isset($data['email'])){
        echo "Email already used";
    }else{
        $insert = $rdb->insert("/user",[
            "name" => $name,
            "email" => $email,
            "password" => $password,
        ]);

        $result = json_decode($insert, 1);
        if(isset($result['name'])){
            echo "Sign up success, please login";
        }
        else{
            echo "Sign up fail";
        }
    }
}