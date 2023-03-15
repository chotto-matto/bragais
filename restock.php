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
        include_once 'php/config.php';
        include_once 'php/functions.php';
    ?>
    <div class="main-content">
        <h2>Restock</h2>
        <hr>
        <h4>*You can either type or scan the item ID using Barcode Scanner</h4>

        <form id="restock-form" action="php/actions/restock-search.php" method="post">
            <label for="id-scan">Scan Item ID</label>
            <input type="text" name="id-scan" id="id-scan">
            <button type="submit" name="submit" id="submit">Confirm</button>
        </form>


        <form action="php/actions/add-stock.php" method="post">
            <br>
            <h4>Product Details</h4>
            <?php
            
                if (isset($_GET["prod_id"])) {
                    displayRestockSearchedItem($con, $_GET["prod_id"]);
                }else{
                    echo '<table class="general-table">
                        <tr>
                            <th>Model</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Heel Height</th>
                            <th>Stock</th>
                        </tr>
                        <tr>
                            <td>Select Item ID</td>
                            <td>Select Item ID</td>
                            <td>Select Item ID</td>
                            <td>Select Item ID</td>
                            <td>Select Item ID</td>
                        </tr>
                    </table>';
                }
            ?>

            <br>
            <label for="restock-quantity">Quantity to be Restocked</label>
            <input type="number" id="restock-quantity" name="restock-quantity">

            <button type="submit" name="submit">Restock</button>
            <br>
        </form>
    </div>
</body>
</html>