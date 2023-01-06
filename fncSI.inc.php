<?php

function emptyInputLogin($email, $password){
    $result;
    if(empty($email) || empty($password)){
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

function loginUser($conn, $email, $password){
    $userExists = userExists($conn, $email);

    if($userExists === false){
        header("Location: auth.php?error2=EmailNotFound");
        exit();
    }

    $hashedpwd = $userExists["password"];
    $checkPwd = password_verify($password, $hashedpwd);
    if ($checkPwd === false){
        header("Location: auth.php?error2=WrongPassword");
        exit();
    }elseif ($checkPwd === true) {
        session_start();
        $_SESSION["id"] = $userExists["id_C"];
        $_SESSION["password"] = $userExists["password"];
        $_SESSION["firstname"] = $userExists["prenom"];
        $_SESSION["lastname"] = $userExists["nom"];
        $_SESSION["email"] = $userExists["email"];


        $sql2 = "SELECT idabbo FROM \"sabonner/renouveler\" WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
        $resultData = pg_query($conn, $sql2);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt2Failed");
        exit();
    };
    $row = pg_fetch_assoc($resultData);
    if ($row){
    $_SESSION["abonnement"]= $row["idabbo"];
    }else{
        $_SESSION["abonnement"]= "not subscribed";
    }

    if($_SESSION["id"] == '1'){
        header("Location: table.php");
        pg_close($conn);
        exit();
    }
        
        header("Location: index.php");
        pg_close($conn);
        exit();
    }
}