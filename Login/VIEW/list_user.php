<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../STYLE/list_user.css">
    <link rel="stylesheet" href="../STYLE/form.css"> 
</head>
<body>
<?php include '../INCLUDES/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <h1>Manage Users</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
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
                                        <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo ($row['status'] == 1) ? "Active" : "Inactive"; ?></td>
                                        <td><?php echo htmlspecialchars($row['date_created']); ?></td>
                                        <td>
                                            <a href="list_user.php?edit=<?php echo $row['user_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="../CONTROLLER/action_user.php?delete=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- User Management Form -->
                <div class="card mt-3">
                    <div class="card-body">
                        <?php if(isset($_GET['edit'])){
                            $get_id_edit = $_GET['edit'];
                            $row = $user->getUserById($get_id_edit);
                            if($row){ 
                        ?>
                        <!-- Edit User Form -->
                        <form action="../CONTROLLER/action_user.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo isset($row['username']) ? htmlspecialchars($row['username']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" value="<?php echo isset($row['password']) ? htmlspecialchars($row['password']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="active">Status</label>
                                <select class="form-select" name="active">
                                    <option value="1" <?php if($row['status'] == 1){ echo 'selected'; } ?>>Active</option>
                                    <option value="0" <?php if($row['status'] == 0){ echo 'selected'; } ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">Cancel</button>
                            </div>
                        </form>
                        <?php }} else { ?>
                        
                        <!-- Add User Form -->
                        <form action="../CONTROLLER/action_user.php" method="post">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="active">Status</label>
                                <select class="form-select" name="active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">Cancel</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
