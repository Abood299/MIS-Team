
-- Business Hub Project: Full Database Structure

-- 1. Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    student_id VARCHAR(7) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin', 'super_admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Departments Table
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL
);

-- 3. Books Table (Department Books)
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    book_name VARCHAR(255) NOT NULL,
    book_material TEXT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- 4. Courses Table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    course_name VARCHAR(255) NOT NULL,
    course_link TEXT,
    course_description TEXT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- 5. Academic Staff Table
CREATE TABLE academic_staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    linkedin TEXT,
    image TEXT,
    office_location VARCHAR(100),
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- 6. Book Exchange Table
CREATE TABLE book_exchange (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(255) NOT NULL,
    major VARCHAR(100)
);

-- 7. Book Offers Table
CREATE TABLE book_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    user_id INT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES book_exchange(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 8. Book Requests Table
CREATE TABLE book_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    requester_id INT,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (offer_id) REFERENCES book_offers(id),
    FOREIGN KEY (requester_id) REFERENCES users(id)
);

-- 9. Notifications Table
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    receiver_id INT,
    action_id INT,
    type VARCHAR(50),
    message TEXT,
    is_read BOOLEAN DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 10. Chat Messages Table
CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);


-- DUMMY DATA FOR Business Hub Project

-- Departments
INSERT INTO departments (department_name) VALUES 
('MIS'), 
('Accounting'), 
('Finance'), 
('Marketing'), 
('Business Economics'), 
('Public Administration'), 
('Business Management');

-- Users
INSERT INTO users (name, email, student_id, password, role) VALUES 
('Ahmad Saeed', 'ahmad@ju.edu.jo', '0214456', 'hashed_password_1', 'user'),
('Lina Khoury', 'lina@ju.edu.jo', '0235578', 'hashed_password_2', 'user'),
('Admin User', 'admin@ju.edu.jo', '0000001', 'hashed_admin_pass', 'admin');

-- Books (Departmental)
INSERT INTO books (department_id, book_name, book_material) VALUES 
(1, 'Intro to MIS', 'uploads/mis101.pdf'),
(2, 'Financial Accounting Basics', 'uploads/acc101.pdf'),
(4, 'Marketing Strategies', 'uploads/mkt201.pdf');

-- Courses
INSERT INTO courses (department_id, course_name, course_link, course_description) VALUES 
(1, 'MIS Fundamentals', 'uploads/mis_fundamentals.pdf', 'Introduction to Management Information Systems.'),
(2, 'Accounting I', 'uploads/accounting1.pdf', 'Basic accounting concepts and principles.'),
(4, 'Consumer Behavior', 'uploads/consumer_behavior.pdf', 'Understanding buyer behavior.');

-- Academic Staff
INSERT INTO academic_staff (name, email, linkedin, image, office_location, department_id) VALUES 
('Dr. Hani Dmourh', 'dmourh@ju.edu.jo', 'https://linkedin.com/in/hanidm', 'images/faculty/hanidm.jpg', 'مبنى 4 الطابق الأرضي', 4),
('Dr. Zaid Obaidat', 'z.obeidat@ju.edu.jo', 'https://linkedin.com/in/zaidob', 'images/faculty/zaidob.jpg', 'مبنى 4 الطابق الأول', 4);

-- Book Exchange
INSERT INTO book_exchange (book_name, major) VALUES 
('Business Research Methods', 'Marketing'),
('Corporate Finance', 'Finance');

-- Book Offers
INSERT INTO book_offers (book_id, user_id) VALUES 
(1, 1), 
(2, 2);

-- Book Requests
INSERT INTO book_requests (offer_id, requester_id, status) VALUES 
(1, 2, 'pending'),
(2, 1, 'pending');

-- Notifications
INSERT INTO notifications (user_id, receiver_id, action_id, type, message, is_read) VALUES 
(1, 2, 1, 'book_request', 'User Lina requested your book: Business Research Methods', 0),
(2, 1, 2, 'book_request', 'User Ahmad requested your book: Corporate Finance', 0);

-- Chat Messages
INSERT INTO chat_messages (sender_id, receiver_id, message) VALUES 
(1, 2, 'Hey, I saw you need this book. When can we meet?'),
(2, 1, 'Great! How about tomorrow after class?');
