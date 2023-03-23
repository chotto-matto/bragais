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
    <title>Home</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/barcode.css">
</head>
<body>

    <?php
        include_once 'php/nav.php';
        include_once 'php/config.php';
        include_once 'php/functions.php';
    ?>
    <div class="main-content">
        <h2>Print Barcode</h2>
        <hr>
        <div class="sub-content">
            <div id="content1">
                <form action="php/actions/barcode-search.php" method="post">
                    <label for="id-scan">Item ID</label>
                    <input type="text" name="id-scan" id="id-scan" placeholder="Item ID">
                    <button type="submit" name="submit" id="submit">Confirm</button>
                </form>

                <?php
                    if ($_GET["prod_id"] != "" || $_GET["prod_id"] != null) {
                        displayBarcodeItem($con, $_GET["prod_id"]);

                    }else{
                        echo '<table class="general-table">
                                <tr>
                                    <th>Model</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Heel Height</th>
                                </tr>
                                <tr>
                                    <td>Select Item ID</td>
                                    <td>Select Item ID</td>
                                    <td>Select Item ID</td>
                                    <td>Select Item ID</td>
                                </tr>
                            </table>';
                    }
                ?>
                
            </div>

            <div id="content2">
                <form action="php/barcode.php" method="post">
                    <?php
                        if ($_GET["prod_id"] != "" || $_GET["prod_id"] != null) {
                            displayBarcode($con, $_GET["prod_id"]);
                            echo '<label for="barcode-quantity">Quantity: </label>
                            <input type="number" name="barcode-quantity" id="barcode-quantity" placeholder="Quantity">
                            
                            <button type="submit" name="submit">Print</button>';
                        }else{
                            echo '<h4 id="print-prev">Print Preview</h4>
                            <div id="content2-sub">
                                <h4>ITEM: Select Item ID</h4>
                                <h4>--Select Item ID--</h4>
                                <h4>ID: Select Item ID</h4>
                                <h4>PRICE: Select Item ID</h4>
                            </div>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>