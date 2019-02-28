<?php
require_once('inc/open_db.php');
if (isset($_POST['btn-upload'])) {
    $dbhandler = new DBController();
    $file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "photos/";
//    $price = $_SESSION['price'];
//    $desc = $_SESSION['name'];

    // new file size in KB
    $new_size = $file_size;

    // make file name in lower case
    $new_file_name = strtolower($file);


    $final_file = str_replace(' ', '-', $new_file_name);


    if (move_uploaded_file($file_loc, $folder, $final_file)) {
        $dbhandler->runQuery("INSERT INTO products(file, type, size) VALUES('photos/$final_file','$file_type','$new_size')");
        ?>
        <script>
            alert('Product Successfully Added');
            window.location.href = 'index.php';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Error Adding Product');
            window.location.href = 'index.php';
        </script>
        <?php
    }
}
?>
