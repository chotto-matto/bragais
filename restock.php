<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restock</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Restock</h2>
        <hr>
        <h4>*You can either select or scan the item ID using Barcode Scanner</h4>

        <form id="restock-form" action="">
            <label for="id-dropdown">Select Item ID:</label>
            <select name="id-dropdown" id="id-dropdown">
                <option value="Item ID" selected>Item ID</option>
            </select>
            <label for="id-scan">Scan Item ID</label>
            <input type="text" name="id-scan" id="id-scan">
            <button>Confirm</button>
            <br>
            <h4>Product Details</h4>
            <table class="general-table">
                <tr>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Heel Height</th>
                    <th>Stock</th>
                </tr>
                <tr>
                    <td>Shoe 1</td>
                    <td>6</td>
                    <td>Color 1</td>
                    <td>6.5 Inches</td>
                    <td>5</td>
                </tr>
            </table>
            <br>
            <label for="restock-quantity">Quantity to be Restocked</label>
            <input type="number">

            <button type="submit">Restock</button>
            <br>

        </form>

    </div>
</body>
</html>