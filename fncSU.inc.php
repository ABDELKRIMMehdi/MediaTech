<?php

function emptyInputSignUp($firstName, $lastName, $email, $password){
    $result;
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidFN($firstName){
    $result;
    if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidLN($lastName){
    $result;
    if(!preg_match("/^[a-zA-Z]*$/", $lastName)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}
function userExists($conn, $email){
    $sql = "SELECT * FROM \"Client\" WHERE email = '". $email . "' ;";
    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };
    $row = pg_fetch_assoc($resultData);
    if ($row){
        return $row;
    }else{
        $result = false;
        return $result;
    }
}
function CreateUser($conn, $firstName, $lastName, $email, $password, $insdate){

    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO \"Client\" (nom, prenom, email, password) VALUES ('".$firstName."', '".$lastName."', '".$email."', '".$hashedpwd."');";
    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };
    $row = pg_fetch_assoc($resultData);

    pg_query($conn, $sql);
    
    header("Location: auth.php?error1=none");
    pg_close($conn);
    exit();
}