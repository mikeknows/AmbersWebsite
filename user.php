<html>
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/normalize.css">
        <link rel ="stylesheet" href="css/main.css">
    </head>
</html>
<?php
require_once("inc/header.php");
require_once('inc/open_db.php');
$db_handle = new DBController();
if (isset($_SESSION['current_user'])) {
$orders = $db_handle->runQuery("SELECT * FROM orders WHERE username='" . $_SESSION["current_user"] . "'");
}else{
    $orders = null;
}

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/main.css" rel="stylesheet">
   

  </head>

  <body>
    
    
    <h2>Orders</h2>
    <?php if($orders) { ?>
    <table>
       <?php foreach($orders as $order){  ?>
        <tr>
          <td>ORDER - <?php echo $order->id; ?></td>
          <td><?php echo $order->product; ?></td>
          <td><?php echo $order->price; ?></td>
          
        </tr>
        <?php } ?>
    </table>
    <?php }  else { 
      echo 'No Previous Orders';?>
      <?php }
      require_once("inc/footer.html");?>

  </body>
  </html>

