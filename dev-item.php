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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Develop Shoes</h2>
        <hr>
        <form action="php/actions/dev-new-item.php" method="POST">
            <label for="prodID">Product ID</label>
            <select name="prodID" id="prodID">
                <?php
                    prodIDdropDown($con);
                ?>
            </select>
            <label for="model-name">Model</label>
            <input type="text" name="model-name" id="model-name" placeholder="Model Name" readonly>
            <label for="color">Color</label>
            <input type="text" name="color" id="color" placeholder="Color" readonly> <br>
            <label for="size">Size</label>
            <input type="text" name="size" id="size" placeholder="Size" readonly>
            <label for="heel-height">Heel Height</label>
            <input type="text" name="heel-height" id="heel-height" placeholder="Heel Height" readonly>
            <label for="categ">Category</label>
            <input type="text" name="categ" id="categ" placeholder="Category" readonly> <br>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="Price" readonly>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>

            <button name="submit" type="submit">Add to Development</button>
        </form> 

        <div>
            <h3>Added Items</h3>
            <table class="general-table">
                <tr>
                    <th>Product ID</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <?php
                        displayDevelopCart($con);
                    ?>
                </tr>
            </table>

            <form action="php/actions/confirm-dev.php" method="POST">
                <button name="submit" type="submit">Confirm</button>
            </form>
        </div>
    </div>

    <script src="js/devdropdown.js"></script>
</body>
</html>