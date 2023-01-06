<?php
require_once "dbh.php";
session_start();

?>
<head>
<link rel="stylesheet" href="css/table.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

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
            


            




          </ul>
        </div>
      </div>
    </nav>

  </div>
</div>



<section>
        <h1>Rented Books :</h1>
        <div>
                <?php
                echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
                $tablename = "livres";
            
            
            $query = "SELECT * FROM ((SELECT \"idC\", \"idO\" FROM \"Louer\")OL JOIN \"livres\" J ON OL.\"idO\" = J.\"id_0\")JL NATURAL JOIN \"Oeuvre\" WHERE \"idC\" = '".$_SESSION["id"]."';";
            
            $rs = pg_query($conn, $query) or die("Cannot execute query: $query\n");
            echo("<thead><tr "."style=\"border: 1px solid;\"".">");
            for($k=0;$k<pg_num_fields($rs);$k++){
                echo("<th "."style=\"border: 1px solid;\"".">");
                echo(pg_field_name($rs, $k));
                echo("</th>");
            }
            echo("</tr></thead><tbody>");
            for($i=0;$i<pg_num_rows($rs);$i++){
                $row = pg_fetch_row($rs,$i );
                echo("<tr "."style=\"border: 1px solid;\"".">");
                for($j=0;$j<pg_num_fields($rs);$j++){
                    echo("<td "."style=\"border: 1px solid;\"".">");
                echo($row[$j]."\t");
                    echo("</td>");
                
            }echo("</tr>");}
            
                            echo("<tbody></table></div>");
                ?>
        </div>

        <h1>Rented games :</h1>
        <div>
        <?php
                echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
                $tablename = "jeux";
            
            
                $query = "SELECT * FROM ((SELECT \"idC\", \"idO\" FROM \"Louer\")OL JOIN \"jeux\" J ON OL.\"idO\" = J.\"id_0\")JL NATURAL JOIN \"Oeuvre\" WHERE \"idC\" = '".$_SESSION["id"]."';";
            
            $rs = pg_query($conn, $query) or die("Cannot execute query: $query\n");
            echo("<thead><tr "."style=\"border: 1px solid;\"".">");
            for($k=0;$k<pg_num_fields($rs);$k++){
                echo("<th "."style=\"border: 1px solid;\"".">");
                echo(pg_field_name($rs, $k));
                echo("</th>");
            }
            echo("</tr></thead><tbody>");
            for($i=0;$i<pg_num_rows($rs);$i++){
                $row = pg_fetch_row($rs,$i );
                echo("<tr "."style=\"border: 1px solid;\"".">");
                for($j=0;$j<pg_num_fields($rs);$j++){
                    echo("<td "."style=\"border: 1px solid;\"".">");
                echo($row[$j]."\t");
                    echo("</td>");
                
            }echo("</tr>");}
            
                            echo("<tbody></table></div>");
                ?>
        </div>

        <h1>Rented Movies :</h1>
        <div>
        <?php
                echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
                $tablename = "films";
            
            
                $query = "SELECT * FROM ((SELECT \"idC\", \"idO\" FROM \"Louer\")OL JOIN \"films\" J ON OL.\"idO\" = J.\"id_0\")JL NATURAL JOIN \"Oeuvre\" WHERE \"idC\" = '".$_SESSION["id"]."';";
            
            $rs = pg_query($conn, $query) or die("Cannot execute query: $query\n");
            echo("<thead><tr "."style=\"border: 1px solid;\"".">");
            for($k=0;$k<pg_num_fields($rs);$k++){
                echo("<th "."style=\"border: 1px solid;\"".">");
                echo(pg_field_name($rs, $k));
                echo("</th>");
            }
            echo("</tr></thead><tbody>");
            for($i=0;$i<pg_num_rows($rs);$i++){
                $row = pg_fetch_row($rs,$i );
                echo("<tr "."style=\"border: 1px solid;\"".">");
                for($j=0;$j<pg_num_fields($rs);$j++){
                    echo("<td "."style=\"border: 1px solid;\"".">");
                echo($row[$j]."\t");
                    echo("</td>");
                
            }echo("</tr>");}
            
                            echo("<tbody></table></div>");
                ?>
        </div>

        <h1>Rented Tv Shows :</h1>
        <div>
        <?php
                echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
                $tablename = "serie/animes";
            
            
                $query = "SELECT * FROM ((SELECT \"idC\", \"idO\" FROM \"Louer\")OL JOIN \"serie/animes\" J ON OL.\"idO\" = J.\"id_0\")JL NATURAL JOIN \"Oeuvre\" WHERE \"idC\" = '".$_SESSION["id"]."';";
            
            $rs = pg_query($conn, $query) or die("Cannot execute query: $query\n");
            echo("<thead><tr "."style=\"border: 1px solid;\"".">");
            for($k=0;$k<pg_num_fields($rs);$k++){
                echo("<th "."style=\"border: 1px solid;\"".">");
                echo(pg_field_name($rs, $k));
                echo("</th>");
            }
            echo("</tr></thead><tbody>");
            for($i=0;$i<pg_num_rows($rs);$i++){
                $row = pg_fetch_row($rs,$i );
                echo("<tr "."style=\"border: 1px solid;\"".">");
                for($j=0;$j<pg_num_fields($rs);$j++){
                    echo("<td "."style=\"border: 1px solid;\"".">");
                echo($row[$j]."\t");
                    echo("</td>");
                
            }echo("</tr>");}
            
                            echo("<tbody></table></div>");
                ?>
        </div>
            </section>

            <section>
                <h1>Rented Rooms :</h1>
                <?php
                echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
                $tablename = "Reserver";
            
            
            $query = "SELECT * FROM (SELECT \"idC\", \"NomSection\" FROM \"Reserver\" NATURAL JOIN \"privé\") R WHERE \"idC\" = '".$_SESSION["id"]."';"; 
            
            $rs = pg_query($conn, $query) or die("Cannot execute query: $query\n");
            echo("<thead><tr "."style=\"border: 1px solid;\"".">");
            for($k=0;$k<pg_num_fields($rs);$k++){
                echo("<th "."style=\"border: 1px solid;\"".">");
                echo(pg_field_name($rs, $k));
                echo("</th>");
            }
            echo("</tr></thead><tbody>");
            for($i=0;$i<pg_num_rows($rs);$i++){
                $row = pg_fetch_row($rs,$i );
                echo("<tr "."style=\"border: 1px solid;\"".">");
                for($j=0;$j<pg_num_fields($rs);$j++){
                    echo("<td "."style=\"border: 1px solid;\"".">");
                echo($row[$j]."\t");
                    echo("</td>");
                
            }echo("</tr>");}
            
                            echo("<tbody></table></div>");
                ?>
            </section>
        </body>