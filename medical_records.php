<?php
include 'db.php';

// Add Medical Record
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['record_id'])) {
    $pet_id = $_POST['pet_id'];
    $checkup_date = $_POST['checkup_date'];
    $vaccinations = $_POST['vaccinations'];
    $medical_notes = $_POST['medical_notes'];
    $vet_name = $_POST['vet_name'];

    $sql = "INSERT INTO Medical_Records (pet_id, checkup_date, vaccinations, medical_notes, vet_name) 
            VALUES ('$pet_id', '$checkup_date', '$vaccinations', '$medical_notes', '$vet_name')";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}

// Update Medical Record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record_id'])) {
    $record_id = $_POST['record_id'];
    $pet_id = $_POST['pet_id'];
    $checkup_date = $_POST['checkup_date'];
    $vaccinations = $_POST['vaccinations'];
    $medical_notes = $_POST['medical_notes'];
    $vet_name = $_POST['vet_name'];

    $sql = "UPDATE Medical_Records SET pet_id='$pet_id', checkup_date='$checkup_date', vaccinations='$vaccinations', 
            medical_notes='$medical_notes', vet_name='$vet_name' WHERE record_id='$record_id'";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}

// Delete Medical Record
if (isset($_GET['delete'])) {
    $record_id = $_GET['delete'];
    $sql = "DELETE FROM Medical_Records WHERE record_id = $record_id";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Records Management</title>
</head>
<body>
<?php
if (isset($_GET['edit'])) {
    $record_id = $_GET['edit'];
    $sql = "SELECT * FROM Medical_Records WHERE record_id = $record_id";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
    echo "<h2>Update Medical Record</h2>
    <form method='POST'>
        <input type='hidden' name='record_id' value='{$record['record_id']}'>
        <input type='number' name='pet_id' value='{$record['pet_id']}' placeholder='Pet ID' required><br>
        <input type='date' name='checkup_date' value='{$record['checkup_date']}' required><br>
        <input type='text' name='vaccinations' value='{$record['vaccinations']}' placeholder='Vaccinations'><br>
        <input type='text' name='medical_notes' value='{$record['medical_notes']}' placeholder='Medical Notes'><br>
        <input type='text' name='vet_name' value='{$record['vet_name']}' placeholder='Vet Name' required><br>
        <input type='submit' value='Update Record'>
    </form><hr>";
} else {
    echo "<h2>Add Medical Record</h2>
    <form method='POST'>
        <input type='number' name='pet_id' placeholder='Pet ID' required><br>
        <input type='date' name='checkup_date' required><br>
        <input type='text' name='vaccinations' placeholder='Vaccinations'><br>
        <input type='text' name='medical_notes' placeholder='Medical Notes'><br>
        <input type='text' name='vet_name' placeholder='Vet Name' required><br>
        <input type='submit' value='Add Record'>
    </form><hr>";
}
?>

<h2>Medical Records List</h2>
<?php
$sql = "SELECT * FROM Medical_Records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Record ID: " . $row["record_id"] . "<br>";
        echo "Pet ID: " . $row["pet_id"] . "<br>";
        echo "Checkup Date: " . $row["checkup_date"] . "<br>";
        echo "Vaccinations: " . $row["vaccinations"] . "<br>";
        echo "Medical Notes: " . $row["medical_notes"] . "<br>";
        echo "Vet Name: " . $row["vet_name"] . "<br>";
        echo "<a href='medical_records.php?edit=" . $row["record_id"] . "'>Edit</a> | ";
        echo "<a href='medical_records.php?delete=" . $row["record_id"] . "' onclick=\"return confirm('Delete this record?')\">Delete</a><br><br><hr>";
    }
} else {
    echo "No medical records found.";
}
?>
</body>
</html>
