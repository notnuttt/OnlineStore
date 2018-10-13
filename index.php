<?php
error_reporting(0);
ini_set('display_errors', 0);
  session_start();
  include("conn.php");
  echo $_SESSION['name'];
  echo $_SESSION['status'];

  $sql_query_food = 'SELECT * FROM MENU WHERE 1';
  $query_food = mysqli_query($conn, $sql_query_food);
  $query_food2 = mysqli_query($conn, $sql_query_food);
  
?>
<!DOCTYPE html>

<html>
<title>N&N Café</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>N&N Café</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <!-- <a href="food.php" class="w3-bar-item w3-button">Food</a>
    <a href="dessert.php" class="w3-bar-item w3-button">Dessert</a> -->
    <a href="#" class="w3-bar-item w3-button">Menu</a>
    
    <!--a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
      Jeans <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
      <a href="#" class="w3-bar-item w3-button">Relaxed</a>
      <a href="#" class="w3-bar-item w3-button">Bootcut</a>
      <a href="#" class="w3-bar-item w3-button">Straight</a>
    </div>
    <a href="#" class="w3-bar-item w3-button">Jackets</a>
    <a href="#" class="w3-bar-item w3-button">Gymwear</a>
    <a href="#" class="w3-bar-item w3-button">Blazers</a>
    <a href="#" class="w3-bar-item w3-button">Shoes</a-->
  </div>

</nav>

<!-- Top menu on small screens
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header> -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <!-- <p class="w3-left">Beverage</p> -->
    <p class="w3-right">

      <?php

        if($_SESSION['status'] == 'admin'){            
          echo '<button onclick="document.getElementById(';
          echo "'addItem').style.display='block'";
          echo '" > Add+ </button>';
          
        }else if($_SESSION['status'] == 'user'){
          echo '<i class="fa fa-shopping-cart w3-margin-right"></i>';
        }

      ?>
       <i class="fa fa-search"  onclick="document.getElementById('search').style.display='block'"></i> 

       
      <?php
        if($_SESSION['status'] == NULL){
          echo '<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById(';
          echo "'login').style.display='block'";
          echo '">Login</a> ';
        }else{
          echo '<a class="w3-bar-item w3-button w3-padding" href="logout.php"> Logout </a>';
        }
        ?>
    </p>

    
  </header>



  <!-- Product grid -->
  <div class="w3-row-padding">
  
  <?php
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
  ?>
  </div>
    

  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

  <!-- End page content -->
</div>

<!-- Login Modal -->
<div id="login" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide" >LOGIN</h2>
      <p style="align:center">Please login to continue.</p>
      <form method="POST" action="login.php">
        <p><input class="w3-input w3-border" type="text" placeholder="Enter Username" name="username"></p>
        <p><input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password"></p>
        <input type="submit" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('login').style.display='none'" value="Login">

      </form>
      
    </div>
  </div>
</div>

<!-- Search Modal -->
<div id="search" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('search').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide" >WANNA SEARCH SOMETHING?</h2>
      <form method="GET" action="search.php">
        <p><input class="w3-input w3-border" type="text" placeholder="Search" name="keyword"></p>
        <input type="submit" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('search').style.display='none'" value="Search">

      </form>
      
    </div>
  </div>
</div>

<!-- AddItem Modal -->
<div id="addItem" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('addItem').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide" >Add New ITEM</h2>
      <p style="align:center">Please fill the item details.</p>
      <form method="POST" action="addItem.php" enctype="multipart/form-data">
        <p><input class="w3-input w3-border" type="text" placeholder="Enter Name" name="itemName"></p>
        <p><input class="w3-input w3-border" type="text" placeholder="Price" name="price"></p>
        <p><input class="w3-input w3-border" type="text" placeholder="Enter Desciption (If any)" name="itemDes"></p>
        <p><input class="w3-input w3-border" type="file" placeholder="Enter Image path" name="imgage"></p>
        <input type="submit" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('addItem').style.display='none'" value="Add Item">

      </form>
      
    </div>
  </div>
</div>

<!-- Item Modal -->
<?php
      while($array_food = mysqli_fetch_array($query_food2)){
        $id = $array_food['id'];
       echo '<div id="'.$id.'" class="w3-modal">
          <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
            <div class="w3-container w3-white w3-center">
              <i onclick="document.getElementById(';
              echo "'".$id."').style.display='none'";
              echo '" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
              <h2 class="w3-wide" >Add New ITEM</h2>
              <p style="align:center">Please fill the item details.</p>
              <form method="POST" action="update.php" enctype="multipart/form-data">
              <input type ="hidden" name="id" value="'.$id.'">
                <p><input class="w3-input w3-border" type="text" placeholder="Enter Name" name="itemName" value="'.$array_food['name'].'"></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Price" name="price" value="'.$array_food['price'].'"></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Enter Desciption (If any)" name="itemDes" value="'.$array_food['des'].'"></p>
                <p><input class="w3-input w3-border" type="file" placeholder="Enter Image path" name="imgage"></p>
                <input type="submit" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById(';
                echo "'".$id."').style.display='none'";
                echo '" value="Update">
                </form>
      
              </div>
            </div>
          </div>';
      }

?>


<script>
// Accordion 
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>