<?php
  session_start();
  require_once "dbh.php";
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<link rel="stylesheet" href="css/search.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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



<h1 style = "text-align : center;">Check out our entire tv shows list</h1>
<section class="one">
<form class="clearfix searchform" method="post">
  <label for="search-box">
    <span class="fa fa-search fa-flip-horizontal fa-2x"></span>
  </label>
  <input name="search" type="search" id="search-box" placeholder="Looking for something ?" />
</form>
</section>

<?php
if(isset($_POST["search"])){
echo("<section class=\"two\">");
$searchF=$_POST["search"];
$query="SELECT * FROM \"serie/animes\" NATURAL JOIN \"Oeuvre\" WHERE \"titre\" LIKE '%". $searchF."%' OR CAST(\"categorie\" AS text) LIKE '%". $searchF."%' OR \"realisateur\" LIKE '%". $searchF."%';";


echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");

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
                 pg_close($conn);
echo("</section>");
}?>
</body>
</html>