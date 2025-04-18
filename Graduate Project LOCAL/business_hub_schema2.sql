-- SQL Schema for Business Hub System
-- Generated on 2025-04-18 12:27:33

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255),
    role ENUM('user', 'super_admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DEPARTMENTS TABLE
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT
);

-- BOOK EXCHANGE TABLE
CREATE TABLE book_exchange (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(255),
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- BOOK OFFERS TABLE
CREATE TABLE book_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    user_id INT NOT NULL,
    desired_book_id INT,
    details TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES book_exchange(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (desired_book_id) REFERENCES book_exchange(id)
);

-- BOOK REQUESTS TABLE
CREATE TABLE book_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    requester_id INT,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (offer_id) REFERENCES book_offers(id),
    FOREIGN KEY (requester_id) REFERENCES users(id)
);

-- NOTIFICATIONS TABLE
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    receiver_id INT,
    action_id INT,
    type VARCHAR(100),
    message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id),
    FOREIGN KEY (action_id) REFERENCES book_requests(id)
);

-- CHAT MESSAGES TABLE
CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);

-- COURSES TABLE
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    course_name VARCHAR(255),
    course_link TEXT,
    course_description TEXT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- BOOKS (STATIC) TABLE
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    book_name VARCHAR(255),
    book_material TEXT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- ACADEMIC STAFF TABLE
CREATE TABLE academic_staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    linkedin VARCHAR(255),
    image TEXT,
    office_location VARCHAR(255),
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);
