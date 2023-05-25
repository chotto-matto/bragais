<?php 

date_default_timezone_set("Asia/Shanghai");

function emptyInputSignUp($employeeID, $agentNo, $fname, $lname, $displayName, $email, $password, $confirmPassword)
{
    $result = '';
    if (empty($employeeID) || empty($agentNo) || empty($fname) || empty($lname) || empty($displayName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $result = true;
    }else {
        $result = false;
    }

    return $result;
}

function pwdMatch($password, $confirmPassword)
{
    $result = '';
    if ($password !== $confirmPassword) {
        $result = true;
    }else {
        $result = false;
    }

    return $result;
}

function EIDexists($con, $employeeID)
{
    $sql = "select * from employee where employee_id= ?;";
    $stmt = mysqli_stmt_init($con);

    //checks if there is an error with the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $employeeID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function invalidEmail($email)
{
    $result = '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else {
        $result = false;
    }

    return $result;
}

function createUser($con, $employeeID, $agentNo, $fname, $lname, $displayName, $email, $password, $access)
{
    $sql = "insert into employee (employee_id, agent_no, fname, lname, display_name, email, password, employee_access) values (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);

    //checks if there is an error with the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../sign-in.php?error=stmtfailed");
        exit();
    }
    //session_start();
    //addLog($con, "Account created", "Employee #" . $employeeID, date('m d yy'));

    //hashes password
    $hashedPW = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssss", $employeeID, $agentNo, $fname, $lname, $displayName, $email, $hashedPW, $access);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../sign-in.php?error=none");
    exit();
}

function emptyInputLogIn($EID, $password)
{
    $result = '';
    if (empty($EID) || empty($password)) {
        $result = true;
    }else {
        $result = false;
    }

    return $result;
}

