<?php

if(isset($_POST['SIsubmit'])){

    $email = $_POST['SIemail'];
    $password = $_POST['SIpassword'];

    require_once 'dbh.php';
    require_once 'fncSI.inc.php';

    if(emptyInputLogin($email, $password) !== false){

        header("Location: auth.php?error2=emptyInput");
        exit();

    }
    loginUser($conn, $email, $password);
}else{
    header("Location: auth.php?error2=unknown");
    exit();
}