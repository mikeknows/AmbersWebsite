
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/normalize.css">
        <link rel ="stylesheet" href="css/main.css">
    </head>
</html>
<?php
require_once("inc/header.php");

//require_once('inc/functions.php');
require_once('inc/open_db.php');
?>
<!--<--https://phppot.com/php/simple-php-shopping-cart/-->
<?php

$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["code"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>

    
    <BODY1>
        <div id="shopping-cart">
            <div class="txt-heading">Shopping Cart <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a></div>
            <?php
            if (isset($_SESSION["cart_item"])) {
                $item_total = 0;
                ?>	
                <table cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th style="text-align:left;"><strong>Name</strong></th>
                            <th style="text-align:left;"><strong>Code</strong></th>
                            <th style="text-align:right;"><strong>Quantity</strong></th>
                            <th style="text-align:right;"><strong>Price</strong></th>
                            <th style="text-align:center;"><strong>Action</strong></th>
                        </tr>	
                        <?php
                        foreach ($_SESSION["cart_item"] as $item) {
                            ?>
                            <tr>
                                <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
                                <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
                                <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
                                <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$" . $item["price"]; ?></td>
                                <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
                            </tr>
                            <?php
                            $item_total += ($item["price"] * $item["quantity"]);
                        }
                        ?>

                        <tr>
                            <td colspan="5" align=right><strong>Total:</strong> <?php echo "$" . $item_total; ?></td>
                        </tr>
                    </tbody>
                </table>		
                <?php
            }
            require_once("inc/footer.html");
            ?>
        </div>

      
    </BODY1>




