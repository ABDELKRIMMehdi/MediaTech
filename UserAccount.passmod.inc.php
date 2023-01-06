<?php

        session_start();     
if(isset($_POST['submit'])){
    $oldPassword = $_POST['OldPassword'];
    $newPassword = $_POST['NewPassword'];

    require_once 'dbh.php';
    require_once 'fnc.inc.php';

if(password_verify($oldPassword, $_SESSION['password']) == false){
    header("Location: myaccount.php?error=wrongpassword2");
    exit();
}
$hashedpwd = password_hash($newPassword, PASSWORD_DEFAULT);
$sql = "UPDATE \"Client\" SET password ='".$hashedpwd."' WHERE \"id_C\" ='" . $_SESSION['id'] ."' ";

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
}else{
    header("Location: myaccount.php");
    exit();
}

