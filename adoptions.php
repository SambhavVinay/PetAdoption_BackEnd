<?php
include 'db.php';

// Add Adoption
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['adoption_id'])) {
    $pet_id = $_POST['pet_id'];
    $adopter_id = $_POST['adopter_id'];
    $adoption_date = $_POST['adoption_date'];
    $adoption_status = $_POST['adoption_status'];

    $sql = "INSERT INTO Adoptions (pet_id, adopter_id, adoption_date, adoption_status) 
            VALUES ('$pet_id', '$adopter_id', '$adoption_date', '$adoption_status')";
    $conn->query($sql);
    header("Location: adoptions.php");
    exit();
}

// Update Adoption
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adoption_id'])) {
    $adoption_id = $_POST['adoption_id'];
    $pet_id = $_POST['pet_id'];
    $adopter_id = $_POST['adopter_id'];
    $adoption_date = $_POST['adoption_date'];
    $adoption_status = $_POST['adoption_status'];

    $sql = "UPDATE Adoptions SET pet_id='$pet_id', adopter_id='$adopter_id', adoption_date='$adoption_date', adoption_status='$adoption_status' WHERE adoption_id='$adoption_id'";
    $conn->query($sql);
    header("Location: adoptions.php");
    exit();
}

// Delete Adoption
if (isset($_GET['delete'])) {
    $adoption_id = $_GET['delete'];
    $sql = "DELETE FROM Adoptions WHERE adoption_id = $adoption_id";
    $conn->query($sql);
    header("Location: adoptions.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adoption Management</title>
</head>
<body>
<?php
if (isset($_GET['edit'])) {
    $adoption_id = $_GET['edit'];
    $sql = "SELECT * FROM Adoptions WHERE adoption_id = $adoption_id";
    $result = $conn->query($sql);
    $adoption = $result->fetch_assoc();
    echo "<h2>Update Adoption</h2>
    <form method='POST'>
        <input type='hidden' name='adoption_id' value='{$adoption['adoption_id']}'>
        <input type='number' name='pet_id' value='{$adoption['pet_id']}' placeholder='Pet ID' required><br>
        <input type='number' name='adopter_id' value='{$adoption['adopter_id']}' placeholder='Adopter ID' required><br>
        <input type='date' name='adoption_date' value='{$adoption['adoption_date']}' required><br>
        <input type='text' name='adoption_status' value='{$adoption['adoption_status']}' placeholder='Adoption Status' required><br>
        <input type='submit' value='Update Adoption'>
    </form><hr>";
} else {
    echo "<h2>Add New Adoption</h2>
    <form method='POST'>
        <input type='number' name='pet_id' placeholder='Pet ID' required><br>
        <input type='number' name='adopter_id' placeholder='Adopter ID' required><br>
        <input type='date' name='adoption_date' required><br>
        <input type='text' name='adoption_status' placeholder='Adoption Status' required><br>
        <input type='submit' value='Add Adoption'>
    </form><hr>";
}
?>

<h2>Adoption Records</h2>
<?php
$sql = "SELECT * FROM Adoptions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["adoption_id"] . "<br>";
        echo "Pet ID: " . $row["pet_id"] . "<br>";
        echo "Adopter ID: " . $row["adopter_id"] . "<br>";
        echo "Date: " . $row["adoption_date"] . "<br>";
        echo "Status: " . $row["adoption_status"] . "<br>";
        echo "<a href='adoptions.php?edit=" . $row["adoption_id"] . "'>Edit</a> | ";
        echo "<a href='adoptions.php?delete=" . $row["adoption_id"] . "' onclick=\"return confirm('Delete this record?')\">Delete</a><br><br><hr>";
    }
} else {
    echo "No adoption records found.";
}
?>
</body>
</html>
