<?php
    include_once 'php/loginvalidator.php';
    include_once 'php/config.php';
    include_once 'php/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Add New Item</h2>
        <hr>
        <form action="php/actions/add-new-item.php" method="POST">
            <label for="prodID">Product ID</label>
            <input type="text" name="prodID" id="prodID" placeholder="Product ID">
            <label for="model-name">Model</label>
            <input type="text" name="model-name" id="model-name" placeholder="Model Name">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" placeholder="Color"> <br>
            <label for="size">Size</label>
            <input type="text" name="size" id="size" placeholder="Size">
            <label for="heel-height">Heel Height</label>
            <input type="text" name="heel-height" id="heel-height" placeholder="Heel Height">
            <label for="categ">Category</label>
            <input type="text" name="categ" id="categ" placeholder="Category"> <br>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="Price">
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity" placeholder="Quantity">

            <button name="submit" type="submit">Confirm</button>
        </form> 
    </div>
</body>
</html>