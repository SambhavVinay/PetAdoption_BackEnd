<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Adoption Management System</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        header {
            background-color: #4a69bd;
            color: white;
            padding: 1rem 2rem;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        .module-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        a.module {
            flex: 1 1 calc(45% - 1rem);
            min-width: 180px;
            text-decoration: none;
            background: #e1ecf4;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            color: #34495e;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: 0.2s ease;
        }
        a.module:hover {
            background-color: #d6e9f9;
            transform: translateY(-2px);
        }
        footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pet Adoption Management</h1>
    </header>

    <div class="container">
        <h2>Select a Module</h2>
        <div class="module-list">
            <a class="module" href="pets.php">Pets</a>
            <a class="module" href="foster_homes.php">Foster Homes</a>
            <a class="module" href="shelters.php">Shelters</a>
            <a class="module" href="adopters.php">Adopters</a>
            <a class="module" href="employees.php">Employees</a>
            <a class="module" href="adoptions.php">Adoptions</a>
            <a class="module" href="medical_records.php">Medical Records</a>
            <a class="module" href="supplies.php">Supplies</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Pet Adoption Project | 🐾
    </footer>
</body>
</html>
