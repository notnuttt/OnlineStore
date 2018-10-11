<?php 

session_start();
include("conn.php");

$sql_query_food = "SELECT * FROM menu WHERE (name LIKE '%".$_GET["keyword"]."%' OR des LIKE '%".$_GET["keyword"]."%' )";
$query_food = mysqli_query($conn, $sql_query_food);

if($query_food){
    echo '<html>
        <body class="w3-content" style="max-width:1200px">
        <a href="index.php"><h3> Home </h3></a>
        <h1 align="center">Search Result</h1>
        <div class="w3-main" style="margin-left:250px">
        <div class="w3-row-padding">';
    while($array_food = mysqli_fetch_array($query_food)){
        $id = $array_food['id'];
        echo '
        <div class="w3-third w3-container">
        <div class="w3-display-container">
          <img src="'.$array_food['img'].'" style="width:100%; heigh:100%">
          <div class="w3-display-middle w3-display-hover">
              <button class="w3-button w3-black" onclick="document.getElementById(';
              echo "'".$id."').style.display='";
              echo "block'";
              echo '">Edit</button>';
              echo ' <form method="POST" action="remove.php">
                      <input type="hidden" value="'.$id.'" name="id">
              <input type="submit" value="Remove" class="w3-button w3-black">
              </form>
          </div>
          </div>
          <p>'.$array_food['name'].'<br><b>'.$array_food['price'].' Baht.</b></p>
        </div>';
      }
      echo '</div></div></body>
        </html>';

}else{
    
}

?>