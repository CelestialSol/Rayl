<?php include '../MODEL/user.php';
$user = new User();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <?php include '../INCLUDE/href.php'; ?>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <h1>List of Users</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-header"></div>
                        
                    <div class="card-body">
                    <?php if(isset($_GET['edit'])){
                        $get_id_edit = $_GET('edit');
                        $row= $user->getUserById($get_id_edit);
                    if($row){ 
                        ?>
                        <form action="../CONTROLLER/action_user.php" method="post">
                             <input type="text" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>"  required>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" value="<?php echo $row['user_id']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1" value="<?php if($row['active'] == 1){echo 'selected';} ?>">Activated</option>
                                <option value="0" value="<?php if($row['active'] == 0){echo 'selexted';} ?>">Deactivated</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-primary">EDIT</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">CANCEL</button>
                        </div>
                    </form>
                    <?php }}else{ ?>
                    
                    
                        <form action="../CONTROLLER/action_user.php" method="post">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1">Activated</option>
                                    <option value="0">Deactivated</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add" class="btn btn-primary">ADD</button>
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='list_user.php'">CANCEL</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th> 
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
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
                                    <td><?php echo $row['fname'].''. $row['lname']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['active']; ?></td>
                                    <td><?php echo $row['date_created']; ?></td>
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

<script>
    let table = new DataTable('#myTable');
</script>



<?php if(isset($_GET['edit']))?>