<?php

use function PHPSTORM_META\type;

session_start();

function insertNewCustomer($name, $surname, $phone, $email)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection

    $sql = "INSERT INTO customers (id,name,surname,phone,email)
    VALUES (0, '$name','$surname' ,'$phone','$email')";
    $stmt = $conn->prepare("INSERT INTO customers (id,name,surname,phone,email) VALUES (0,?,?,?,?)");
    $stmt->bind_param("ssss", $name, $surname, $phone, $email);

    $is_success = false;
    if ($stmt->execute() === TRUE) {
        $is_success = true;
        session_unset();
        session_destroy();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $is_success;
}

function searchCustomer($name_seach)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!mysqli_select_db($conn, $dbname)) {
        $sql = "CREATE DATABASE " . $dbname;
        if ($conn->query($sql) === FALSE) {
            echo "Error creating database: " . $conn->error;
        } else {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "CREATE TABLE customers (
                id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name varchar(50) NOT NULL,
                surname varchar(50) NOT NULL,
                phone varchar(10) NOT NULL,
                email varchar(50) NOT NULL,
                insert_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )";
            if ($conn->query($sql) === FALSE) {
                echo "Error creating table: " . $conn->error;
            }
        }
    }

    $stmt = $conn->prepare("SELECT * FROM customers WHERE `name` LIKE ?");
    $stmt->bind_param("s", $name_seach);
    $stmt->execute();
    $stmt->bind_result($id, $name, $surname, $phone, $email, $insert_time);
    $customer = array();

    while ($stmt->fetch()) {
        $customer_row = array("id" => $id, "name" => $name, "surname" => $surname, "phone" => $phone, "email" => $email, "insert_time" => $insert_time);
        array_push($customer, $customer_row);
    }
    $stmt->close();
    $conn->close();
    return ($customer);
}

function getAllCustomer()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!mysqli_select_db($conn, $dbname)) {
        $sql = "CREATE DATABASE " . $dbname;
        if ($conn->query($sql) === FALSE) {
            echo "Error creating database: " . $conn->error;
        } else {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "CREATE TABLE customers (
                id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name varchar(50) NOT NULL,
                surname varchar(50) NOT NULL,
                phone varchar(10) NOT NULL,
                email varchar(50) NOT NULL,
                insert_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )";
            if ($conn->query($sql) === FALSE) {
                echo "Error creating table: " . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM customers ORDER BY id";
    $result = $conn->query($sql);

    $customer = array();
    if ($result->num_rows > 0) {
        // output data of each row 
        while ($row = $result->fetch_assoc()) {
            $customer_row = array("id" => $row["id"], "name" => $row["name"], "surname" => $row["surname"], "phone" => $row["phone"], "email" => $row["email"], "insert_time" => $row["insert_time"]);
            array_push($customer, $customer_row);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return ($customer);
}

function getCustomerByID($customer_id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM customers WHERE id=?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = array();
    if ($result->num_rows > 0) {
        // output data of each row 
        while ($row = $result->fetch_assoc()) {
            $customer_row = array("id" => $row["id"], "name" => $row["name"], "surname" => $row["surname"], "phone" => $row["phone"], "email" => $row["email"], "insert_time" => $row["insert_time"]);
            array_push($customer, $customer_row);
        }
    } else {
        echo "0 results";
    }
    $stmt->close();
    $conn->close();
    return ($customer);
}

function updateCustomer($id, $name, $surname, $phone, $email)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("UPDATE customers SET name=? ,surname=?, phone=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $surname, $phone, $email, $id);

    $is_success = false;
    if ($stmt->execute() === TRUE) {
        $is_success = true;
        session_unset();
        session_destroy();
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $is_success;
}

function deleteCustomer($customer_id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "members_record";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to delete a record
    $stmt = $conn->prepare("DELETE FROM customers WHERE id=?");
    $stmt->bind_param("i", $customer_id);
    $is_success = false;
    if ($stmt->execute() === TRUE) {
        $is_success = true;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $is_success;
}
