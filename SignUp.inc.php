<?php
if(isset($_POST['submit'])){
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $insdate = date("Ymd");

    require_once 'dbh.php';
    require_once 'fncSU.inc.php';

    if(emptyInputSignUp($firstName, $lastName, $email, $password) != false){
        header("Location: auth.php?error1=emptyInput");
        exit();

    }if(invalidFN($firstName) != false){

        header("Location: auth.php?error1=invalidFirstName");
        exit();

    }if(invalidLN($lastName) != false){

        header("Location: auth.php?error1=invalidLastName");
        exit();

    }if(invalidEmail($email) != false){

        header("Location: auth.php?error1=invalidEmail");
        exit();

    }if(userExists($conn, $email) != false){

        header("Location: auth.php?error1=existingEmail");
        exit();

    }
        CreateUser($conn, $firstName, $lastName, $email, $password, $insdate, );
}else{
    header("Location: auth.php");
    exit();
}