
-- 1. Shelters Table
CREATE TABLE Shelters (
    shelter_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    location VARCHAR(50),
    contact_email VARCHAR(50),
    contact_phone VARCHAR(50)
);

-- 2. Pets Table
CREATE TABLE Pets (
    pet_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    species VARCHAR(50),
    breed VARCHAR(50),
    age INT,
    gender VARCHAR(10),
    adoption_status VARCHAR(20),
    shelter_id INT,
    FOREIGN KEY (shelter_id) REFERENCES Shelters(shelter_id) ON DELETE CASCADE
);

-- 3. Foster_Homes Table
CREATE TABLE Foster_Homes (
    foster_id INT AUTO_INCREMENT PRIMARY KEY,
    foster_name VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255),
    capacity INT,
    current_pets INT,
    shelter_id INT,
    FOREIGN KEY (shelter_id) REFERENCES Shelters(shelter_id) ON DELETE CASCADE
);

-- 4. Adopters Table
CREATE TABLE Adopters (
    adopter_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(50),
    address VARCHAR(100)
);

-- 5. Employees Table
CREATE TABLE Employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20),
    role VARCHAR(50),
    shelter_id INT,
    FOREIGN KEY (shelter_id) REFERENCES Shelters(shelter_id) ON DELETE CASCADE
);

-- 6. Adoptions Table
CREATE TABLE Adoptions (
    adoption_id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT,
    adopter_id INT,
    adoption_date DATE,
    adoption_status VARCHAR(20),
    FOREIGN KEY (pet_id) REFERENCES Pets(pet_id) ON DELETE CASCADE,
    FOREIGN KEY (adopter_id) REFERENCES Adopters(adopter_id) ON DELETE CASCADE
);

-- 7. Medical_Records Table
CREATE TABLE Medical_Records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT,
    checkup_date DATE,
    vaccinations VARCHAR(255),
    medical_notes VARCHAR(255),
    vet_name VARCHAR(100),
    FOREIGN KEY (pet_id) REFERENCES Pets(pet_id) ON DELETE CASCADE
);

-- 8. Supplies Table
CREATE TABLE Supplies (
    supply_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100),
    quantity INT,
    category VARCHAR(50),
    shelter_id INT,
    FOREIGN KEY (shelter_id) REFERENCES Shelters(shelter_id) ON DELETE CASCADE
);
