<!--from userControl.php-->
<?php
require '../DB.php';
if (isset($_GET["id"]) ) {
    $id = $_GET["id"];
    $sql = "DELETE FROM user WHERE Id= '$id'";
    $conn->query($sql);
    header("Location:../userControl.php");
}
