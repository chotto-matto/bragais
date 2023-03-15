<?php 

function emptyInputSignUp($employeeID, $agentNo, $fname, $lname, $displayName, $email, $password, $confirmPassword)
{
    $result;
    if (empty($employeeID) || empty($agentNo) || empty($fname) || empty($lname) || empty($displayName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $result = true;
    }else {
        $result = false;
    }

    return $result;
}

function pwdMatch($password, $confirmPassword)
{
    $result;
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
    $result;
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
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    //hashes password
    $hashedPW = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssss", $employeeID, $agentNo, $fname, $lname, $displayName, $email, $hashedPW, $access);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();
}

function emptyInputLogIn($EID, $password)
{
    $result;
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

    if ($usernameExists === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $EIDExists["password"];
    $checkPassword = password_verify($password, $pwdHashed);

    if ($checkPassword === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }else if($checkPassword === true){
        session_start();
        $_SESSION["employee_id"] = $EIDExists["employee_id"];
        $_SESSION["display_name"] = $EIDExists["display_name"];
        header("location: ../index.php");
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
        $sql = "select * from factory_inventory";
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
                    <td>'.$row['Stock'].'</td>
                    <td>'.$row['Price'].'</td>
                    <td>'.$row['Status'].'</td>
                    <td>'.$row['DateTransferred'].'</td>
                </tr>';
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

        mysqli_stmt_bind_param($stmt, "sssssss", $model, $color, $size, $heelHeight, $categ, $price, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../edit-item.php?error=none");
        exit();
    }

    function transferProducts($con, $prodID, $dept)
    {
        $sql = "update factory_inventory set Status = ? where ProductID = ?";
        $stmt = mysqli_stmt_init($con);

        //checks if there is an error with the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../../manage-stock.php?error=updatestatementfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $dept, $prodID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../manage-stocks.php?error=none");
        exit();
    }

    function restockSearchItem($con, $prodID)
    {
        
    }


?>

