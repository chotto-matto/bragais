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
    <title>Edit Item</title>

    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Edit Item</h2>
        <hr>
        <form action="php/actions/update-item.php" method="POST" onkeydown="return event.key != 'Enter';">
            <label for="item-id">Item ID</label>
            <input type="text" name="item-id" id="item-id" placeholder="Item ID">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" placeholder="Model">
            <label for="size">Size</label>
            <input type="text" name="size" id="size" placeholder="Size"> <br>
            <label for="color">Color</label>
            <input type="text" name="color" id="color" placeholder="Color">
            <label for="heel-height">Heel Height</label>
            <input type="text" name="heel-height" id="heel-height" placeholder="Heel-height">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" placeholder="Category"> <br>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="Price">

            <button name="submit" type="submit">Confirm</button>
        </form> 
    </div>
    <script>
        $(document).keypress(
        function(event){
            if (event.which == '13') {
            event.preventDefault();
            }
        });
    </script>
</body>
</html>