<?php
        session_start();     
      
if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['Password'];

    require_once 'dbh.php';
    require_once 'fnc.inc.php';

    if(emptyInputSignUp($firstName, $lastName, $email, $password) !== false){

        header("Location: myaccount.php?error=emptyInput");
        exit();

    }if(invalidFN($firstName) !== false){

        header("Location: myaccount.php?error=invalidFirstName");
        exit();

    }if(invalidLN($lastName) !== false){

        header("Location: myaccount.php?error=invalidLastName");
        exit();

    }if(invalidEmail($email) !== false){

        header("Location: myaccount.php?error=invalidEmail");
        exit();

    }
    global $unchanged;
    if(userExists($conn, $email, $unchanged) !== false){
        if($unchanged == false){
            header("Location: myaccount.php?error=existingEmail");
            exit();
        }
    }
        updateUser($conn, $firstName, $lastName, $email, $password);
        session_unset();
session_destroy();
header("Location: index.php");
        exit();
 
}else{
    header("Location: myaccount.php");
    exit();
}