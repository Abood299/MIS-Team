<!DOCTYPE html>
<html lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- the link tag below for linking css bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- put on all pages  -->
       <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">

    <style>

:root {
      --primary-color: #0d6efd;
      --secondary-color: #6c757d;
      --light-bg: #f8f9fa;
      --dark-text: #343a40;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }
    /* Global Styles for Books Exchange */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      color: var(--dark-text);
    }
   /* Page Title */
   .page-title {
      text-align: center;
      margin: 2rem 0 1rem 0;
    }
    /* Category Tabs */
    .category-tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 2rem;
      margin-bottom: 2rem;
    }
    .category-tabs button {
      border: none;
      background-color: #ddd;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      cursor: pointer;
      transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .category-tabs button.active,
    .category-tabs button:hover {
      background-color: #bbb;
      transform: scale(1.05);
    }
    /* Book Grid */
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1rem;
      padding: 0 1rem;
      margin-bottom: 2rem;
    }
    .book-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: center;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color: #fff;
    }
    .book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px var(--card-shadow);
    }
    /* Wrap the image to position status on top */
    .book-image-container {
      position: relative;
    }
    .book-image-container img {
      border-radius: 4px;
      width: 100%;
      height: auto;
      display: block;
    }
    /* Book Status Bar */
    .book-status {
      position: absolute;
      top: 5px;
      right: 5px;
      font-size: 0.8rem;
      padding: 2px 5px;
      border-radius: 5px;
      color: #fff;
    }
    .book-status.available {
      background-color: green;
    }
    .book-status.unavailable {
      background-color: red;
    }
    .book-card h6 {
      margin: 0.5rem 0;
      font-size: 1.1rem;
      font-weight: 500;
    }
    .book-card p {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 0.5rem;
    }
    .book-card .btn {
      margin: 0.25rem;
      font-size: 0.9rem;
    }

</style>
</head>


<body>

  <?php include 'includes/header.php'; ?>



  <!-- MAIN BOOKS EXCHANGE CONTENT -->
  <!-- Page Title -->
  <div class="page-title">
    <h1>Books Exchange</h1>
  </div>
  
  <!-- Main Search Bar (Slightly Smaller) -->
  <div class="container search-container-main">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="input-group">
          <input id="searchInput" type="text" class="form-control" placeholder="search for book" aria-label="search for book" />
          <button class="btn btn-primary" id="searchBtn">Search</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Category Tabs -->
  <div class="category-tabs container">
    <button class="active" data-category="all">All Majors</button>
    <button data-category="MIS">MIS</button>
    <button data-category="Accounting">Accounting</button>
    <button data-category="Marketing">Marketing</button>
    <button data-category="Finance">Finance</button>
    <button data-category="Economics">Economics</button>
    <button data-category="Public Administration">Public Administration</button>
    <button data-category="Business Administration">Business Administration</button>
  </div>
  
  <!-- BOOK GRID: 4 books per major with status bar on top right -->
  <div class="book-grid container" id="bookGrid">
    <!-- MIS Books -->
    <div class="book-card" data-category="MIS">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="MIS Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Management Information Systems</h6>
      <p>by Jane Doe</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="MIS">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="MIS Book Cover">
        <!-- Example: Not Available status -->
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Systems Analysis & Design</h6>
      <p>by John Smith</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="MIS">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="MIS Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Database Management</h6>
      <p>by Alice Johnson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="MIS">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="MIS Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Information Security</h6>
      <p>by Robert Brown</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Accounting Books -->
    <div class="book-card" data-category="Accounting">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Accounting Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Financial Accounting</h6>
      <p>by Emily Brown</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Accounting">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Accounting Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Managerial Accounting</h6>
      <p>by Michael Davis</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Accounting">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Accounting Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Cost Accounting</h6>
      <p>by John Doe</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Accounting">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Accounting Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Auditing Principles</h6>
      <p>by Sarah Lee</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Marketing Books -->
    <div class="book-card" data-category="Marketing">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Marketing Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Marketing Strategies</h6>
      <p>by Megan Chan</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Marketing">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Marketing Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Digital Marketing 101</h6>
      <p>by Sam Wilson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Marketing">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Marketing Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Brand Management</h6>
      <p>by Patricia Miller</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Marketing">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Marketing Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Consumer Behavior</h6>
      <p>by Karen Taylor</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Finance Books -->
    <div class="book-card" data-category="Finance">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Finance Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Corporate Finance</h6>
      <p>by Sarah Lee</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Finance">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Finance Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Investment Banking</h6>
      <p>by John Miller</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Finance">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Finance Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Financial Markets</h6>
      <p>by Alex Johnson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Finance">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Finance Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Portfolio Management</h6>
      <p>by Mark Davis</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Economics Books -->
    <div class="book-card" data-category="Economics">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Economics Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Principles of Economics</h6>
      <p>by Robert Johnson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Economics">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Economics Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Microeconomics Essentials</h6>
      <p>by Emma Watson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Economics">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Economics Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Macroeconomics Concepts</h6>
      <p>by William Taylor</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Economics">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Economics Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Economic Development</h6>
      <p>by Emily Davis</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Public Administration Books -->
    <div class="book-card" data-category="Public Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Public Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Public Policy & Administration</h6>
      <p>by David Wilson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Public Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Public Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Government Management</h6>
      <p>by Lisa Adams</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Public Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Public Administration Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Public Sector Economics</h6>
      <p>by Mark Thompson</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Public Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Public Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Administrative Law</h6>
      <p>by Laura Scott</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    
    <!-- Business Administration Books -->
    <div class="book-card" data-category="Business Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Business Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Business Management Essentials</h6>
      <p>by Mark Brown</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Business Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Business Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Leadership in Business</h6>
      <p>by Lucy Gray</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Business Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Business Administration Book Cover">
        <div class="book-status unavailable" data-copies="0">Not Available</div>
      </div>
      <h6>Strategic Management</h6>
      <p>by Kevin White</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
    <div class="book-card" data-category="Business Administration">
      <div class="book-image-container">
        <img src="Academicpics/dummybook.jpeg" alt="Business Administration Book Cover">
        <div class="book-status available" data-copies="3">Available (3 copies)</div>
      </div>
      <h6>Organizational Behavior</h6>
      <p>by Diana Black</p>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#giveModal">Give</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#takeModal">Take</button>
    </div>
  </div>
  

