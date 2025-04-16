<?php
// Include the database connection file
include 'db.php';

// Check if the form is submitted to add a new foster home
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['foster_id'])) {
    // Collect the form data for adding the foster home
    $foster_name = $_POST['foster_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $capacity = $_POST['capacity'];
    $current_pets = $_POST['current_pets'];
    $shelter_id = $_POST['shelter_id'];

    // Insert the new foster home into the database
    $sql = "INSERT INTO Foster_Homes (foster_name, phone, address, capacity, current_pets, shelter_id) 
            VALUES ('$foster_name', '$phone', '$address', '$capacity', '$current_pets', '$shelter_id')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page to reload and show the new foster home
        header("Location: foster_homes.php");
        exit();
    } else {
        echo "Error adding foster home: " . $conn->error . "<br><br>";
    }
}

// Check if the form is submitted to update a foster home
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['foster_id'])) {
    // Collect the form data for updating the foster home
    $foster_id = $_POST['foster_id'];
    $foster_name = $_POST['foster_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $capacity = $_POST['capacity'];
    $current_pets = $_POST['current_pets'];
    $shelter_id = $_POST['shelter_id'];

    // Update the foster home data in the database
    $sql = "UPDATE Foster_Homes SET foster_name='$foster_name', phone='$phone', address='$address', capacity='$capacity', current_pets='$current_pets', shelter_id='$shelter_id' WHERE foster_id='$foster_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page to reload and show the updated foster home info
        header("Location: foster_homes.php");
        exit();
    } else {
        echo "Error updating foster home: " . $conn->error . "<br><br>";
    }
}

// Check if the 'edit' parameter is present in the URL
if (isset($_GET['edit'])) {
    // Get the foster home ID to update
    $foster_id = $_GET['edit'];

    // Fetch the foster home data from the database
    $sql = "SELECT * FROM Foster_Homes WHERE foster_id = $foster_id";
    $result = $conn->query($sql);
    $foster_home = $result->fetch_assoc();

    // Show the form with pre-filled data
    echo "<h2>Update Foster Home Information</h2>";
    echo "<form action='foster_homes.php' method='POST'>
        <input type='hidden' name='foster_id' value='" . $foster_home['foster_id'] . "'>

        <label for='foster_name'>Foster Name:</label>
        <input type='text' id='foster_name' name='foster_name' value='" . $foster_home['foster_name'] . "' required><br><br>

        <label for='phone'>Phone:</label>
        <input type='text' id='phone' name='phone' value='" . $foster_home['phone'] . "' required><br><br>

        <label for='address'>Address:</label>
        <input type='text' id='address' name='address' value='" . $foster_home['address'] . "' required><br><br>

        <label for='capacity'>Capacity:</label>
        <input type='number' id='capacity' name='capacity' value='" . $foster_home['capacity'] . "' required><br><br>

        <label for='current_pets'>Current Pets:</label>
        <input type='number' id='current_pets' name='current_pets' value='" . $foster_home['current_pets'] . "' required><br><br>

        <label for='shelter_id'>Shelter ID:</label>
        <input type='number' id='shelter_id' name='shelter_id' value='" . $foster_home['shelter_id'] . "' required><br><br>

        <input type='submit' value='Update Foster Home'>
    </form>";
} else {
    // Show the Add Foster Home form if not editing
    echo "<h2>Add a New Foster Home</h2>
    <form action='foster_homes.php' method='POST'>
        <label for='foster_name'>Foster Name:</label>
        <input type='text' id='foster_name' name='foster_name' required><br><br>

        <label for='phone'>Phone:</label>
        <input type='text' id='phone' name='phone' required><br><br>

        <label for='address'>Address:</label>
        <input type='text' id='address' name='address' required><br><br>

        <label for='capacity'>Capacity:</label>
        <input type='number' id='capacity' name='capacity' required><br><br>

        <label for='current_pets'>Current Pets:</label>
        <input type='number' id='current_pets' name='current_pets' required><br><br>

        <label for='shelter_id'>Shelter ID:</label>
        <input type='number' id='shelter_id' name='shelter_id' required><br><br>

        <input type='submit' value='Add Foster Home'>
    </form>";
}

// Check if the 'delete' parameter is present in the URL to delete a foster home
if (isset($_GET['delete'])) {
    $foster_id = $_GET['delete'];
    
    // Delete the foster home from the database
    $sql = "DELETE FROM Foster_Homes WHERE foster_id = $foster_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page to show updated foster home list after deletion
        header("Location: foster_homes.php");
        exit();
    } else {
        echo "Error deleting foster home: " . $conn->error . "<br><br>";
    }
}

// Fetch and display all foster homes
$sql = "SELECT * FROM Foster_Homes";
$result = $conn->query($sql);

// Check if there are any foster homes in the table
if ($result->num_rows > 0) {
    // Output each foster home's data
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["foster_id"] . "<br>";
        echo "Foster Name: " . $row["foster_name"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        echo "Address: " . $row["address"] . "<br>";
        echo "Capacity: " . $row["capacity"] . "<br>";
        echo "Current Pets: " . $row["current_pets"] . "<br>";
        echo "Shelter ID: " . $row["shelter_id"] . "<br>";
        // Add the Update link
        echo "<a href='foster_homes.php?edit=" . $row["foster_id"] . "'>Update</a> | ";
        // Add the Delete link
        echo "<a href='foster_homes.php?delete=" . $row["foster_id"] . "' onclick='return confirm(\"Are you sure you want to delete this foster home?\")'>Delete</a><br><hr>";
    }
} else {
    echo "No foster homes found.";
}
?>
