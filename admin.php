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
        $sql = "select * from admin order by id DESC";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>full name</th>
                                </tr>
                            </thead>';
            while($row = $result->fetch_assoc()){
                echo '<tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fullname"].'</td>
                        <td><a class="btn btn-danger mt-3 mb-3" href="include/delete.inc.php?id='.$row["Id"].'">Delete-</a></td>
                        </tr>';
            }
            echo '</table>';
        }
        ?>

    </div>
    <?php include 'layout/footer.html'?>
    </body>
</htmal>
