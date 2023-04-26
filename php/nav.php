<?php
    echo '
    <div class="title"><h1>Factory Inventory</h1></div>
    <div class="nav">
    <ul>
        <h2>Hi '. $_SESSION['display_name'] .'!</h2>
        <br>
        <li><a href="index.php">Stock List</a></li>
        <li><a href="dev.php">Development</a></li>
        <li><a href="manage-stocks.php">Manage Stocks</a></li>
        <li><a href="restock.php">Restock</a></li>
        <li><a href="new-item.php">Register New Shoes</a></li>
        <li><a href="dev-item.php">Develop Shoes</a></li>
        <li><a href="edit-item.php">Edit Shoe Details</a></li>
        <li><a href="barcode.php">Print Barcode</a></li>
        <li><a href="logs.php">Logs</a></li>
        <li><a href="php/logout.php">Log Out</a></li>
    </ul>
</div>';
?>