<!-- MODALS -->
  <!-- Modal: Give Form -->
  <div class="modal fade" id="giveModal" tabindex="-1" aria-labelledby="giveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="giveModalLabel">Give a Book - Identification Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="giveForm">
            <div class="mb-3">
              <label for="giverFullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="giverFullName" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
              <label for="giverEmailAddress" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="giverEmailAddress" placeholder="Enter your email address" required>
            </div>
            <div class="mb-3">
              <label for="giverPhoneNumber" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="giverPhoneNumber" placeholder="Enter your phone number" required>
            </div>
            <div class="mb-3">
              <label for="giverStudentId" class="form-label">Student ID</label>
              <input type="text" class="form-control" id="giverStudentId" placeholder="Enter your Student ID" required>
            </div>
            <div class="mb-3">
              <label for="giverMajor" class="form-label">Major/Department</label>
              <select class="form-select" id="giverMajor" required>
                <option value="">Select your major</option>
                <option value="MIS">MIS</option>
                <option value="Accounting">Accounting</option>
                <option value="Marketing">Marketing</option>
                <option value="Finance">Finance</option>
                <option value="Economics">Economics</option>
                <option value="Public Administration">Public Administration</option>
                <option value="Business Administration">Business Administration</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="giverBookDetails" class="form-label">Book Details (Title, Author, etc.)</label>
              <textarea class="form-control" id="giverBookDetails" rows="3" placeholder="Provide any details about the book you are giving" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit (Give)</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal: Take Form -->
  <div class="modal fade" id="takeModal" tabindex="-1" aria-labelledby="takeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="takeModalLabel">Take a Book - Request Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Left Column: Request Form -->
            <div class="col-md-6">
              <form id="takeForm">
                <div class="mb-3">
                  <label for="takerFullName" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="takerFullName" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                  <label for="takerEmailAddress" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="takerEmailAddress" placeholder="Enter your email address" required>
                </div>
                <div class="mb-3">
                  <label for="takerPhoneNumber" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" id="takerPhoneNumber" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                  <label for="takerStudentId" class="form-label">Student ID</label>
                  <input type="text" class="form-control" id="takerStudentId" placeholder="Enter your Student ID" required>
                </div>
                <div class="mb-3">
                  <label for="takerMajor" class="form-label">Major/Department</label>
                  <select class="form-select" id="takerMajor" required>
                    <option value="">Select your major</option>
                    <option value="MIS">MIS</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Finance">Finance</option>
                    <option value="Economics">Economics</option>
                    <option value="Public Administration">Public Administration</option>
                    <option value="Business Administration">Business Administration</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="takerBookDetails" class="form-label">Book Request Details</label>
                  <textarea class="form-control" id="takerBookDetails" rows="3" placeholder="Which book are you taking or requesting?" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit (Take)</button>
              </form>
            </div>
            <!-- Right Column: List of Potential Givers -->
            <div class="col-md-6">
              <h5>People Who Offered This Book</h5>
              <p class="text-muted">Choose whom you’d like to request the book from:</p>
              <ul class="list-group" id="giverList">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong>John Smith</strong><br>
                    <small>Major: MIS | ID: 12345</small>
                  </div>
                  <button class="btn btn-sm btn-outline-primary request-btn" data-giver="John Smith">Request</button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong>Jane Doe</strong><br>
                    <small>Major: Accounting | ID: 67890</small>
                  </div>
                  <button class="btn btn-sm btn-outline-primary request-btn" data-giver="Jane Doe">Request</button>
                </li>
              </ul>
              <div class="mt-3" id="requestStatus"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  

  <!-- ✅ Footer last -->
  <?php include 'includes/footer.php'; ?>





  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS for Header and Books Exchange functionalities -->
  <script>
    // Global variable to store the currently selected book card
    let selectedBookCard = null;
    
    // Attach click events to each "Give" button to store its book card
    document.querySelectorAll('.btn-success').forEach(btn => {
      btn.addEventListener('click', function() {
        selectedBookCard = this.closest('.book-card');
      });
    });
    // Attach click events to each "Take" button to store its book card
    document.querySelectorAll('.btn-primary').forEach(btn => {
      btn.addEventListener('click', function() {
        selectedBookCard = this.closest('.book-card');
      });
    });

