<!DOCTYPE html>
<html lang="en">
<?php
    require_once("customer_func.php");
    $is_edit = false;
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
        $is_edit = true;
        $id = $_GET['id'];
        $customers = getCustomerByID($id);
        if (!empty($customers)) {
            $name = $customers[0]['name'];
            $surname = $customers[0]['surname'];
            $phone = $customers[0]['phone'];
            $email = $customers[0]['email'];
            $_SESSION['name']     = $name;
            $_SESSION['surname']  = $surname;
            $_SESSION['phone']    = $phone;
            $_SESSION['email']    = $email;
        }
    }
    if (isset($_GET['return']) && $_GET['return'] == 1) {
        echo "<script type='text/javascript'>alert('กรุณากรอกชื่อ');</script>";
    } else if (isset($_GET['return']) && $_GET['return'] == 2) {
        echo "<script type='text/javascript'>alert('กรุณากรอกนามสกุล');</script>";
    } else if (isset($_GET['return']) && $_GET['return'] == 3) {
        echo "<script type='text/javascript'>alert('กรุณากรอกเบอร์โทรศัพท์');</script>";
    } else if (isset($_GET['return']) && $_GET['return'] == 4) {
        echo "<script type='text/javascript'>alert('กรุณากรอกอีเมล');</script>";
    } else if (isset($_GET['return']) && $_GET['return'] == 5) {
        echo "<script type='text/javascript'>alert('กรุณากรอกอีเมลให้ถูกต้อง');</script>";
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/insert_form.css">
    <title>MM's Bag Insert</title>
    <div class="sticky_menu">
        <h1>MM's Bag [Customer]</h1>
    </div>
</head>

<body>
    <?php
    if ($is_edit) {
        echo "
                  <h1 class='menu_head'>เพิ่มลูกค้า</h1>
                  <form action='update_action.php' method='POST'>
                  <input type='hidden' name='id' value='$id'>
                  <ul>";
    } else {
        session_destroy();
        echo "<h1 class='menu_head'>เพิ่มลูกค้า</h1>
              <form action='insert_action.php' method='POST'>
              <ul>";
    }
    $value_name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
    $value_surname = isset($_SESSION['surname']) ? $_SESSION['surname'] : "";
    $value_phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : "";
    $value_email = isset($_SESSION['email']) ? $_SESSION['email'] : "";

    echo "<li>ชื่อ <span>:</span> <input class='textbox' type='text' name='name' value='$value_name'></li>
          <li>นามสกุล <span>:</span> <input class='textbox' type='text' name='surname' value='$value_surname'></li>
          <li>เบอร์โทรศัพท์ <span>:</span> <input class='textbox' type='text' name='phone' value='$value_phone'></li>
          <li>อีเมล <span>:</span> <input class='textbox' type='text' name='email' value='$value_email'></li>
          </ul>
          <input class='save' type='submit' name='submit' value='SAVE'>
          </form>";
    ?>

    <a class="return" href="index.html">กลับหน้าหลัก</a>
</body>

</html>