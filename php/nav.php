<?php
    echo '<div class="nav">
    
    <ul>
        <h2>Hi '. $_SESSION['display_name'] .'</h2>
        <li><a href="index.php">Stock List</a></li>
        <li><a href="manage-stocks.php">Manage Stocks</a></li>
        <li><a href="restock.php">Restock</a></li>
        <li><a href="new-item.php">Add New Item</a></li>
        <li><a href="edit-item.php">Edit Item</a></li>
        <li><a href="barcode.php">Print Barcode</a></li>
        <li><a href="logs.php">Logs</a></li>
        <li><a href="php/logout.php">Log Out</a></li>
    </ul>
</div>';
?>