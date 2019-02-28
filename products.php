<html>
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/normalize.css">
        <link rel ="stylesheet" href="css/main.css">
    </head>
</html>
<?php
require("inc/header.php");


?>
<div id="product-grid">
   
    <?php
   
    
    require_once('inc/open_db.php');
    $db_handle = new DBController();

    $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
            <div class="product-item">
                <form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <div class="product-image"><img src="<?php echo $product_array[$key]["file"]; ?>"></div>
                    <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
                    <div class="product-price"><?php echo "$" . $product_array[$key]["price"]; ?></div>
        <?php
        
//        if (isset($_SESSION['current_user'])) {
            echo '<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>';
//
//        } else {            
//            header('location:login_start.php');
//        }
//        ?>

                </form>
            </div>
        <?php
    }
}
//require("inc/footer.html");
?>
</div>


