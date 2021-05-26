<?php

session_start();
require_once 'dbasset.php';

$id = 0;
$name = '';
$location = '';

if (isset($_POST['save'])) {
    $name = htmlspecialchars(stripcslashes($_POST['name']));
    $location = htmlspecialchars(stripcslashes($_POST['location']));

    $mysqli->query("INSERT INTO crud(name, location) VALUES('$name', '$location')")
    or die($mysqli->error());

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = 'success';

    header('Location: index.php');
}

if (isset($_GET["delete"])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM crud WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been Deleted";
    $_SESSION['msg_type'] = 'danger';

    header('Location: index.php');
}

$update = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM crud WHERE id=$id") or die($mysqli->error());
    if (is_countable($result) == 1) {
        $data = $result->fetch_array();
        $name = $data['name'];
        $location = $data['location'];
    }
}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $result = $mysqli->query("UPDATE crud SET name = '$name', location = '$location' WHERE id = '$id'") or die($mysqli->error());

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = 'warning';

    header('Location: index.php');
}
