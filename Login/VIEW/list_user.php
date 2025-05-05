<?php 
require_once __DIR__ . '/../MODEL/user.php';
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../STYLE/list.css">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <h1>Manage Users</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <?php if(isset($_GET['edit'])){
                            $get_id_edit = $_GET['edit'];
                            $row = $user->getUserById($get_id_edit);
                            if($row){ 
                        ?>
                        <!-- Edit Form -->
                        <form action="../CONTROLLER/action_user.php" method="post">
                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>" required>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">Cancel</button>
                            </div>
                        </form>
                        <?php }}else{ ?>

                        <!-- Add User Form -->
                        <form action="../CONTROLLER/action_user.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">Cancel</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Password (Hashed)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $users = $user->getAllUser();
                                        $count = 1;
                                        foreach ($users as $row) { 
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['password']); ?></td>
                                        <td>
                                            <a href="list_user.php?edit=<?php echo $row['user_id'];?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="../CONTROLLER/action_user.php?delete=<?php echo $row['user_id'];?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
