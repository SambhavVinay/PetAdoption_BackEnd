<?php
include 'db.php';

// Add Shelter
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['shelter_id'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    $sql = "INSERT INTO Shelters (name, location, contact_email, contact_phone) 
            VALUES ('$name', '$location', '$contact_email', '$contact_phone')";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}

// Update Shelter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shelter_id'])) {
    $shelter_id = $_POST['shelter_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    $sql = "UPDATE Shelters SET name='$name', location='$location', contact_email='$contact_email', contact_phone='$contact_phone' WHERE shelter_id='$shelter_id'";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}

// Delete Shelter
if (isset($_GET['delete'])) {
    $shelter_id = $_GET['delete'];
    $sql = "DELETE FROM Shelters WHERE shelter_id = $shelter_id";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shelter Management</title>
</head>
<body>
<?php
if (isset($_GET['edit'])) {
    $shelter_id = $_GET['edit'];
    $sql = "SELECT * FROM Shelters WHERE shelter_id = $shelter_id";
    $result = $conn->query($sql);
    $shelter = $result->fetch_assoc();
    echo "<h2>Update Shelter</h2>
    <form method='POST'>
        <input type='hidden' name='shelter_id' value='{$shelter['shelter_id']}'>
        <input type='text' name='name' value='{$shelter['name']}' placeholder='Name' required><br>
        <input type='text' name='location' value='{$shelter['location']}' placeholder='Location' required><br>
        <input type='text' name='contact_email' value='{$shelter['contact_email']}' placeholder='Contact Email' required><br>
        <input type='text' name='contact_phone' value='{$shelter['contact_phone']}' placeholder='Contact Phone' required><br>
        <input type='submit' value='Update Shelter'>
    </form><hr>";
} else {
    echo "<h2>Add New Shelter</h2>
    <form method='POST'>
        <input type='text' name='name' placeholder='Name' required><br>
        <input type='text' name='location' placeholder='Location' required><br>
        <input type='text' name='contact_email' placeholder='Contact Email' required><br>
        <input type='text' name='contact_phone' placeholder='Contact Phone' required><br>
        <input type='submit' value='Add Shelter'>
    </form><hr>";
}
?>

<h2>Shelter List</h2>
<?php
$sql = "SELECT * FROM Shelters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["shelter_id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Location: " . $row["location"] . "<br>";
        echo "Email: " . $row["contact_email"] . "<br>";
        echo "Phone: " . $row["contact_phone"] . "<br>";
        echo "<a href='shelters.php?edit=" . $row["shelter_id"] . "'>Edit</a> | ";
        echo "<a href='shelters.php?delete=" . $row["shelter_id"] . "' onclick=\"return confirm('Delete this shelter?')\">Delete</a><br><br><hr>";
    }
} else {
    echo "No shelters found.";
}
?>
</body>
</html>
