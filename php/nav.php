<?php
    echo '
    <div class="title"><h1>Factory Inventory</h1></div>
    <nav class="navigation">
    <h2>Hi '. $_SESSION['display_name'] .'!</h2>
        <ul class="mainmenu">
            <li><a>Stock Lists</a>
                <ul class="submenu">
                    <li><a href="index.php">Overall Stocks</a></li>
                    <li><a href="dev.php">Development Monitoring</a></li>
                </ul>
            </li>
            <li><a>Stock Management</a>
                <ul class="submenu">
                    <li><a href="manage-stocks.php">Manage Stocks</a></li>
                    <li><a href="restock.php">Restock</a></li>
                </ul>
            </li>
            <li><a>Product Management</a>
                <ul class="submenu">
                    <li><a href="new-item.php">Register New Shoes</a></li>
                    <li><a href="edit-item.php">Edit Shoe Details</a></li>
                </ul>
            </li>
            <li><a href="dev-item.php">Develop Shoes</a></li>
            <li><a href="barcode.php">Print Barcode</a></li>
            <li><a href="logs.php">Logs</a></li>
            <li><a href="php/logout.php">Log Out</a></li>
        </ul>
    </nav>';
?>