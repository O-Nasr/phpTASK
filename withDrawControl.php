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
        <div class="d-flex flex-row-reverse bd-highlight">
            <a class="btn btn-primary btn-xl mt-3 mb-3" href="withDraw.php">withDraw+</a>
        </div>
        <?php
        $sql = "select admin.username, withdraw.withdraw, withdraw.date
                        from withdraw
                        inner join admin on admin.id = withdraw.admin_id order by admin.id DESC";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>WithDraw</th>
                                    <th>date</th>
                                </tr>
                            </thead>';
            while($row = $result->fetch_assoc()){
                echo '<tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["withdraw"].'</td>
                        <td>'.$row["date"].'</td>
                      </tr>';
            }
            echo '</table>';
        }
        ?>

    </div>
    <?php include 'layout/footer.html'?>
    </body>
</htmal>
