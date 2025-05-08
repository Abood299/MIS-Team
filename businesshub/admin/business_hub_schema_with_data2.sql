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


-- Insert Departments
INSERT INTO departments (name) VALUES ('MIS');
INSERT INTO departments (name) VALUES ('Marketing');
INSERT INTO departments (name) VALUES ('Finance');
INSERT INTO departments (name) VALUES ('Accounting');
INSERT INTO departments (name) VALUES ('Business Economics');
INSERT INTO departments (name) VALUES ('Public Administration');
INSERT INTO departments (name) VALUES ('Management');

-- Insert Users

INSERT INTO users (first_name, last_name, email, phone, password, role) 
VALUES 
('Abood', 'Qudah', 'abood.qudah@gmail.com', '0790000000', '$2y$10$dummyHashedPassword1234567890abcdef', 'super_admin'),
('Jane', 'Doe', 'jane.doe@example.com', '0781234567', '$2y$10$anotherDummyHashedPasswordABCDEF123456', 'user');


-- Insert Book Exchange

INSERT INTO book_exchange (book_name, department_id) VALUES 
('Business Research Methods', 1),
('Principles of Marketing', 2);


-- Insert Book Offers

INSERT INTO book_offers (book_id, user_id, details, desired_book_id) VALUES 
(1, 1, 'Slightly used, notes included', 2),
(2, 2, 'Brand new, sealed', 1);


-- Insert Book Requests

INSERT INTO book_requests (offer_id, requester_id, status) VALUES 
(1, 2, 'pending'),
(2, 1, 'accepted');


-- Insert Notifications

INSERT INTO notifications (user_id, receiver_id, action_id, type, message) VALUES 
(2, 1, 1, 'book_request', 'User Jane requested your book'),
(1, 2, 2, 'book_request', 'User Abood requested your book');


-- Insert Chat Messages

INSERT INTO chat_messages (sender_id, receiver_id, message) VALUES 
(1, 2, 'Hello, when can we meet for the book exchange?'),
(2, 1, 'I am available tomorrow afternoon.');


-- Insert Courses

INSERT INTO courses (department_id, course_name, course_link, course_description) VALUES 
(1, 'Database Systems', 'http://example.com/db-course', 'Intro to databases'),
(2, 'Marketing Strategies', 'http://example.com/marketing-course', 'Advanced marketing concepts');


-- Insert Static Books

INSERT INTO books (department_id, book_name, book_material) VALUES 
(1, 'MIS Book A', 'materials/mis_book_a.pdf'),
(2, 'Marketing Book B', 'materials/marketing_book_b.pdf');


-- Insert Academic Staff

INSERT INTO academic_staff (name, email, linkedin, image, office_location, department_id) VALUES 
('Dr. Ayman Salameh', 'ayman@ju.edu.jo', 'https://linkedin.com/in/ayman', 'images/ayman.jpg', 'Building A - Room 101', 1),
('Dr. Rania Haddad', 'rania@ju.edu.jo', 'https://linkedin.com/in/rania', 'images/rania.jpg', 'Building B - Room 202', 2);
