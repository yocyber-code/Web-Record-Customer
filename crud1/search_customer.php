<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/show_table.css">

    <script type='text/javascript' src='./jquery-3.6.0.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('.edit').click(function() {
                console.log($(this).val());
                if (confirm("ต้องการจะแก้ไขข้อมูลลูกค้า id : " + $(this).val() + "ใช่ไหม")) {
                    window.open("insert_form.php?action=edit&id=" + $(this).val(), "_self");
                }
            });

            $('.delete').click(function() {
                console.log($(this).val());
                if (confirm("ต้องการจะลบข้อมูลลูกค้า id : " + $(this).val() + "ใช่ไหม")) {
                    window.open("delete_customer.php?id=" + $(this).val(), "_self");
                }
            });
        });
    </script>
    <title>MM's Bag [Show all customer]</title>
    <div class="sticky_menu">
        <h1>MM's Bag [Customer]</h1>
    </div>
</head>

<body>

    <h1 class="head">รายชื่อลูกค้า</h1>
    <form action="search_customer.php" method="POST">
        <div class="search">search : <input type="text" name="text_search">
            <input type="submit" value="search" name="btn">
        </div>
    </form>
    <?php
    require_once("customer_func.php");
    if (isset($_POST['btn'])) {
        $name_search = trim($_POST['text_search']);
        $result = searchCustomer($name_search);
        if (!empty($result)) {
            echo "<table>";
            echo "<tr>";
            $keys = array_keys($result[0]);
            for ($i = 0; $i < count($keys); ++$i) {
                $key = $keys[$i];
                echo "<th>$key</th>";
            }
            echo "<th>แก้ไข</th>";
            echo "<th>ลบ</th>";
            echo "</tr>";

            for ($i = 0; $i < count($result); ++$i) {
                echo "<tr>";
                for ($j = 0; $j < count($keys); ++$j) {
                    echo "<td>" . $result[$i][$keys[$j]] . "</td>";
                }
                $id_key = $result[$i]["id"];
                echo "<td><button class='edit' value='$id_key'>แก้ไข</button></td>";
                echo "<td><button class='delete' value='$id_key'>ลบ</button></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

    <a class="return" href="index.html">กลับหน้าหลัก</a>
</body>

</html>