<html>
<link rel="stylesheet" href="css/normalize.css">
<link rel ="stylesheet" href="css/main.css"> 
<?php

require('inc/open_db.php');
include_once('inc/functions.php');
include_once('inc/header.php');
//require 'session.php';
//require('login.php');
//if ($_SESSION['type'] == 'existing'){
if (isset($_SESSION['current_user'])) {
    if (isAdmin($db, $_SESSION['current_user'])) {
        echo "Welcome Admin";
    } else {
        echo "Client lacks privilages";
    }
} else {
    echo "not logged in";
}
?>
<?php
include_once 'inc/open_db.php';
?>


<body>

<label>Upload a Product</label>


 <form action="upload.php" method="post" enctype="multipart/form-data">
 <input type="file" name="file" />
 <input type="text" name="name"/>
 <input type="text" value="1" size="2" name="price"/>
 <p>Enter Product Description and Price</p>
 
 <button type="submit" name="btn-upload">upload</button>
 </form>
    <br /><br />
    <?php
 if(isset($_GET['success']))
 {
  ?>
        <label>Product Added Successfully</label>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <label>Problem Adding Product</label>
        <?php
 }
 else
 {
  ?>
        <label>REQUIRED:JPG, PNG UNDER 1 MB</label>
        <?php
 }
 ?>




</body>
</html>



