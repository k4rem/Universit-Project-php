-- Create schema
DROP DATABASE IF EXISTS taazur;
CREATE DATABASE taazur CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE taazur;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('doctor', 'patient') NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    phone_number VARCHAR(20),
    street VARCHAR(255),
    city VARCHAR(100),
    country VARCHAR(100),
    date_of_birth DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DOCTORS TABLE
CREATE TABLE doctors (
    user_id INT PRIMARY KEY,
    license_number VARCHAR(100),
    medical_degree VARCHAR(100),
    verification_file VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- PATIENTS TABLE
CREATE TABLE patients (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- CASES TABLE
CREATE TABLE cases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT,
    patient_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    category ENUM('dental', 'medical') NOT NULL DEFAULT 'medical',
    tags VARCHAR(255),
    target_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (doctor_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE
);

-- CASE IMAGES TABLE
CREATE TABLE case_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    case_id INT,
    image_url VARCHAR(255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE
);

-- DONATIONS TABLE
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    case_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency ENUM('GBP', 'USD', 'EUR', 'JPY', 'AUD') NOT NULL,
    donated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE
);

-- CONTENT TABLE
CREATE TABLE content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) UNIQUE,
    title VARCHAR(255),
    body TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample users
INSERT INTO users (first_name, last_name, email, password, role, active, phone_number, street, city, country, date_of_birth) VALUES
('Doctor', 'One', 'doctor1@taazur.com', 'password', 'doctor', TRUE, '1234567890', '123 Clinic St', 'Cairo', 'Egypt', '1980-01-01'),
('Doctor', 'Two', 'doctor2@taazur.com', 'password', 'doctor', TRUE, '0987654321', '456 Health Ave', 'Alexandria', 'Egypt', '1975-06-15'),
('Patient', 'One', 'patient1@taazur.com', 'password', 'patient', TRUE, '1122334455', '789 Wellness Rd', 'Giza', 'Egypt', '2000-05-10'),
('Patient', 'Two', 'patient2@taazur.com', 'password', 'patient', TRUE, '5566778899', '321 Recovery Ln', 'Mansoura', 'Egypt', '1995-09-23');

-- Insert doctor info
INSERT INTO doctors (user_id, license_number, medical_degree, verification_file) VALUES
(1, 'DOC001', 'MBBS', 'uploads/ids/doc001.png'),
(2, 'DOC002', 'MD', 'uploads/ids/doc002.png');

-- Insert patient info
INSERT INTO patients (user_id) VALUES
(3),
(4);

-- Insert sample cases
INSERT INTO cases (doctor_id, patient_id, title, description, category, tags, target_amount) VALUES
(1, 3, 'An Itchy, Slow-Growing Infant', 'generally dry skin, with widespread low-grade erythema and raised, poorly defined patches of active eczema; there are widespread excoriations.', 'medical', 'eczema, infant, dermatology', 1000.00),
(1, 3, 'Curved Roots Case', 'The challenges of treating this upper 6 with curved roots and calcified pulp and canals.', 'dental', 'roots, calcified, endodontics', 1000.00),
(1, 3, 'A Toddler With Brown Patches', 'His height and weight are on the 75th and 91st centiles for his age, respectively. He is cooperative and follows directions. He has diffuse, scattered, monomorphic, small oval-round reddish-brown macules concentrated predominantly over his anterior and posterior trunk, but also extending to his neck and with a few scattered lesions on his limbs. There are more than 40 of these lesions.', 'medical', 'pediatric, dermatology, macules', 1000.00),
(1, 3, 'Deep Canal Divisions', 'This maxilliary first molar had a wide, blunt palatal root and this can hint at the presence of complex anatomy.', 'dental', 'molar, canal, root', 1000.00),
(1, 3, 'Exceptionally Long Roots', 'This 32mm long lower canine shows unusual and sudden canal obliteration at mid-root level.', 'dental', 'long root, canine', 1000.00),
(2, 4, 'Uterine Fibroids / Leiomyomas', 'Fibroid in a 16 year old girl.', 'medical', 'gynecology, fibroid', 1000.00),
(2, 4, 'Dermoid Cysts / Cystic Teratomas', 'Tordated dermoid cyst or teratoma simplex.', 'medical', 'teratoma, cyst', 1000.00),
(2, 4, 'Clinical Orthodontics', 'crowding in the dental arches as well as eruption of teeth 27, 37 and 47. Tooth 17 was not visible. An OPG X-ray revealed that teeth 17 and 18 were stacked on top of one another.', 'dental', 'orthodontics, teeth, x-ray', 1000.00),
(2, 4, 'Lower Jaw Is Too Far Forward', '8-year-, 5-month-old female Concave and forward sloping, facial profile secondary to apparent mandibular prognathia Otherwise, fairly symmetrical facial features.', 'dental', 'mandibular, profile, child', 1000.00);

-- Insert into case_images table
INSERT INTO case_images (case_id, image_url) VALUES
(1, 'uploads/cases/med1.jpg'),
(2, 'uploads/cases/dental1.jpg'),
(3, 'uploads/cases/med2.jpg'),
(4, 'uploads/cases/dental2.jpg'),
(5, 'uploads/cases/dental3.jpg'),
(6, 'uploads/cases/med3.jpg'),
(7, 'uploads/cases/med4.jpg'),
(8, 'uploads/cases/dental4.jpg'),
(9, 'uploads/cases/dental5.jpg');

-- Insert dynamic content
INSERT INTO content (page_key, title, body) VALUES
('home', 'Welcome to Taazur', 'Your health, our priority.'),
('about', 'About Us', 'We are a caring team of professionals.');

-- Insert sample donations
INSERT INTO donations (user_id, case_id, amount, currency) VALUES
(3, 1, 50.00, 'USD'),
(4, 1, 30.00, 'USD'),
(3, 2, 75.00, 'EUR'),
(4, 2, 100.00, 'GBP'),
(3, 3, 20.00, 'JPY'),
(4, 4, 200.00, 'AUD'),
(3, 5, 60.00, 'USD'),
(4, 6, 90.00, 'EUR'),
(3, 7, 40.00, 'GBP');