<!DOCTYPE html>
<html>
<head>
  <title>Add New Book</title>
</head>
<body>

















  <h2>Add a Book</h2>
  <form action="insert-book.php" method="POST" enctype="multipart/form-data">
  >
    <input type="text" name="title" placeholder="Book Title" required><br><br>
    <input type="text" name="author" placeholder="Author Name" required><br><br>
    <select name="major" required>
      <option value="">Select Major</option>
      <option value="MIS">MIS</option>
      <option value="Accounting">Accounting</option>
      <option value="Marketing">Marketing</option>
      <option value="Finance">Finance</option>
      <option value="Economics">Economics</option>
      <option value="Public Administration">Public Administration</option>
      <option value="Business Administration">Business Administration</option>
    </select><br><br>
    <label>Image URL:</label>
  <input type="text" name="image_url"><br><br>

  <label>Or Upload Image:</label>
  <input type="file" name="image_file" accept="image/*"><br><br>
    <button type="submit">Add Book</button>
  </form>
</body>
</html>