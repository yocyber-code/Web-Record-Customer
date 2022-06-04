<?php
    require_once("customer_func.php");
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $submit = $_POST['submit'];
    $id = $_POST['id'];

    ///setcookie("name", $name, time() + (300), "/");
    ///setcookie("surname", $surname, time() + (300), "/");
    ///setcookie("phone", $phone, time() + (300), "/");
    ///setcookie("email", $email, time() + (300), "/");

    $_SESSION['name']     = $name;
    $_SESSION['surname']  = $surname;
    $_SESSION['phone']    = $phone;
    $_SESSION['email']    = $email;

    if (!isset($submit)) {
        header("location:insert_form.php");
    }
    if ($name == "") {
        header("location:insert_form.php?return=1&action=edit&id=$id");
        exit;
    }
    if ($surname == "") {
        header("location:insert_form.php?return=2&action=edit&id=$id");
        exit;
    }
    if ($phone == "") {
        header("location:insert_form.php?return=3&action=edit&id=$id");
        exit;
    }
    if ($email == "") {
        header("location:insert_form.php?return=4&action=edit&id=$id");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5&action=edit&id=$id");
        exit;
    }

    $is_success = updateCustomer($id,$name, $surname, $phone, $email);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <?php 
        if($is_success){
            echo "<h1>Update สำเร็จ</h1><br><a href='show_all.php'>กลับหน้าเดิม</a>";
        }else{
            echo "<h1>ไม่สามารถอัพเดทข้อมูลได้</h1><br><a href='insert_form.php?action=edit&id=$id'>กลับหน้าเดิม</a>";
        }
    ?> 
</body>

</html>