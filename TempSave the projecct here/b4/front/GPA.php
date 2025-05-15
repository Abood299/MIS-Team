<!DOCTYPE html>
<html lang="en"> 
<meta charset="UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Base URL to make all relative paths start from /businesshub -->
  <base href="/businesshub/">

  <!-- FontAwesome + Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

  <!-- Custom CSS with cache-busting version -->
  <?php
    $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/businesshub/css/header-footer.css');
  ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $cssVersion; ?>">
  <link rel="stylesheet" href="css/deps.css">

  <!-- Notify styles (FontAwesome duplicate removed because already above) -->
  <!-- You can remove this if not used -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->

    <title>GPA</title>


    <style>


.iframe-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 30px;
  margin: 40px auto;
  max-width: 1000px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 12px 30px rgba(38, 1, 67, 0.2);
}

.custom-iframe {
  width: 100%;
  height: 600px;
  border-radius: 10px;
  border: none;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}

.graduate-title {
text-align: center;
padding: 40px 20px 20px;

}
.graduate-title h1 {
  font-size: 75px;
  font-weight: bold;
  color: #5E2950;
  text-shadow:
    /* Soft gray stroke */
    0 0 1px #7b7979,
    0 0 2px #7b7979,
    1px 1px 2px #7b7979,
    -1px -1px 2px #7b7979,


  margin: 0;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  animation: glowTitle 3s ease-in-out infinite;
}

</style>


    </head>


<?php include '../includes/header.php'; ?>
<body>
   

   
 <main class="page-content">
      <div class="graduate-title">
        <h1>حساب المعدل التراكمي</h1>
      </div>
      





      <div class="iframe-wrapper">
        <iframe 
          src="https://www.un-web.com/tools/university_of_jordan/" 
          frameborder="0" 
          class="custom-iframe"
          allowfullscreen>
        </iframe>
      </div>
      
<?php include '../includes/footer.php'; ?>


     <!-- for grey menu js all pages  -->
     <script src="js/grey.js?v=<?= time(); ?>"></script>
</body>
</html>