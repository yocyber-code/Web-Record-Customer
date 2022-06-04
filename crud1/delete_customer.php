<?php
    require_once("customer_func.php");
    $id = $_GET['id'];

    if(deleteCustomer($id)){
        echo "<h1 class='return_delete'>Delete Success</h1>";
    }else{
        echo "<h1 class='return_delete'>Delete Unsucess</h1>";
    }
    echo '<a class="return_delete" href="index.html">กลับหน้าหลัก</a>';
?>