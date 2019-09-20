<?php
require '../DB.php';
if ( isset($_POST['submit']) ) {
    if(isset($_GET['id']) && isset($_GET['cost'])){
        $id = $_GET['id'];
        $cost = $_GET['cost'];
        $clients = $_POST['client'];
        foreach ($clients as $cl) {
            $sql = "INSERT INTO paid (user_id,expenses_id,cost) VALUES ('$cl','$id','$cost')";
            $conn->query($sql);
            header("Location:../show.php?id=".$id."&cost=".$cost);
        }
    }
}
