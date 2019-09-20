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
$nameErr = $totalErr = $costMemberErr ="";
$name = $total = $costMember= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["totalCost"])) {
        $totalErr = "required";
    } else {
        $total = test_input($_POST["totalCost"]);
    }

    if (empty($_POST["costForOneMember"])) {
        $costMemberErr = "required";
    } else {
        $costMember = test_input($_POST["costForOneMember"]);
    }

    if(empty($nameErr) && empty($totalErr) && empty($costMemberErr)){
        $sql = "INSERT INTO expenses(name, cost, totalCost) VALUES('$name','$costMember','$total')";
        $conn->query($sql);
        header("Location:main.php");
    }else{
        echo "not";
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
        <div class="input-group">
            <label>name</label>
            <input type="text" name="name">
            <span class="error">* <?php echo $nameErr;?></span>
        </div>
        <div class="input-group">
            <label>total cost</label>
            <input type="number" name="totalCost" min="0">
            <span class="error">* <?php echo $totalErr;?></span>
        </div>
        <div class="input-group">
            <label>cost for one member</label>
            <input type="number" name="costForOneMember" min="0">
            <span class="error">* <?php echo $costMemberErr;?></span>
        </div>
        <div class="input-group">
            <button class="btn1" type="submit" name="save" >save</button>
        </div>
    </form>
</div>
<?php include 'layout/footer.html'?>
</body>
</html>
