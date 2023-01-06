<?php
session_start();

require_once "dbh.php";

if(isset($_POST['GMR'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['WTC'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}



if(isset($_POST['RDR'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['GMW'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['GRD'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['RDW'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['VIP'])){
    $sql = "DELETE FROM \"sabonner/renouveler\" WHERE \"id_C\" = '".$_SESSION["id"]."';";


    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="not subscribed";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}