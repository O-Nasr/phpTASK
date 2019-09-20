<?php
require 'DB.php';
?>
<!doctype html>
<htmal>
    <?php
    $dir = "Sign Up";
    $href = "signup.php";
    include 'layout/header.php';
    if(isset($_SESSION['name'])){
        header("Location:main.php");
    }
    $nameErr = $passErr ="";
    $name = $pass= "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["userName"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["userName"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["userPass"])) {
                $passErr = "Password is required";
            } else {
                $pass = test_input($_POST["userPass"]);
            }

            if(empty($nameErr) && empty($passErr)){
                $sql = "SELECT * FROM admin WHERE username = '$name'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $hashedPassCheck = password_verify($pass, $row['password']);
                    if($hashedPassCheck == false){
                        $passErr = "password is not correct";
                    }elseif ($hashedPassCheck == true){
                        $_SESSION['name'] = $row['fullname'];
                        $_SESSION['id'] = $row['Id'];
                        header("Location:main.php");
                    }
                }
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
                    <label>Password</label>
                    <input type="password" name="userPass">
                    <span class="error">* <?php echo $passErr;?></span>
                </div>
                <div class="input-group">
                    <button class="btn1" type="submit" name="login" >Login</button>
                </div>
            </form>
        </div>
    <?php include 'layout/footer.html'?>
    </body>
</htmal>
