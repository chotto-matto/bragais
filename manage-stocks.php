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
    <link rel="stylesheet" href="css/manage-stock.css">
</head>
<body>

    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Manage Stock</h2>
        <hr>
        <button class="manage-stock-btn" id="transfer-btn">Transfer Stocks to Other Dept.</button>
        <button class="manage-stock-btn" id="unlist-btn">Unlist Products</button>
        <button class="manage-stock-btn" id="relist-btn">Relist Products</button>

        <div id="popup" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Transfer Stocks to other Department</h2>
                <hr>
                <form action="php/actions/transfer-stocks.php" method="post">
                    <label for="item-id">Item ID:</label>
                    <input type="text" id="item-id" name="item-id">
                    <!-- <label for="quantity">Quantity to be transferred:</label>
                    <input type="text" id="quantity" name="quantity"> -->
                    <label for="dept">Department to be transferred to:</label>
                    <select name="dept" id="dept">
                        <option value="In Department 1">Department 1</option>
                        <option value="In Department 2">Department 2</option>
                        <option value="In Department 3">Department 3</option>
                        <option value="In Department 4">Department 4</option>
                        <option value="In Department 5">Department 5</option>
                        <option value="In Department 6">Department 6</option>
                        <option value="In Department 7">Department 7</option>
                        <option value="In Department 8">Department 8</option>
                        <option value="In Department 9">Department 9</option>
                        <option value="In Department 10">Department 10</option>
                    </select>
                    <button type="submit" name="submit" id="submit">Confirm</button>
                </form>
            </div>
        </div>
        <div id="popup-unlist" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Unlist Products</h2>
                <hr>
                <form action="php/actions/list-update.php" method="post">
                    <label for="item-id">Item ID:</label>
                    <input type="text" id="item-id" name="item-id">
                    <input type="hidden" name="status" value="Unlisted">
                    <button type="submit" name="submit" id="submit">Confirm</button>
                </form>
            </div>
        </div>
        <div id="popup-relist" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Relist Products</h2>
                <hr>
                <form action="php/actions/list-update.php" method="post">
                    <label for="item-id">Item ID:</label>
                    <input type="text" id="item-id" name="item-id">
                    <input type="hidden" name="status" value="Pending">
                    <button type="submit" name="submit" id="submit">Confirm</button>
                </form>
            </div>
        </div>
        <div class="stock-sub-content1">
            <!-- <h3 id="pull-out-title">Pulled Out Products</h3>
            <table class="general-table">
                <tr>
                    <th>Item ID</th>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Heel Height</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Current Status</th>
                    <th>Date Pulled Out</th>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Shoe 7</td>
                    <td>8</td>
                    <td>Color 5</td>
                    <td>6.5 inches</td>
                    <td>20</td>
                    <td>P2500</td>
                    <td>Pulled Out</td>
                    <td>02/16/2023</td>
                </tr>
            </table> -->
        </div>

        <div class="stock-sub-content1">
            <h3 id="pull-out-title">Unlisted Products</h3>
            <table class="general-table">
                <tr>
                    <th>Item ID</th>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Heel Height</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Current Status</th>
                    <th>Date Unlisted</th>
                </tr>
                <?php
                    displayUnlistedProducts($con)
                ?>
            </table>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("popup");
        var modalUnlist = document.getElementById("popup-unlist");
        var modalRelist = document.getElementById("popup-relist");

        // Get the button that opens the modal
        var btn = document.getElementById("transfer-btn");
        var btnUnlist = document.getElementById("unlist-btn");
        var btnRelist = document.getElementById("relist-btn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var spanUnlist = document.getElementsByClassName("close")[1];
        var spanRelist = document.getElementsByClassName("close")[2];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        btnUnlist.onclick = function() {
            modalUnlist.style.display = "block";
        }

        btnRelist.onclick = function() {
            modalRelist.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        spanUnlist.onclick = function() {
            modalUnlist.style.display = "none";
        }

        spanRelist.onclick = function() {
            modalRelist.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                modalUnlist.style.display = "none";
                modalRelist.style.display = "none";
            }
        }
    </script>
</body>
</html>