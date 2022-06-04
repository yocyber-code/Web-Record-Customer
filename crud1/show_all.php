<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM's Bag [Show all customer]</title>
    <link rel="stylesheet" type="text/css" href="css/show_table.css">
    <div class="sticky_menu">
        <h1>MM's Bag [Customer]</h1>
    </div>
    <style>

    </style>

    <script type='text/javascript' src='./jquery-3.6.0.min.js'></script>
    <script type='text/javascript'>
        function loadTable() {
            $("#table").load("show_all_table.php", function(response, status, xhr) {});
        }

        $(document).ready(function() {
            loadTable();

            $(document).on('click', '.edit', function(event) {
                console.log($(this).val());
                if (confirm("ต้องการจะแก้ไขข้อมูลลูกค้า id : " + $(this).val() + "ใช่ไหม")) {
                    window.open("insert_form.php?action=edit&id=" + $(this).val(), "_self");
                }
            });

            $(document).on('click', '.delete', function(event) {
                console.log($(this).val());
                if (confirm("ต้องการจะลบข้อมูลลูกค้า id : " + $(this).val() + "ใช่ไหม")) {
                    $("#data").load("delete_customer.php?id=" + $(this).val(), function(response, status, xhr) {
                        if (status == "success") {
                            loadTable();
                            $(".return_delete").remove();
                        } else if (status == "error") {
                            alert("Error: " + xhr.status + " : " + xhr.statusText);
                        }
                    });
                }
            });
        });
    </script>

</head>

<body>
    <script type='text/javascript'></script>
    <h1 class="head">รายชื่อลูกค้า</h1>
    <div id="data"></div>
    <div id="table"></div>
    <a class="return" href="index.html">กลับหน้าหลัก</a>
</body>

</html>