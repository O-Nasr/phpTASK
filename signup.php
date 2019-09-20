<?php
require 'DB.php';
?>
<!DOCTYPE HTML>
<html>
<?php
$dir = "Log In";
$href = "index.php";
include 'layout/header.php';
if(isset($_SESSION['name'])){
    header("Location:main.php");
    exit();
}
$nameErr = $fullErr = $passErr ="";
$name = $full = $pass= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userName"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["userName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["userFullName"])) {
        $fullErr = "Full name is required";
    } else {
        $full = test_input($_POST["userFullName"]);
    }

    if (empty($_POST["userPass"])) {
        $passErr = "Password is required";
    } else {
        $pass = test_input($_POST["userPass"]);
    }

    if(empty($nameErr) && empty($fullErr) && empty($passErr)){
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin(username, password, fullname) VALUES('$name','$hashedPass','$full')";
        $conn->query($sql);
        header("Location:index.php");
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
            <input type="text" name="userName">
            <span class="error">* <?php echo $nameErr;?></span>
        </div>
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="userFullName">
            <span class="error">* <?php echo $fullErr;?></span>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="userPass">
            <span class="error">* <?php echo $passErr;?></span>
        </div>
        <div class="input-group">
            <button class="btn1" type="submit" name="signUp" >Sign Up</button>
        </div>
    </form>
</div>
<?php include 'layout/footer.html'?>
</body>
</html>
