<!DOCTYPE html>
<html lang="en"> 
<head>



        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- chatgpt addons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


        <!-- add FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@600;800&display=swap" rel="stylesheet">

        <base href="/businesshub/">
        <?php $version = filemtime('css/header-footer.css'); ?>
        <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
        <link rel="stylesheet" href="css/deps.css"> <!-- to grab deps css -->

    <title>halls</title>
    <style>

/* HALLS STYLE 🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵 */

.halls-section {
    text-align: center;
    padding: 30px 10px;
  }
  .hall-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    justify-content: center;
    max-width: 1200px;
    margin: auto;
      padding: 0 20px; /* Left & right padding to shrink overall layout */
  }
  .hall-box {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    background: linear-gradient(to bottom, #4D1C70, #260143); /* top to base */
    border: 1px solid #19002E;
    border-radius: 10px;
    box-shadow:
    inset 0 1px 0 #6C45A5,           /* inner top glow */
    0 5px 0 #19002E,                 /* base border depth */
    0 10px 20px rgba(0, 0, 0, 0.2);  /* soft lift */
    color: white;
    text-align: center;
    transition: all 0.3s ease;
    border: 3px solid #ffffff93; /* Orange stroke around the whole box */
    padding: 15px;
  }
  .hall-box:hover {
    transform: scale(1.03);
    box-shadow: 0 20px 40px rgba(236, 82, 45, 0.35); /* Stronger glow */
  }
  .hall-box .preview-container {
    position: relative;
    width: 100%;
    height: 200px;
  }
  .hall-box .preview-container img,
  .hall-box .preview-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    transition: opacity 0.3s;
  }
  .hall-box .preview-container video {
    opacity: 0;
  }
  .hall-box:hover .preview-container video {
    opacity: 1;
    display: block;
  }
  .hall-box:hover .preview-container img {
    opacity: 0;
  }

  .hall-details {
    display: none;
    text-align: center;
    margin-top: 30px;
    background-color: #fdf9f7;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 10px 25px rgba(38, 1, 67, 0.15);
  }
  /* Table Styles */
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  overflow: hidden;
  border-radius: 10px;
  font-family: 'Cairo', sans-serif; /* Or your luxury font */
}

/* Table Header */
thead {
  background-color: #260143;
  color: white;
}

thead th {
  padding: 15px;
  text-align: center;
  font-weight: 700;
  font-size: 18px;
  border-bottom: 2px solid #EC522D;
  color: #EC522D;
}

/* Table Body */
tbody td {
  padding: 12px 10px;
  text-align: center;
  font-size: 16px;
  border-bottom: 1px solid #eee;
}

/* Zebra rows */
tbody tr:nth-child(even) {
  background-color: #f9f4f2;
}

/* Play Button */
table button {
  padding: 5px 12px;
  border: 2px solid #EC522D;
  background-color: transparent;
  color: #EC522D;
  font-weight: bold;
  border-radius: 6px;
  transition: all 0.3s ease;
  font-family: inherit;
}

table button:hover {
  background-color: #EC522D;
  color: white;
  cursor: pointer;
}
#buildingName {
  color: #260143;
  font-size: 28px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 20px;
}
  .hall-details video {
    width: 100%;
    max-width: 500px;
    height: auto;
    margin-top: 15px;
    border-radius: 10px;
  }
  .hall-row {
    cursor: pointer;
  }
  .hall-row:hover {
    background-color: #f1f1f1;
  }
  
/* Optional: Image styling if needed */
.hall-box img {
  border-radius: 10px;
  width: 100%;
  height: auto; 
   border: 3px solid #ffffff93; /* or any color */
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Optional */
}

/* BUILDING NAMES WITHIN BOXES */
.hall-box p {
  font-size: 23px;
  color: #EC522D;
  text-align: center;
  /* Soft surrounding glow / border */
  text-shadow:
    1px 1px 2px #b04125,
    -1px -1px 2px #b04125,
    2px 2px 5px rgba(236, 82, 45, 0.4),
    -2px -2px 5px rgba(236, 82, 45, 0.4);
  margin-top: 10px;
  font-family: 'Tajawal', sans-serif;
}
  /* search bar  */
  .search-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 30px auto;
  max-width: 500px;
}

