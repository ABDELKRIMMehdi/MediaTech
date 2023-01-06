<?php
require_once 'dbh.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/landing.css">
</head>
<body>
  <div class="navbar-wrapper">
    <div class="container">

      <nav class="navbar navbar-light navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            <a class="navbar-brand brand-name" href="index.php">La MediaTech.</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              <?php
    if(isset($_SESSION["id"])){
        echo("<li id =\"userButton\" class=\"dropdown\">
        <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa-solid fa-user\"></i>\t" .$_SESSION["firstname"] ." ". $_SESSION["lastname"] . "<span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href=\"myaccount.php\">My Account</a></li>
            <li><a href=\"oeuvresetsalles.php\">My Reservations</a></li>
            <li role=\"separator\" class=\"divider\"></li>
            <li><a href=\"logout.php\">Log Out</a></li>
          </ul>
        </li>");
    }else{
    echo("<li id=\"userButton\">
    <a href=\"auth.php\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa-solid fa-user\"></i>\tLog In</a>
    </li>");
    }?>
            </ul>
          </div>
        </div>
      </nav>

    </div>
  </div>


  <!-- Carousel
    ================================================== -->
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
      <li data-target="#myCarousel" data-slide-to="6"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="fill first-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Video Games.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'GMR';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our gaming rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"]!= "GMR"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"GMR\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"GMR\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
              
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill second-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>movies.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'WTC';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our cinema rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"]!= "WTC"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"WTC\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"WTC\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill third-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>books.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'RDR';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our libraries for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"]!= "RDR"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"RDR\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"RDR\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill fourth-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>movies and videogames.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'GMW';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our cinema and gaming rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"]!= "GMW"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"GMW\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"GMW\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill fifth-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>books and videogames.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'GRD';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our libaries and gaming rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"]!= "GRD"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"GRD\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"GRD\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill sixth-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>movies and books.</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'RDW';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our cinema and library rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"] != "RDW"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"RDW\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"RDW\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="fill seventh-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>VIP PASS</h1>
              <p><?php
              $sql = "SELECT \"prix\", \"idabbo\", \"count\" FROM \"abonnement\" NATURAL JOIN (SELECT \"idabbo\", count(\"id_C\") FROM \"sabonner/renouveler\" GROUP BY \"idabbo\") R2 WHERE \"idabbo\" = 'VIP';";
              $resultData = pg_query($conn, $sql);
              if(pg_result_error($resultData)){
                  header("Location: index.php?error2=stmt1Failed");
                  exit();
              };
              while($row = pg_fetch_assoc($resultData)){
                echo("Join our ".$row["count"]." subscribers today and get unlimited access to all our rooms for only $".$row["prix"]." a month");
              };
              ?></p>
              <?php if(isset($_SESSION["id"])){
              if(isset($_SESSION["abonnement"])){
                if($_SESSION["abonnement"] != "VIP"){
                                        echo("<form action=\"subscribe.php\" method=\"post\"><p><button  class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"VIP\">Subscribe now !</button></p></form>");
                                       }else{
                                        echo("<form action=\"unsubscribe.php\" method=\"post\"><p><button class=\"btn btn-lg btn-primary\" role=\"button\" type=\"submit\" name=\"VIP\">unsubscribe!</button></p></form>");
                                       }
                                       }
                                       }?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- Marketing messaging and featurettes
    ================================================== -->

  <div class="container marketing">
    <section class="page-section" id="services">
            <div class="containerL">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">OUR MOST RENTED</h2>
                    <h3 class="section-subheading text-muted">The very top 5 of each of what we have to offer</h3>
                </div>
                
                <div class="row text-center">
                <div class="col-md-4">
                        <h4 class="my-3">Videogames</h4>
                        <ul><?php
                                        $sql = $sql = "SELECT \"idO\", \"count\", \"titre\" FROM (SELECT \"idO\", count(\"idO\") FROM (\"Louer\" L JOIN (\"jeux\" NATURAL JOIN \"Oeuvre\") OT ON L.\"idO\" = OT.\"id_0\")GROUP BY \"idO\") R JOIN \"Oeuvre\" O ON R.\"idO\" = O.\"id_0\" ORDER BY (\"count\") DESC FETCH FIRST 5 ROWS ONLY;";
                                        $resultData = pg_query($conn, $sql);
                                        if(pg_result_error($resultData)){
                                            header("Location: index.php?error2=stmt1Failed");
                                            exit();
                                        };
                                        while($row = pg_fetch_assoc($resultData)){
                                            echo("<li><p class=\"text-muted\">".$row["titre"]."</p></li>");
                                        };
                                        ?>
                                        <li><a href="vg.php"><p>>>See more...</p></a></li>
                        </ul>
                        
                    </div>
                    <div class="col-md-4">
                        <h4 class="my-3">books</h4>
                        <ul><?php
                                        $sql = $sql = "SELECT \"idO\", \"count\", \"titre\" FROM (SELECT \"idO\", count(\"idO\") FROM (\"Louer\" L JOIN (\"livres\" NATURAL JOIN \"Oeuvre\") OT ON L.\"idO\" = OT.\"id_0\")GROUP BY \"idO\") R JOIN \"Oeuvre\" O ON R.\"idO\" = O.\"id_0\" ORDER BY (\"count\") DESC FETCH FIRST 5 ROWS ONLY;";
                                        $resultData = pg_query($conn, $sql);
                                        if(pg_result_error($resultData)){
                                            header("Location: index.php?error2=stmt1Failed");
                                            exit();
                                        };
                                        while($row = pg_fetch_assoc($resultData)){
                                            echo("<li><p class=\"text-muted\">".$row["titre"]."</p></li>");
                                        };
                                        ?>
                                        <li><a href="books.php"><p>>>See more...</p></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4 class="my-3">Movies</h4>
                        <ul><?php
                                        $sql = $sql = "SELECT \"idO\", \"count\", \"titre\" FROM (SELECT \"idO\", count(\"idO\") FROM (\"Louer\" L JOIN (\"films\" NATURAL JOIN \"Oeuvre\") OT ON L.\"idO\" = OT.\"id_0\")GROUP BY \"idO\") R JOIN \"Oeuvre\" O ON R.\"idO\" = O.\"id_0\" ORDER BY (\"count\") DESC FETCH FIRST 5 ROWS ONLY;";
                                        $resultData = pg_query($conn, $sql);
                                        if(pg_result_error($resultData)){
                                            header("Location: index.php?error2=stmt1Failed");
                                            exit();
                                        };
                                        while($row = pg_fetch_assoc($resultData)){
                                            echo("<li><p class=\"text-muted\">".$row["titre"]."</p></li>");
                                        };
                                        ?>
                                        <li><a href="movies.php"><p>>>See more...</p></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4 class="my-3">Animé /Tv Shows</h4>
                        <ul><?php
                                        $sql = $sql = "SELECT \"idO\", \"count\", \"titre\" FROM (SELECT \"idO\", count(\"idO\") FROM (\"Louer\" L JOIN (\"serie/animes\" NATURAL JOIN \"Oeuvre\") OT ON L.\"idO\" = OT.\"id_0\")GROUP BY \"idO\") R JOIN \"Oeuvre\" O ON R.\"idO\" = O.\"id_0\" ORDER BY (\"count\") DESC FETCH FIRST 5 ROWS ONLY;";
                                        $resultData = pg_query($conn, $sql);
                                        if(pg_result_error($resultData)){
                                            header("Location: index.php?error2=stmt1Failed");
                                            exit();
                                        };
                                        while($row = pg_fetch_assoc($resultData)){
                                            echo("<li><p class=\"text-muted\">".$row["titre"]."</p></li>");
                                        };
                                        pg_close();
                                        ?>
                                        <li><a href="anime.php"><p>>>See more...</p></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    <footer>
      <p class="pull-right"><a href="#">Back to top</a></p>
      <p>Projet BDD-RX. &middot; <a href="#">Thomas Fernandez</a> &middot; <a href="#">Mehdi Abdelkrim</a></p>
    </footer>

  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://getbootstrap.com/docs/3.3/assets/js/vendor/holder.min.js"></script>
</body>
</html>