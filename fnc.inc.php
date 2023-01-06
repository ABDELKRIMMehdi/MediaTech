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
$unchanged = false;
function userExists($conn, $email, $unchanged){ 
    global $unchanged;
    if($email == $_SESSION["email"]){
       $unchanged = true;
    }
    $sql = "SELECT * FROM \"Client\" WHERE email = '".$email."';";
    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: myaccount.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    if ($row = pg_fetch_assoc($resultData)){
        if($unchanged){
        return $row;
        }else if($unchanged == false){
            return true;
        }
    }else{
        $result = false;
        return $result;
    }
}


function updateUser($conn, $firstName, $lastName, $email, $password){
    $userExists = userExists($conn, $email, $unchanged);
    if($userExists === true){
        header("Location: myaccount.php?error=EmailTaken");
        exit();
    }else if($userExists === false){

        $sql = "SELECT * FROM \"Client\" WHERE email = '".$email."';";
        $resultData = pg_query($conn, $sql);
        if(pg_result_error($resultData)){
            header("Location: myaccount.php?error2=stmt1Failed");
            exit();
        };
    
        pg_query($conn, $sql);
        $row = pg_fetch_assoc($resultData);

        $row["password"];
        $hashedpwd = $row["password"];
        $checkPwd = password_verify($password, $hashedpwd);
    }else{
        $hashedpwd = $userExists["password"];
        $checkPwd = password_verify($password, $hashedpwd);
    }
    if ($checkPwd === false){
        header("Location: myaccount.php?error=WrongPassword");
        exit();
    }
    $sql = "UPDATE \"Client\" SET nom = '".$lastName."', prenom = '".$firstName."', email = '".$email."' WHERE \"id_C\" ='" . $_SESSION['id'] ."' ";
    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: myaccount.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    
    session_unset();
    session_destroy();
    pg_close($conn);
    header("Location: index.php");
    exit();
}