<?php
require 'DB.php';
?>
<!doctype html>
<htmal>
    <?php
        include 'layout/header.php';
        if(!isset($_SESSION['name'])){
            header("Location:index.php");
            exit();
        }
    ?>
    <div class="container">
        <?php
            if(isset($_GET['id']) && isset($_GET['cost'])){
                $x = 1;
                $id = $_GET['id'];
                $cost = $_GET['cost'];
                $sql = "select user.UserName, paid.date, paid.cost 
                        from paid
                        inner join user on user.id = paid.user_id 
                        where paid.expenses_id = $id";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo '<h1>That paid</h1>';
                    echo '<table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>date</th>
                                    <th>cost</th>
                                </tr>
                            </thead>';
                    while ($row = $result->fetch_assoc()){
                        echo '
                            <tr>
                                <td>'.$row["UserName"].'</td>
                                <td>'.$row["date"].'</td>
                                <td>'.$row["cost"].'</td>
                            </tr>
                        ';
                    }
                    echo '</table>';
                }

                $sql = "SELECT * FROM USER WHERE Id NOT IN(SELECT user_id FROM paid WHERE expenses_id = '$id')";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo'<h1>That not paid</h1>';
                    echo'<form method="POST" action="include/insert.inc.php?id='.$id.'&cost='.$cost.'">';
                        echo '<table class="table">
                                <thead>
                                    <tr>
                                        <th>check</th>
                                        <th>Name</th>
                                        <th>#num</th>
                                    </tr>
                                </thead>';
                        while ($row = $result->fetch_assoc()){
                            echo '
                                    <tr>
                                        <td><input type="checkbox" id="client" name="client[]" value="'.$row["Id"].'"></td>
                                        <td>'.$row["UserName"].'</td>
                                        <td>'.$x++.'</td>
                                    </tr>
                                
                            ';
                        }
                        echo '</table>';
                        echo '<input type="hidden" value="'.$id.'">';
                        echo '<input type="submit" id="submit" name="submit" value="submit values" class="btn btn-primary">';
                    echo '</form>';
                }
            }
        ?>
    </div>
    <?php include 'layout/footer.html'?>
    </body>
</htmal>
