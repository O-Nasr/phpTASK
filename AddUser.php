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
$nameErr = $flatErr = "";
$name = $flat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["flat"])) {
        $flatErr = "required";
    } else {
        $flat = test_input($_POST["flat"]);
        $sql = "SELECT * FROM user WHERE flatNum = '$flat'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $flatErr = "this flat exist already";
        }
    }

    if(empty($nameErr) && empty($flatErr)){
        $sql = "INSERT INTO user(UserName, flatNum) VALUES('$name','$flat')";
        $conn->query($sql);
        header("Location:main.php");
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
            <label>flat number</label>
            <input type="number" name="flat" min="0">
            <span class="error">* <?php echo $flatErr;?></span>
        </div>
        <div class="input-group">
            <button class="btn1" type="submit" name="save" >save</button>
        </div>
    </form>
</div>
<?php include 'layout/footer.html'?>
</body>
</html>
