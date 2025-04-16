<?php
include 'db.php';

// Add Employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['employee_id'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $shelter_id = $_POST['shelter_id'];

    $sql = "INSERT INTO Employees (first_name, last_name, email, phone, role, shelter_id) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$role', '$shelter_id')";
    $conn->query($sql);
    header("Location: employees.php");
    exit();
}

// Update Employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $shelter_id = $_POST['shelter_id'];

    $sql = "UPDATE Employees SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', role='$role', shelter_id='$shelter_id' WHERE employee_id='$employee_id'";
    $conn->query($sql);
    header("Location: employees.php");
    exit();
}

// Delete Employee
if (isset($_GET['delete'])) {
    $employee_id = $_GET['delete'];
    $sql = "DELETE FROM Employees WHERE employee_id = $employee_id";
    $conn->query($sql);
    header("Location: employees.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
</head>
<body>
<?php
if (isset($_GET['edit'])) {
    $employee_id = $_GET['edit'];
    $sql = "SELECT * FROM Employees WHERE employee_id = $employee_id";
    $result = $conn->query($sql);
    $employee = $result->fetch_assoc();
    echo "<h2>Update Employee</h2>
    <form method='POST'>
        <input type='hidden' name='employee_id' value='{$employee['employee_id']}'>
        <input type='text' name='first_name' value='{$employee['first_name']}' placeholder='First Name' required><br>
        <input type='text' name='last_name' value='{$employee['last_name']}' placeholder='Last Name' required><br>
        <input type='text' name='email' value='{$employee['email']}' placeholder='Email' required><br>
        <input type='text' name='phone' value='{$employee['phone']}' placeholder='Phone' required><br>
        <input type='text' name='role' value='{$employee['role']}' placeholder='Role' required><br>
        <input type='number' name='shelter_id' value='{$employee['shelter_id']}' placeholder='Shelter ID' required><br>
        <input type='submit' value='Update Employee'>
    </form><hr>";
} else {
    echo "<h2>Add New Employee</h2>
    <form method='POST'>
        <input type='text' name='first_name' placeholder='First Name' required><br>
        <input type='text' name='last_name' placeholder='Last Name' required><br>
        <input type='text' name='email' placeholder='Email' required><br>
        <input type='text' name='phone' placeholder='Phone' required><br>
        <input type='text' name='role' placeholder='Role' required><br>
        <input type='number' name='shelter_id' placeholder='Shelter ID' required><br>
        <input type='submit' value='Add Employee'>
    </form><hr>";
}
?>

<h2>Employee List</h2>
<?php
$sql = "SELECT * FROM Employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["employee_id"] . "<br>";
        echo "Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        echo "Role: " . $row["role"] . "<br>";
        echo "Shelter ID: " . $row["shelter_id"] . "<br>";
        echo "<a href='employees.php?edit=" . $row["employee_id"] . "'>Edit</a> | ";
        echo "<a href='employees.php?delete=" . $row["employee_id"] . "' onclick=\"return confirm('Delete this employee?')\">Delete</a><br><br><hr>";
    }
} else {
    echo "No employees found.";
}
?>
</body>
</html>
