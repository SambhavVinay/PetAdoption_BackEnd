<?php
include 'db.php';

// Add Adopter
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['adopter_id'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO Adopters (first_name, last_name, email, phone, address) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";
    $conn->query($sql);
    header("Location: adopters.php");
    exit();
}

// Update Adopter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adopter_id'])) {
    $adopter_id = $_POST['adopter_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE Adopters SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address' WHERE adopter_id='$adopter_id'";
    $conn->query($sql);
    header("Location: adopters.php");
    exit();
}

// Delete Adopter
if (isset($_GET['delete'])) {
    $adopter_id = $_GET['delete'];
    $sql = "DELETE FROM Adopters WHERE adopter_id = $adopter_id";
    $conn->query($sql);
    header("Location: adopters.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adopter Management</title>
</head>
<body>
<?php
if (isset($_GET['edit'])) {
    $adopter_id = $_GET['edit'];
    $sql = "SELECT * FROM Adopters WHERE adopter_id = $adopter_id";
    $result = $conn->query($sql);
    $adopter = $result->fetch_assoc();
    echo "<h2>Update Adopter</h2>
    <form method='POST'>
        <input type='hidden' name='adopter_id' value='{$adopter['adopter_id']}'>
        <input type='text' name='first_name' value='{$adopter['first_name']}' placeholder='First Name' required><br>
        <input type='text' name='last_name' value='{$adopter['last_name']}' placeholder='Last Name' required><br>
        <input type='text' name='email' value='{$adopter['email']}' placeholder='Email' required><br>
        <input type='text' name='phone' value='{$adopter['phone']}' placeholder='Phone' required><br>
        <input type='text' name='address' value='{$adopter['address']}' placeholder='Address' required><br>
        <input type='submit' value='Update Adopter'>
    </form><hr>";
} else {
    echo "<h2>Add New Adopter</h2>
    <form method='POST'>
        <input type='text' name='first_name' placeholder='First Name' required><br>
        <input type='text' name='last_name' placeholder='Last Name' required><br>
        <input type='text' name='email' placeholder='Email' required><br>
        <input type='text' name='phone' placeholder='Phone' required><br>
        <input type='text' name='address' placeholder='Address' required><br>
        <input type='submit' value='Add Adopter'>
    </form><hr>";
}
?>

<h2>Adopter List</h2>
<?php
$sql = "SELECT * FROM Adopters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["adopter_id"] . "<br>";
        echo "Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        echo "Address: " . $row["address"] . "<br>";
        echo "<a href='adopters.php?edit=" . $row["adopter_id"] . "'>Edit</a> | ";
        echo "<a href='adopters.php?delete=" . $row["adopter_id"] . "' onclick=\"return confirm('Delete this adopter?')\">Delete</a><br><br><hr>";
    }
} else {
    echo "No adopters found.";
}
?>
</body>
</html>
