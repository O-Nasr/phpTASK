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
            <a class="btn btn-primary btn-xl mt-3 mb-3" href="insertProb.php">Add+</a>
        </div>
        <?php
            $sql = "select * from expenses order by id DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<div class="card text-center">
                                <div class="card-header">
                                    '.$row["name"].'
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Cost : '.$row["totalCost"].'</h5>
                                    <p class="card-text">cost for one member : '.$row["cost"].'</p>
                                    <a href="show.php?id='.$row["id"].'&cost='.$row["cost"].'" class="btn btn-primary">Go somewhere</a>
                                </div>
                                <div class="card-footer text-muted">
                                    '.$row["date"].'
                                </div>
                            </div>';
                        echo "<br>";
                    }
            }
        ?>

    </div>
    <?php include 'layout/footer.html'?>
    </body>
</htmal>
