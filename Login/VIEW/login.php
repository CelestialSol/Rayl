<?php
require_once __DIR__ . '/../MODEL/user.php';
$user = new User();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="STYLE/Login1.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center my-5">
            <h1 class="text-center">LOGIN</h1>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4 my-5">
                <div class="card border-primary">
                    <div class="card-body p-5">
                        <?php
                        if(isset($_GET['error'])) {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['error']; ?>   
                        </div>
                        <?php } ?>
                        <form action="CONTROLLER/auth.php" method="POST">
                            <div class="form-group my-2">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group my-2">
                                <button type="submit" name="login" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>