.search-input {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #ccc;
  border-radius: 25px 0 0 25px;
  outline: none;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.search-input:focus {
  border-color: #EC522D; /* orange when focused */
}

.search-button {
  padding: 12px 16px;
  background-color: #5E2950;
  color: white;
  border: none;
  border-radius: 0 25px 25px 0;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-button:hover {
  background-color: #EC522D; /* orange hover */
}



/* heading  */
.halls-heading {
  font-size: 50px;
  font-weight: bold;
  color: #5E2950;
  text-align: center;
  margin: 30px 0;
  user-select: none;
  animation: glowHeading 3s ease-in-out infinite;
  text-shadow:
    0 0 2px #7b7979,
    1px 1px 2px #7b7979,
    0 0 20px rgba(94, 41, 80, 0.85),
    0 0 30px rgba(94, 41, 80, 0.75);
}

@keyframes glowHeading {
  0%, 100% {
    text-shadow:
      0 0 2px #7b7979,
      1px 1px 2px #7b7979,
      0 0 20px rgba(94, 41, 80, 0.85),
      0 0 30px rgba(94, 41, 80, 0.75);
  }
  50% {
    text-shadow:
      0 0 4px #7b7979,
      1px 1px 3px #7b7979,
      0 0 40px rgba(94, 41, 80, 1),
      0 0 60px rgba(94, 41, 80, 0.9);
  }
}

  /* HALLS STYLE 🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵🔵 */




</style>

</head>




<body>
    
<?php include 'includes/header.php'; ?>
 
<!-- heading -->
<h2 class="halls-heading">القاعات الدراسية</h2>


      <!-- search bar -->
      <div class="search-container">
        <input type="text" placeholder="ابحث هنا..." class="search-input">
        <button class="search-button"><i class="fas fa-search"></i></button>
      </div>
      
 

      <!-- boxes -->
      <div class="container halls-section">
           <div class="hall-grid mt-4" id="hallsContainer"></div>
      </div>
    
      <div class="container hall-details" id="hallDetails">
        <h2 id="buildingName">Building Name</h2>
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th>اسم القاعة</th>
              <th>الطابق</th>
              <th>السعة</th>
              <th>الطريق الى هناك</th>
            </tr>
          </thead>
          <tbody id="hallTableBody"></tbody>
        </table>
      </div>


        <script>
      const buildings = [
      {
        name: "أعمال (1)",
        halls: [
          { name: "Hall A", floor: "Ground Floor", capacity: 100, video: "videos/test for now.mp4" },
          { name: "Hall B", floor: "First Floor", capacity: 80, video: "videos/test for now.mp4" },
          { name: "Hall C", floor: "Second Floor", capacity: 90, video: "videos/test for now.mp4" },
          { name: "Hall D", floor: "Third Floor", capacity: 70, video: "videos/test for now.mp4" },
          { name: "Hall E", floor: "Fourth Floor", capacity: 110, video: "videos/test for now.mp4" },
          { name: "Hall F", floor: "Fifth Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall G", floor: "Sixth Floor", capacity: 85, video: "videos/test for now.mp4" },
          { name: "Hall H", floor: "Seventh Floor", capacity: 75, video: "videos/test for now.mp4" },
          { name: "Hall I", floor: "Eighth Floor", capacity: 105, video: "videos/test for now.mp4" },
          { name: "Hall J", floor: "Ninth Floor", capacity: 115, video: "videos/test for now.mp4" }
        ],
        image: "Accademicspics/picbuilding1.png",
        previewVideo: "Accademicspics/building1.mp4"
      },
      {
        name: "أعمال (2)",
        halls: [
          { name: "Hall A", floor: "Ground Floor", capacity: 120, video: "videos/test for now.mp4" },
          { name: "Hall B", floor: "First Floor", capacity: 90, video: "videos/test for now.mp4" },
          { name: "Hall C", floor: "Second Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall D", floor: "Third Floor", capacity: 80, video: "videos/test for now.mp4" },
          { name: "Hall E", floor: "Fourth Floor", capacity: 100, video: "videos/test for now.mp4" },
          { name: "Hall F", floor: "Fifth Floor", capacity: 85, video: "videos/test for now.mp4" },
          { name: "Hall G", floor: "Sixth Floor", capacity: 75, video: "videos/test for now.mp4" },
          { name: "Hall H", floor: "Seventh Floor", capacity: 110, video: "videos/test for now.mp4" },
          { name: "Hall I", floor: "Eighth Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall J", floor: "Ninth Floor", capacity: 105, video: "videos/test for now.mp4" }
        ],
        image: "Accademicspics/picbuilding2.png",
        previewVideo: "Accademicspics/building2.mp4"
      },
      {
        name: "أعمال (3)",
        halls: [
          { name: "Hall A", floor: "Ground Floor", capacity: 90, video: "videos/test for now.mp4" },
          { name: "Hall B", floor: "First Floor", capacity: 70, video: "videos/test for now.mp4" },
          { name: "Hall C", floor: "Second Floor", capacity: 80, video: "videos/test for now.mp4" },
          { name: "Hall D", floor: "Third Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall E", floor: "Fourth Floor", capacity: 100, video: "videos/test for now.mp4" },
          { name: "Hall F", floor: "Fifth Floor", capacity: 85, video: "videos/test for now.mp4" },
          { name: "Hall G", floor: "Sixth Floor", capacity: 75, video: "videos/test for now.mp4" },
          { name: "Hall H", floor: "Seventh Floor", capacity: 105, video: "videos/test for now.mp4" },
          { name: "Hall I", floor: "Eighth Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall J", floor: "Ninth Floor", capacity: 115, video: "videos/test for now.mp4" }
        ],
        image: "Accademicspics/building3.png",
        previewVideo: "videos/test for now.mp4"
      },
      {
        name: "أعمال (4)",
        halls: [
          { name: "Hall A", floor: "Ground Floor", capacity: 110, video: "videos/test for now.mp4" },
          { name: "Hall B", floor: "First Floor", capacity: 100, video: "videos/test for now.mp4" },
          { name: "Hall C", floor: "Second Floor", capacity: 90, video: "videos/test for now.mp4" },
          { name: "Hall D", floor: "Third Floor", capacity: 120, video: "videos/test for now.mp4" },
          { name: "Hall E", floor: "Fourth Floor", capacity: 105, video: "videos/test for now.mp4" },
          { name: "Hall F", floor: "Fifth Floor", capacity: 95, video: "videos/test for now.mp4" },
          { name: "Hall G", floor: "Sixth Floor", capacity: 85, video: "videos/test for now.mp4" },
          { name: "Hall H", floor: "Seventh Floor", capacity: 115, video: "videos/test for now.mp4" },
          { name: "Hall I", floor: "Eighth Floor", capacity: 100, video: "videos/test for now.mp4" },
          { name: "Hall J", floor: "Ninth Floor", capacity: 110, video: "videos/test for now.mp4" }
        ],
        image: "Accademicspics/picbuilding4.png",
        previewVideo: "Accademicspics/building4.mp4"
      }
      ];
      
      function displayBuildings() {
      const container = document.getElementById("hallsContainer");
      container.innerHTML = "";
      buildings.forEach(building => {
        container.innerHTML += `
          <div class="hall-box" onclick="showBuildingDetails('${building.name}')" onmouseover="playVideo(this)" onmouseout="pauseVideo(this)">
            <div class="preview-container">
              <img src="${building.image}" alt="${building.name}" />
              <video src="${building.previewVideo}" muted loop playsinline preload="auto"></video>
            </div>
            <p><strong>${building.name}</strong></p>
          </div>`;
      });
      }
      
      function playVideo(element) {
      const video = element.querySelector("video");
      video.play().catch(error => console.error("Error playing video:", error));
      }
      
      function pauseVideo(element) {
      const video = element.querySelector("video");
      video.pause();
      video.currentTime = 0;
      }
      
      function showBuildingDetails(buildingName) {
      // Find the building data by name
      const building = buildings.find(b => b.name === buildingName);
      if (!building) return;
      
      // Update the building name in the details section
      document.getElementById("buildingName").textContent = building.name;
      
      // Populate the table with hall details
      const tableBody = document.getElementById("hallTableBody");
      tableBody.innerHTML = ""; // Clear previous content
      building.halls.forEach(hall => {
        const row = document.createElement("tr");
        row.className = "hall-row";
        row.innerHTML = `
          <td>${hall.name}</td>
          <td>${hall.floor}</td>
          <td>${hall.capacity}</td>
          <td>
            <button onclick="playHallVideo(this, '${hall.video}'); event.stopPropagation();">Play Video</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
      
      // Show the details section and scroll into view
      const hallDetails = document.getElementById("hallDetails");
      hallDetails.style.display = "block";
      hallDetails.scrollIntoView({ behavior: "smooth" });
      }
      
      function playHallVideo(button, videoSrc) {
      // Get the current row where the button is located
      const currentRow = button.parentNode.parentNode;
      
      // Remove any open video rows that don't belong to the current row
      document.querySelectorAll('.video-row').forEach(row => {
        if (row.previousElementSibling !== currentRow) {
          row.remove();
        }
      });
      
      // If the current row already has an open video row, close it (minimize)
      if (currentRow.nextElementSibling && currentRow.nextElementSibling.classList.contains('video-row')) {
        currentRow.nextElementSibling.remove();
        return;
      }
      
      // Create a new row to display the video
      const videoRow = document.createElement('tr');
      videoRow.className = 'video-row';
      const cell = document.createElement('td');
      cell.colSpan = 4; // Span all columns
      
      // Create a container for right alignment
      const containerDiv = document.createElement('div');
      containerDiv.style.textAlign = 'right';
      
      // Create the video element with a square size (350px by 350px)
      const videoElement = document.createElement('video');
      videoElement.src = videoSrc;
      videoElement.setAttribute('controls', '');
      videoElement.setAttribute('playsinline', '');
      videoElement.setAttribute('preload', 'auto');
      videoElement.setAttribute('muted', '');
      videoElement.style.width = '450px';
      videoElement.style.height = '250px';
      videoElement.style.borderRadius = '10px';
      videoElement.style.objectFit = 'cover';
      
      containerDiv.appendChild(videoElement);
      cell.appendChild(containerDiv);
      videoRow.appendChild(cell);
      
      // Insert the new video row directly after the current row
      currentRow.parentNode.insertBefore(videoRow, currentRow.nextElementSibling);
      
      // Auto-play the video if allowed
      videoElement.play().catch(error => console.error("Error playing hall video:", error));
      }
      
      document.addEventListener("DOMContentLoaded", displayBuildings);
      </script>

<?php include 'includes/footer.php'; ?>








</body>
</html>