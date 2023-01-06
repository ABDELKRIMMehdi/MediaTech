<?php

        session_start();     
      
if(isset($_POST['submit'])){
    $Password = $_POST['Password'];

    require_once 'dbh.php';

    if(password_verify($Password, $_SESSION['password']) == false){
        header("Location: myaccount.php?error=wrongpassword3");
        exit();
    }else{
        $sql = "DELETE FROM \"Louer\" WHERE \"idC\" ='". $_SESSION["id"]."';";

        $resultData = pg_query($conn, $sql);
        if(pg_result_error($resultData)){
            header("Location: myaccount.php?error2=stmt1Failed");
            exit();
        };

        pg_query($conn, $sql);

        $sql = "DELETE FROM \"Reserver\" WHERE \"idC\" ='". $_SESSION["id"]."';";

        $resultData = pg_query($conn, $sql);
        if(pg_result_error($resultData)){
            header("Location: myaccount.php?error2=stmt1Failed");
            exit();
        };

        $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" ='". $_SESSION["id"]."';";

        $resultData = pg_query($conn, $sql);
        if(pg_result_error($resultData)){
            header("Location: myaccount.php?error2=stmt1Failed");
            exit();
        };

        pg_query($conn, $sql);

        $sql = "DELETE FROM \"Client\" WHERE \"id_C\" ='". $_SESSION["id"]."';";

        $resultData = pg_query($conn, $sql);
        if(pg_result_error($resultData)){
            header("Location: myaccount.php?error2=stmt1Failed");
            exit();
        };

        pg_query($conn, $sql);



        $sql = "DELETE FROM \"Client\" WHERE \"id_C\" ='". $_SESSION["id"]."';";

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
    }}else{
        header("Location: myaccount.php");
        exit();
    }