// Books Exchange: Category Filtering Logic
const categoryButtonsList = document.querySelectorAll('.category-tabs button');
    const bookCards = document.querySelectorAll('.book-card');
    categoryButtonsList.forEach(button => {
      button.addEventListener('click', () => {
        categoryButtonsList.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        const selectedCategory = button.getAttribute('data-category');
        bookCards.forEach(card => {
          if (selectedCategory === "all" || card.getAttribute('data-category') === selectedCategory) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
    document.addEventListener('DOMCondummybooked', () => {
      document.querySelector('[data-category="all"]').click();
    });
    
    // Search Functionality: Filter book cards by title (Main Search Bar)
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    function filterBooks() {
      const filterText = searchInput.value.toLowerCase();
      bookCards.forEach(card => {
        const title = card.querySelector('h6').textContent.toLowerCase();
        if (title.includes(filterText)) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }
    searchInput.addEventListener('input', filterBooks);
    searchBtn.addEventListener('click', filterBooks);
    
    // Handle "Give" form submission and update book status (increase count)
    document.getElementById('giveForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Your "Give" submission has been received!');
      const giveModal = bootstrap.Modal.getInstance(document.getElementById('giveModal'));
      giveModal.hide();
      if(selectedBookCard) {
          const statusEl = selectedBookCard.querySelector('.book-status');
          let count = parseInt(statusEl.getAttribute('data-copies'));
          count++;
          statusEl.setAttribute('data-copies', count);
          statusEl.textContent = "Available (" + count + " copies)";
          statusEl.classList.remove('unavailable');
          statusEl.classList.add('available');
      }
      this.reset();
    });
    
    // Handle "Take" form submission and update book status (decrease count)
    document.getElementById('takeForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Your "Take" submission has been received!');
      const takeModal = bootstrap.Modal.getInstance(document.getElementById('takeModal'));
      takeModal.hide();
      if(selectedBookCard) {
          const statusEl = selectedBookCard.querySelector('.book-status');
          let count = parseInt(statusEl.getAttribute('data-copies'));
          if(count > 0) {
             count--;
             statusEl.setAttribute('data-copies', count);
             if(count === 0) {
                 statusEl.textContent = "Not Available";
                 statusEl.classList.remove('available');
                 statusEl.classList.add('unavailable');
             } else {
                 statusEl.textContent = "Available (" + count + " copies)";
             }
          }
      }
      this.reset();
    });
    
    // Handle request buttons (simulate request status)
    const requestButtonsList = document.querySelectorAll('.request-btn');
    const requestStatus = document.getElementById('requestStatus');
    requestButtonsList.forEach(btn => {
      btn.addEventListener('click', () => {
        const takeForm = document.getElementById('takeForm');
        if (!takeForm.checkValidity()) {
          alert("Please fill in all required fields in the form before sending a request.");
          return;
        }
        const giverName = btn.getAttribute('data-giver');
        requestStatus.innerHTML = `
          <p class="text-muted">
            Sending request to <strong>${giverName}</strong>...
          </p>
        `;
        setTimeout(() => {
          const accepted = Math.random() < 0.7;
          if (accepted) {
            requestStatus.innerHTML = `
              <p class="text-success">
                <strong>${giverName}</strong> has accepted your request!<br>
                <a href="live-chat.html" class="btn btn-sm btn-success mt-2">
                  Proceed to Live Chat
                </a>
              </p>
            `;
          } else {
            requestStatus.innerHTML = `
              <p class="text-danger">
                Sorry, <strong>${giverName}</strong> declined your request.<br>
                Please choose another giver or try again later.
              </p>
            `;
          }
        }, 2000);
      });
    });

  </script>














</body>
</html>
