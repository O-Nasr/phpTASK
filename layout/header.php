<?php session_start() ?>
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="myStyle.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <span class="navbar-brand">Task-9</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION['name'])){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="main.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="userControl.php">User Control</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">Admin Control</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="withDrawControl.php">witDraw Control</a>
                    </li>
                <?php } ?>
                <?php if(!isset($_SESSION['name'])){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo $href ?>"><?php echo $dir ?></a>
                    </li>
                <?php } ?>
            </ul>
            <?php if(isset($_SESSION['name'])){ ?>
                <form class="form-inline my-2 my-lg-0" action="include/logout.php" method="POST">
                    <button  class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Log out</button>
                </form>
            <?php } ?>
        </div>
    </nav>
</header>
