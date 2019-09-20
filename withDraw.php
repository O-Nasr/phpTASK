<?php
require 'DB.php';
?>
<!DOCTYPE HTML>
<html>
<?php
$dir = "Log In";
$href = "index.php";
include 'layout/header.php';
if(!isset($_SESSION['name'])){
    header("Location:index.php");
    exit();
}
$sum1 = "SELECT SUM(totalCost) as total FROM expenses";
$result = $conn->query($sum1);
$row1 = $result->fetch_assoc();
$row1 = $row1["total"];

$sum2 = "SELECT SUM(withdraw) as tot FROM withdraw";
$result1 = $conn->query($sum2);
$row2 = $result1->fetch_assoc();
$row2 = $row2["tot"];

$done = $row1 - $row2;

$withDErr="";
$withD = "";
$admin_id = $_SESSION["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["balance"])) {
        $withDErr = "required";
    }elseif ($_POST["balance"] > $done){
        $withDErr = "Not enough money";
    } else {
        $withD = test_input($_POST["balance"]);
        // check if name only contains letters and whitespace
    }


    if(empty($withDErr)){
        $sql = "INSERT INTO withdraw(admin_id, withdraw) VALUES('$admin_id','$withD')";
        $conn->query($sql);
        header("Location:withDrawControl.php");
    }


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<body>
<div class="container">

    <form class="specialForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div><p>Total Money:<?php echo $done?></p></div>
        <div class="input-group">
            <label>Withdraw the balance</label>
            <input type="number" name="balance" min="0">
            <span class="error">* <?php echo $withDErr;?></span>
        </div>
        <div class="input-group">
            <button class="btn1" type="submit" name="withDraw" >withDraw</button>
        </div>
    </form>
</div>
<?php include 'layout/footer.html'?>
</body>
</html>
