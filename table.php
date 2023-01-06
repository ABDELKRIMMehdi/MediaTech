<?php   
session_start();
require_once "dbh.php";
?>

<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="css/table.css">
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
            <li class="active"><a href="logout.php">Log Out</a></li>
            


            




          </ul>
        </div>
      </div>
    </nav>

  </div>
</div>
<h1 style="text-align : center">DEBUG PANNEL</h1>
<form method="post">
<label for="tableList">Choose a table:</label>
<select name="tableList" id="tableList">
    <?php
    $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema='public' AND table_type='BASE TABLE';";
    $rs = pg_query($conn, $sql) or die("Cannot execute query: $sql\n");

    if(pg_result_error($rs)){
        header("Location: table.php?error=stmt1Failed");
        exit();
    };

    while($row = pg_fetch_assoc($rs)){
    echo("<option value=\"".$row["table_name"]."\">".$row["table_name"]."</option>");
    }
  ?>
</select>

<input type="submit" name="submit"></input>
</form>

<?php
if(isset($_POST['submit'])){
    
    echo("<div class=\"table-wrapper\"><table class=\"fl-table\">");
    $tablename = $_POST["tableList"];

    echo("<h1>".$tablename." :</h1>");

$query = "SELECT * FROM \"".$tablename."\""; 

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
}
                echo("<tbody></table></div>");
                 pg_close($conn);
                 ?>



</body>   
</html>    