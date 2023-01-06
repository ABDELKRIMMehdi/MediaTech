<?php
session_start();
require_once 'dbh.php';
$dateD = date("Ymd");
$dateF = date('Y-m-d', strtotime($dateD. ' + 1 months'));
if(isset($_POST['GMR'])){
    $abo="GMR";
    if($_SESSION["abonnement"]!="GMR" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'GMR' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
    }

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="GMR";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['WTC'])){
    $abo="WTC";
    if($_SESSION["abonnement"]!="WTC" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'WTC' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
}

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="WTC";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}


if(isset($_POST['RDR'])){
    $abo="RDR";
    if($_SESSION["abonnement"]!="RDR" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'RDR' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
}

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="RDR";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['GMW'])){
$abo="GMW";
if($_SESSION["abonnement"]!="GMW" && $_SESSION["abonnement"]!="not subscribed"){
    $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'GMW' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
}else if($_SESSION["abonnement"]=="not subscribed"){
$sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
}

$resultData = pg_query($conn, $sql);
if(pg_result_error($resultData)){
    header("Location: auth.php?error2=stmt1Failed");
    exit();
};

pg_query($conn, $sql);
$_SESSION["abonnement"]="GMW";
header("Location: index.php?error1=none");
pg_close($conn);
exit();
}

if(isset($_POST['GRD'])){
    $abo="GRD";
    if($_SESSION["abonnement"]!="GRD" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'GRD' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
    }

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="GRD";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['RDW'])){
    $abo="RDW";
    if($_SESSION["abonnement"]!="RDW" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'RDW' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
    }

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="RDW";
    header("Location: index.php?error1=none");
    pg_close($conn);
    exit();
}

if(isset($_POST['VIP'])){
    $abo="VIP";
    if($_SESSION["abonnement"]!="VIP" && $_SESSION["abonnement"]!="not subscribed"){
        $sql = "UPDATE \"sabonner/renouveler\" SET idabbo = 'VIP' WHERE \"id_C\" = '". $_SESSION["id"] . "' ;";
    }else if($_SESSION["abonnement"]=="not subscribed"){
    $sql = "INSERT INTO \"sabonner/renouveler\" VALUES('".$_SESSION["id"]."','". $abo . "','". $dateD ."','".$dateF."');";
    }

    $resultData = pg_query($conn, $sql);
    if(pg_result_error($resultData)){
        header("Location: auth.php?error2=stmt1Failed");
        exit();
    };

    pg_query($conn, $sql);
    $_SESSION["abonnement"]="VIP";
    header("Location: index.php?error7=none");
    pg_close($conn);
    exit();
}



