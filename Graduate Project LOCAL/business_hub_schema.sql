
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
