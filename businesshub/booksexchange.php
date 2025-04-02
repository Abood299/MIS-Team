<!DOCTYPE html>
<html lang="en"> 
<head>
    <!-- the link tag below for linking css bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<!-- add FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<base href="/businesshub/">
<?php $version = filemtime('css/header-footer.css'); ?>
<link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
</head>
<!-- PUT YOUR STYLE HERE GUYS ⬇⬇⬇⬇⬇⬆ -->
<style>

    h1 {
      font-size: 32px;
      margin-bottom: 20px;
    }

    .search-bar {
      margin: 20px auto;
      display: flex;
      justify-content: center;
    }

    .search-bar input {
      padding: 10px;
      width: 300px;
      border-radius: 20px 0 0 20px;
      border: 1px solid #ccc;
      outline: none;
    }

    .search-bar button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 0 20px 20px 0;
      cursor: pointer;
    }

    .filters {
      margin: 20px 0;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
    }

    .filters button {
      padding: 8px 16px;
      border: none;
      background-color: #e0e0e0;
      border-radius: 20px;
      cursor: pointer;
    }

    .book-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      margin-top: 30px;
    }

    .book-card {
      width: 220px;
      min-height: 500px;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .book-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 6px;
      background-color: #f5f5f5;
    }

    .book-info {
      flex-grow: 1;
      margin-top: 10px;
    }

    .book-title {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .book-author {
      color: gray;
      font-size: 14px;
    }

    .book-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .give-btn {
      background-color: #EC522D;
      color: white;
      border: none;
      padding: 8px;
      border-radius: 6px;
      cursor: pointer;
    }

    .take-btn {
      background-color: #6A0DAD;
      color: white;
      border: none;
      padding: 8px;
      border-radius: 6px;
      cursor: pointer;
    }

  


</style>



<body>
    
<?php include 'includes/header.php'; ?>
   
      <h1>تبادل الكتب والمواد الدراسية</h1>

      <div class="search-bar">
        <input type="text" placeholder="Search For a Book" id="searchInput" oninput="filterBooks()" />
        <button onclick="filterBooks()">Search</button>
      </div>
    
      <div class="filters">
        <button onclick="filterByMajor('all')">All Majors</button>
        <button onclick="filterByMajor('MIS')">MIS</button>
        <button onclick="filterByMajor('Accounting')">Accounting</button>
        <button onclick="filterByMajor('Marketing')">Marketing</button>
        <button onclick="filterByMajor('Finance')">Finance</button>
        <button onclick="filterByMajor('Economics')">Economics</button>
        <button onclick="filterByMajor('Public Administration')">Public Administration</button>
        <button onclick="filterByMajor('Business Administration')">Business Administration</button>
      </div>
    
      <div class="book-grid" id="bookGrid">
        <!-- All books will show here -->
        <?php
include 'connect.php';

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($book = mysqli_fetch_assoc($result)) {
    $image = $book['image'];
    $title = $book['title'];
    $author = $book['author'];
    $major = $book['major'];

    echo "
    <div class='book-card' data-major='$major'>
      <img src='$image' alt='Book Cover'>
      <div class='book-info'>
        <div class='book-title'>$title</div>
        <div class='book-author'>by $author</div>
      </div>
      <div class='book-buttons'>
        <button class='give-btn'>Give</button>
        <button class='take-btn'>Take</button>
      </div>
    </div>
    ";
  }
} else {
  echo "<p>No books found.</p>";
}
?>
      </div>
    
      <script>
        const books = [
          { major: 'MIS', title: 'Management Info Systems', author: 'Jane Doe' },
          { major: 'MIS', title: 'Systems Analysis', author: 'John Smith' },
          { major: 'Accounting', title: 'Financial Accounting', author: 'Mark Davis' },
          { major: 'Accounting', title: 'Managerial Accounting', author: 'Sara Miles' },
          { major: 'Marketing', title: 'Marketing Basics', author: 'Kate Lee' },
          { major: 'Marketing', title: 'Digital Marketing', author: 'Tom Hardy' },
          { major: 'Finance', title: 'Principles of Finance', author: 'Emily Stone' },
          { major: 'Finance', title: 'Corporate Finance', author: 'Robert West' },
          { major: 'Economics', title: 'Microeconomics Today', author: 'Olivia Brooks' },
          { major: 'Economics', title: 'Macroeconomics', author: 'Henry Wells' },
          { major: 'Public Administration', title: 'Public Sector Management', author: 'Rachel Adams' },
          { major: 'Public Administration', title: 'Govt & Society', author: 'James Lee' },
          { major: 'Business Administration', title: 'Intro to Business Admin', author: 'Angela Dean' },
          { major: 'Business Administration', title: 'Strategic Management', author: 'Victor Hunt' },
        ];
    
        const grid = document.getElementById('bookGrid');
    
        function renderBooks(filteredBooks) {
          grid.innerHTML = '';
          filteredBooks.forEach(book => {
            const card = document.createElement('div');
            card.className = 'book-card';
            card.innerHTML = `
              <img src="images/Books covers/mis.jpeg" alt="Book Cover">
              <div class="book-info">
                <div class="book-title">${book.title}</div>
                <div class="book-author">by ${book.author}</div>
              </div>
              <div class="book-buttons">
                <button class="give-btn">Give</button>
                <button class="take-btn">Take</button>
              </div>
            `;
            grid.appendChild(card);
          });
        }
    
        function filterByMajor(major) {
          if (major === 'all') {
            renderBooks(books);
          } else {
            renderBooks(books.filter(book => book.major === major));
          }
        }
    
        function filterBooks() {
          const term = document.getElementById('searchInput').value.toLowerCase();
          renderBooks(books.filter(book => book.title.toLowerCase().includes(term)));
        }
    
        // Initial display
        renderBooks(books);
      </script>




<?php include 'includes/footer.php'; ?>



















</body>
</html>