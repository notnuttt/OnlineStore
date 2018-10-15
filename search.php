<?php 

session_start();
include("conn.php");

$sql_query_food = "SELECT * FROM menu WHERE (name LIKE '%".$_GET["keyword"]."%' OR des LIKE '%".$_GET["keyword"]."%' )";
$query_food = mysqli_query($conn, $sql_query_food);

if($query_food){ ?>
    <html>
        <body class="w3-content" style="max-width:1200px">
        <a href="index.php"><h3> Home </h3></a>
        <h1 align="center">Search Result</h1>
        <div class="w3-main" style="margin-left:250px">
        <div class="w3-row-padding">

<?php   while($array_food = mysqli_fetch_array($query_food)){
        $id = $array_food['id']; ?>
        <div class="w3-third w3-container">
        <div class="w3-display-container">
          <img src="<?php echo $array_food['img'] ?>" style="width:100%; heigh:100%">
        </div>
          <p><?php echo $array_food['name']; ?><br><b><?php echo $array_food['price']; ?> Baht.</b></p>
        </div>
<?php } ?>
    </div></div></body>
    </html>

<?php }else{ ?>
    <html>
        <body class="w3-content" style="max-width:1200px">
        <a href="index.php"><h3> Home </h3></a>
        <div class="container" align="center">
            <h1 align="center">Search Result</h1>
            <p> No result from your keyword. </p>
        </div>
        </body>
    </html>

<?php } ?>