function loginUser($con, $EID, $password)
{
    $EIDExists = EIDexists($con, $EID);

    if ($EIDExists === false) {
        header("location: ../../index.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $EIDExists["password"];
    $checkPassword = password_verify($password, $pwdHashed);

    if ($checkPassword === false) {
        header("location: ../../index.php?error=wronglogin");
        exit();
    }else if($checkPassword === true){
        session_start();
        $_SESSION["employee_id"] = $EIDExists["employee_id"];
        $_SESSION["display_name"] = $EIDExists["display_name"];
        addLog($con, "Logged In", "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));
        header("location: ../../index.php");
        exit();
    }
}

function displayEmployees($con)
{
    $sql = "select * from employee";
    $stmt = mysqli_stmt_init($con);

    //checks if there is an error with the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ./index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($resultData)) {
        echo '
        <tr>
        <form action="php/actions/update-access.php" method="post">
            <td>'.$row['employee_id'].'</td>
            <td>'.$row['agent_no'].'</td>
            <td>'.$row['fname'].'</td>
            <td>'.$row['lname'].'</td>
            <td>'.$row['display_name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['employee_access'].'</td>
            <td>
                <input type="hidden" name="employee_id" id="employee_id" value='.$row['employee_id'].'>
                <select name="emp-access" id="emp-access">
                <option value="" disabled selected>Select Access Type</option>
                <option value="Admin">Admin</option>
                <option value="Main Office Inventory Manager">Main Office Inventory Manager</option>
                <option value="Factory Operations Manager">Factory Operations Manager</option>
                <option value="Factory Secretary">Factory Secretary</option>
                <option value="Sales Manager">Sales Manager</option>
                <option value="Sales Agent">Sales Agent</option>
                <option value="Accounting">Accounting</option>
                <option value="Logistics Manager">Logistics Manager</option>
                </select>
                <button type="submit" name="submit" id="submit">Update</button>
            </td>
        </form>
        </tr>';
    }
    
    mysqli_stmt_close($stmt);
}

function updateAccess($con, $accessType, $EID)
{
    $sql = "update employee set employee_access = ? where employee_id = ?";
    $stmt = mysqli_stmt_init($con);

    //checks if there is an error with the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../account-management.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $accessType, $EID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../account-management.php?error=none");
    exit();
}

    //For showing stocks on Stock List page
    function displayStocks($con){
        $sql = "select * from factory_inventory where not status = 'Unlisted'";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<tr>
                    <td>'.$row['ProductID'].'</td>
                    <td>'.$row['Model'].'</td>
                    <td>'.$row['Size'].'</td>
                    <td>'.$row['Color'].'</td>
                    <td>'.$row['HeelHeight'].'</td>
                    <td>'.$row['Category'].'</td>
                    <td>'.$row['Stock'].'</td>
                    <td>₱'.$row['Price'].'</td>
                </tr>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function displayDevelopment($con){
        $sql = "select * from development";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./dev.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<tr>
                    <td>'.$row['BatchID'].'</td>
                    <td>'.$row['ProductID'].'</td>
                    <td>'.$row['Model'].'</td>
                    <td>'.$row['Color'].'</td>
                    <td>'.$row['Size'].'</td>
                    <td>'.$row['HeelHeight'].'</td>
                    <td>'.$row['Category'].'</td>
                    <td>₱'.$row['Price'].'</td>
                    <td>'.$row['Quantity'].'</td>
                    <td>'.$row['Status'].'</td>
                    <td>'.$row['LastUpdate'].'</td>
                </tr>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function prodIDdropDown($con){
        $sql = "select * from factory_inventory where not status = 'Unlisted'";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./dev.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<option value="'.$row["ProductID"].'">'.$row["ProductID"].'</option>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function batchIDDropdown($con){
        $sql = "select * from development";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./dev.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<option value="'.$row["BatchID"].'">'.$row["BatchID"].'</option>';
        }
        
        mysqli_stmt_close($stmt);
    }
    //For adding new products
    function insertProducts($con, $prodID, $model, $size, $color, $heelHeight, $quantity, $categ, $price, $status, $dateTransferred){

        $sql = "insert into factory_inventory(ProductID, Model, Color, Size, HeelHeight, Category, Price, Stock, Status, DateTransferred) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../new-item.php?error=insertsttmntfailed");
            exit();
        }
        session_start();
        addLog($con, "Created New Product " . $prodID, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "ssssssssss", $prodID, $model, $color, $size, $heelHeight, $categ, $price, $quantity, $status, $dateTransferred);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../../new-item.php?error=none");
        exit();
    
    }

    //For updating product details
    function updateProducts($con, $prodID, $model, $size, $color, $heelHeight, $categ, $price)
    {
        $sql = "update factory_inventory set Model = ?, Color = ?, Size = ?, HeelHeight = ?, Category = ?, Price = ? where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../edit-item.php?error=updatestatementfailed");
            exit();
        }
        session_start();
        addLog($con, "Updated Product " . $prodID, "Employee #" . $_SESSION["employee_id"], date('m d yy'));

        mysqli_stmt_bind_param($stmt, "sssssss", $model, $color, $size, $heelHeight, $categ, $price, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../edit-item.php?error=none");
        exit();
    }

    function transferProducts($con, $prodID, $dept)
    {
        $sql = "update development set Status = ? where BatchID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../manage-stock.php?error=updatestatementfailed");
            exit();
        }
        session_start();
        addLog($con, "Transferred Product " . $prodID . " to " . $dept, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "ss", $dept, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../manage-stocks.php?error=none");
        exit();
    }

    function restockSearchItem($con, $prodID)
    {
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../restock.php?error=updatestatementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../restock.php?prod_id=".$prodID."");
        exit();
    }

    function displayRestockSearchedItem($con, $prodID)
    {
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./restock.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {
            
            echo '<input type="hidden" id="prodID" name="prodID" value="'.$prodID.'">
            <table class="general-table">
                    <tr>
                        <th>Model</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Heel Height</th>
                        <th>Stock</th>
                    </tr>
                    <tr>
                        <td>'.$row['Model'].'</td>
                        <td>'.$row['Size'].'</td>
                        <td>'.$row['Color'].'</td>
                        <td>'.$row['HeelHeight'].'</td>
                        <td>'.$row['Stock'].'</td>
                    </tr>
                </table>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function addStocks($con, $quantity, $prodID)
    {
        $sql = "update factory_inventory set Stock = Stock + ? where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../restock.php?error=updatestatementfailed");
            exit();
        }
        session_start();
        addLog($con, "Restocked Item " . $prodID, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "ss", $quantity, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../restock.php?prod_id=".$prodID."");
        exit();
    }

    function barcodeSearchItem($con, $prodID)
    {
        include 'barcode128.php';
        date_default_timezone_set("Asia/Hong_Kong");
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../barcode.php?error=updatestatementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../barcode.php?prod_id=".$prodID."");
        exit();
    }

    function displayBarcodeItem($con, $prodID)
    {
        
        include 'barcode128.php';
        date_default_timezone_set("Asia/Hong_Kong");
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../barcode.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {
            
            echo '<input type="hidden" id="prodID" name="prodID" value="'.$prodID.'">
            <table class="general-table">
                <tr>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Heel Height</th>
                </tr>
                <tr>
                    <td>'.$row['Model'].'</td>
                    <td>'.$row['Size'].'</td>
                    <td>'.$row['Color'].'</td>
                    <td>'.$row['HeelHeight'].'</td>
                </tr>
            </table>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function displayBarcode($con, $prodID)
    {
        
        include 'barcode128.php';
        date_default_timezone_set("Asia/Hong_Kong");
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../barcode.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {
        
            echo '<input type="hidden" id="model" name="model" value="'.$row['Model'].'">
            <input type="hidden" id="product_id" name="product_id" value="'.$prodID.'">
            <input type="hidden" id="price" name="price" value="'.$row['Price'].'">
            <h4 id="print-prev">Print Preview</h4>
            <div id="content2-sub">
                <h4>ITEM: '.$row['Model'].'</h4>
                <h4>--'.bar128(stripcslashes($prodID)).'--</h4>
                <h4>PRICE: '.$row['Price'].'</h4>
            </div>';
        
        }
        
    }

    function addLog($con, $logAction, $user, $date)
    {
        $date = date('Y/m/d');

        $sql = "insert into inventory_logs(log_action, user, date_logged) values (?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../logs.php?error=insertsttmntfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $logAction, $user, $date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function displayLogs($con)
    {
        $sql = "select * from inventory_logs order by log_id desc";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../logs.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {
            echo '
            <tr>
            <td>'.$row["log_id"].'</td>
            <td>'.$row["log_action"].'</td>
            <td>'.$row["user"].'</td>
            <td>'.$row["date_logged"].'</td>
            </tr>';
        }
    }

    function updateItemListing($con, $prodStat, $prodID)
    {
        $sql = "update factory_inventory set Status = ? where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../manage-stock.php?error=updatestatementfailed");
            exit();
        }
        session_start();
        addLog($con, "Changed Product " . $prodID . " status to " . $prodStat, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "ss", $prodStat, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../manage-stocks.php?error=none");
        exit();
    }

    function displayUnlistedProducts($con)
    {
        $sql = "select * from factory_inventory where status = 'Unlisted'";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../manage-stocks.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<tr>
                    <td>'.$row['ProductID'].'</td>
                    <td>'.$row['Model'].'</td>
                    <td>'.$row['Size'].'</td>
                    <td>'.$row['Color'].'</td>
                    <td>'.$row['HeelHeight'].'</td>
                    <td>'.$row['Stock'].'</td>
                    <td>'.$row['Price'].'</td>
                    <td>'.$row['Status'].'</td>
                    <td>'.$row['DateTransferred'].'</td>
                </tr>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function developDisplayFromDropdown($con, $prodID)
    {
        $sql = "select * from factory_inventory where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../manage-stocks.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $prodID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
 
    function insertToDevelopPending($con, $prodID, $model, $size, $color, $heelHeight, $quantity, $categ, $price, $status, $lastUpdate){
  
        $sql = "insert into development_pending(ProductID, Model, Color, Size, HeelHeight, Category, Price, Quantity, Status, LastUpdate) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=insertsttmntfailed");
            exit();
        }
        session_start();
        addLog($con, "Added To Develop Pending" . $prodID, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "ssssssssss", $prodID, $model, $color, $size, $heelHeight, $categ, $price, $quantity, $status, $lastUpdate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../../dev-item.php?error=none");
        exit();
    
    }

    function displayDevelopCart($con){
        $sql = "select * from development_pending";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {

            // foreach ($row as $columnName => $columnData) {
            //     echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
            // }
            
            echo '<tr>
                    <td>'.$row['ProductID'].'</td>
                    <td>'.$row['Model'].'</td>
                    <td>'.$row['Color'].'</td>
                    <td>'.$row['Size'].'</td>
                    <td>'.$row['Quantity'].'</td>
                </tr>';
        }
        
        mysqli_stmt_close($stmt);
    }

    function cartToDevelop($con)
    {
        $sql = "select * from development_pending";
        $stmt = mysqli_stmt_init($con);
        $batchID =  generateBatchID($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) {
            insertToDevelop($con, $batchID, $row["ProductID"], $row["Model"], $row["Color"], $row["Size"], $row["HeelHeight"], $row["Category"], $row["Price"], $row["Quantity"], $row["Status"], $row["LastUpdate"]);
        }
        
        truncateTableDevPending($con);
        mysqli_stmt_close($stmt);
        header("location: ../../dev-item.php?error=none");
        exit();
    }

    function insertToDevelop($con, $BatchID, $prodID, $model, $size, $color, $heelHeight, $quantity, $categ, $price, $status, $lastUpdate){
  
        $sql = "insert into development(BatchID, ProductID, Model, Color, Size, HeelHeight, Category, Price, Quantity, Status, LastUpdate) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=insertsttmntfailed");
            exit();
        }
        session_start();
        addLog($con, "Added To Develop Pending" . $prodID, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        mysqli_stmt_bind_param($stmt, "sssssssssss", $BatchID, $prodID, $model, $color, $size, $heelHeight, $categ, $price, $quantity, $status, $lastUpdate);
        mysqli_stmt_execute($stmt);
    
    }

    function insertToDevelop2($con, $prodID, $model, $size, $color, $heelHeight, $quantity, $categ, $price, $status, $lastUpdate){
  
        $sql = "insert into development(ProductID, Model, Color, Size, HeelHeight, Category, Price, Quantity, Status, LastUpdate) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=insertsttmntfailed");
            exit();
        }
        //session_start();
        //addLog($con, "Created New Product " . $prodID, "Employee #" . $_SESSION["employee_id"], date('m/d/Y'));

        if (count($prodID) > 1 && count($prodID) !== 0) {
            for ($i=0; $i < count($prodID) - 1; $i++) { 
                mysqli_stmt_bind_param($stmt, "ssssssssss", current($prodID), current($model), current($color), current($size), current($heelHeight), current($categ), current($price), current($quantity), current($status), current($lastUpdate));
                mysqli_stmt_execute($stmt);
            }
        }elseif (count($prodID) == 1 && count($prodID) !== 0) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $prodID, $model, $color, $size, $heelHeight, $categ, $price, $quantity, $status, $lastUpdate);
            mysqli_stmt_execute($stmt);
        }

        
        mysqli_stmt_close($stmt);
        header("location: ../../dev-item.php?error=none");
        exit();
    
    }

    function truncateTableDevPending($con){
  
        $sql = "truncate table development_pending";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../dev-item.php?error=insertsttmntfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../../dev-item.php?error=none");
        exit();
    
    }

    function generateBatchID($con)
    {
        $monthCode = getMonth(date('n'));
        $yearCode = getYear(date('y'));
        $lastRecord = getMaxRecord($con);
        $lastRecordMod = 0;

        if ($lastRecord["maximumIndex"] < 10) {
            $lastRecordMod = "0000" . $lastRecord["maximumIndex"];
        }else if ($lastRecord["maximumIndex"] >= 10) {
            $lastRecordMod = "000" . $lastRecord["maximumIndex"];
        }else if ($lastRecord["maximumIndex"] >= 100) {
            $lastRecordMod = "00" . $lastRecord["maximumIndex"];
        }else if ($lastRecord["maximumIndex"] >= 1000) {
            $lastRecordMod = "0" . $lastRecord["maximumIndex"];
        }else {
            $lastRecordMod = $lastRecord["maximumIndex"];
        }

        $batchCode = $monthCode . "A" . $yearCode . $lastRecordMod;

        return $batchCode;

    }

    function getMonth($monthIndex)
    {
        switch ($monthIndex) {
            case 1:
                return $monthValue = "A";
                break;
            case 2:
                return $monthValue = "B";
                break;
            case 3:
                return $monthValue = "C";
                break;
            case 4:
                return $monthValue = "D";
                break;
            case 5:
                return $monthValue = "E";
                break;
            case 6:
                return $monthValue = "F";
                break;
            case 7:
                return $monthValue = "G";
                break;
            case 8:
                return $monthValue = "H";
                break;
            case 9:
                return $monthValue = "I";
                break;
            case 10:
                return $monthValue = "J";
                break;
            case 11:
                return $monthValue = "K";
                break;
            case 12:
                return $monthValue = "L";
                break;
        }
    }

    function getYear($yearIndex)
    {
        $startingYear = 23;
        $yearCal = $yearIndex - $startingYear;

        switch ($yearCal) {
            case 0:
                return $monthValue = "A";
                break;
            case 1:
                return $monthValue = "B";
                break;
            case 2:
                return $monthValue = "C";
                break;
            case 3:
                return $monthValue = "D";
                break;
            case 4:
                return $monthValue = "E";
                break;
            case 5:
                return $monthValue = "F";
                break;
            case 6:
                return $monthValue = "G";
                break;
            case 7:
                return $monthValue = "H";
                break;
            case 8:
                return $monthValue = "I";
                break;
            case 9:
                return $monthValue = "J";
                break;
        }
    }

    function getMaxRecord($con)
    {
        $sql = "select count(distinct BatchID) as maximumIndex from development";

        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../edit-item.php?error=updatestatementfailed");
            exit();
        }
        //session_start();
        //addLog($con, "Updated Product " . $prodID, "Employee #" . $_SESSION["employee_id"], date('m d yy'));

        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
?>