<?php

require_once "dbasset.php";

$result = $mysqli->query("SELECT * FROM crud");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>CRUD APPLICATION</title>
    <style>
        .container{
            margin-top: 40px;
        }
    </style>
</head>
<body>
<?php require_once 'process.php'?>
<?php
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
echo $_SESSION['message'];
unset($_SESSION['message']);

?>
 </div>
<?php endif?>
<div class="container">
    <div class="row justify-content-center">
     <table class="table">
       <tr>
        <thead>
            <th scope="col">Name</th>
            <th scope="col">Location</th>
            <th colspan="2">Action</th>
        </thead>
       </tr>
        <tbody>
            <?php while ($data = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['location'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
        <form action="process.php" method="post">
        <input type="hidden" name='id' value="<?php echo $id ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="Enter your Location" value="<?php echo $location ?>" class="form-control">
                </div>
                <?php if ($update == true): ?>
                    <button type="submit" name="update" class="btn btn-secondary">Update</button>
                    <?php else: ?>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
            <?php endif?>
        </form>
        </div>
    </div>
</body>
</html>
