<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel ="stylesheet" href="css/main.css">
    </head>
    <header>

        <nav>
            <ul>
                <li2><a href ="index.php"><img src ="photos/home.gif" width="50"height=="50"></a></li2>


                <li><a href ="products.php">Available Jewelry</a></li>
                <li>
                    <?php
                    session_start();
                    include_once("inc/open_db.php");
                    include_once("inc/functions.php");
                    if (isset($_SESSION['current_user'])) {
                        if (isAdmin($db, $_SESSION['current_user'])) {
                            echo '<li><a href ="admin.php">Admin</a></li>';
                        }
                    }
                    ?> 
                </li>
                <li><a href ="user.php">Previous Orders</a></li>
                <li><a href ="cart.php">Checkout/Cart</a></li>
                <li1><?php
                    require_once("inc/open_db.php");
                    if (isset($_SESSION['current_user'])) {
                        echo '<form id="loginBtn" action = "logout.php"><input type="submit" value="Logout"/></form>';
                    } else {
                        echo '<form id="loginBtn" action = "login_start.php"><input type="submit" value="Login/Register"/></form>';
                    }
                    ?>
                </li1>
            </ul>

        </nav>
        <h1>Welcome, <?php
            include_once("inc/open_db.php");
            include_once("inc/functions.php");
            if (isset($_SESSION['current_user'])) {
                echo '<font color="pink">' . $_SESSION['current_user'] . '</font>' . '. Thanks for logging in, you can check your past orders by clicking the link above';
                if (isAdmin($db, $_SESSION['current_user'])) {
                    echo '. <font color = "yellow">Administrative Privileges</font>';
                }
            } else {
                echo 'Guest. Please feel free to log in by clicking the link at the top right, if you do so you will be able to keep track of your previous orders.';
            }
            ?></h1>




    </header>
</html>