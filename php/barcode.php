<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="window.print();">
	<div style="margin-left: 5%">
		<?php
			include 'barcode128.php';
			include_once 'config.php';
			include_once 'functions.php';
			$model = $_POST['model'];
			$product_id = $_POST['product_id'];
			$price = $_POST['price'];

			for($i=1;$i<=$_POST['barcode-quantity'];$i++){
				echo "<p class='inline'><span ><b>Item: $model</b></span>".bar128(stripcslashes($_POST['product_id']))."<span ><b>Price: ".$price." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
			}

			addLog($con, "Printed Barcode");

		?>
	</div>
</body>
</html>