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
            <a class="btn btn-primary btn-xl mt-3 mb-3" href="AddUser.php">Add+</a>
        </div>
        <?php
        $sql = "select * from user order by id DESC";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>#Flat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>';
            while($row = $result->fetch_assoc()){
                echo '<tr>
                        <td>'.$row["UserName"].'</td>
                        <td>'.$row["flatNum"].'</td>
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
