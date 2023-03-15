<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php
        include_once 'php/nav.php';
    ?>
    <div class="main-content">
        <h2>Print Barcode</h2>
        <hr>
        <div class="sub-content">
            <div id="content1">
                <form action="">
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
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" placeholder="Price">

                    <button type="submit">Confirm</button>
                </form>
            </div>
            <div id="content2">
                <h4 id="print-prev">Print Preview</h4>
                <div id="content2-sub">
                    <h4>ITEM: Shoe 1</h4>
                    <h4>--BARCODE HERE--</h4>
                    <h4>ID: 16397816283769817</h4>
                    <h4>PRICE: P2000</h4>
                </div>
                <button>Print</button>
            </div>
        </div>
    </div>


    <form class="form-horizontal" method="post" action="php/barcode.php" target="_blank">
        <label class="control-label col-sm-2" for="product">Product:</label>
        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product">
        <label class="control-label col-sm-2" for="product_id">Product ID:</label>
        <input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id">
        <label class="control-label col-sm-2" for="rate">Rate</label>
        <input autocomplete="OFF" type="text" class="form-control" id="rate"  name="rate">
        <label class="control-label col-sm-2" for="print_qty">Barcode Quantity</label>
        <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty"  name="print_qty">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</body>
</html>