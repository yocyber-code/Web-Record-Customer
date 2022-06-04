<?php
    require_once("customer_func.php");
    $allcustomer = getAllCustomer();
    if (!empty($allcustomer)) {
        echo "<table>";
        echo "<tr>";
        $keys = array_keys($allcustomer[0]);
        for ($i = 0; $i < count($keys); ++$i) {
            $key = $keys[$i];
            echo "<th>$key</th>";
        }
        echo "<th>แก้ไข</th>";
        echo "<th>ลบ</th>";
        echo "</tr>";
    
        for ($i = 0; $i < count($allcustomer); ++$i) {
            echo "<tr>";
            for ($j = 0; $j < count($keys); ++$j) {
                echo "<td>" . $allcustomer[$i][$keys[$j]] . "</td>";
            }
            $id_key = $allcustomer[$i]["id"];
            echo "<td><button class='edit' value='$id_key'>แก้ไข</button></td>";
            echo "<td><button class='delete' value='$id_key'>ลบ</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>