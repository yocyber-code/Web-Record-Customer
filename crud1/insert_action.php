<?php
    
    require_once("customer_func.php");
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $submit = $_POST['submit'];

    $_SESSION['name']     = $name;
    $_SESSION['surname']  = $surname;
    $_SESSION['phone']    = $phone;
    $_SESSION['email']    = $email;

    if (!isset($submit)) {
        header("location:insert_form.php");
    }
    if ($name == "") {
        header("location:insert_form.php?return=1");
        exit;
    }
    if ($surname == "") {
        header("location:insert_form.php?return=2");
        exit;
    }
    if ($phone == "") {
        header("location:insert_form.php?return=3");
        exit;
    }
    if ($email == "") {
        header("location:insert_form.php?return=4");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5");
        exit;
    }

    $is_success = insertNewCustomer($name, $surname, $phone, $email);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
</head>

<body>
    <h1><?php echo $is_success ? "insert สำเร็จ" : "ไม่สามารถเพิ่มข้อมูลได้" ?></h1>
    <a href="insert_form.php">กลับหน้าเดิม</a>
</body>

</html>