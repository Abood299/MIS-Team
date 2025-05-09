 document.addEventListener("DOMContentLoaded", function() {
        const burgerMenu = document.querySelector(".burger-menu");
        const menuOverlay = document.querySelector(".menu-overlay");
    
        burgerMenu.addEventListener("click", function() {
            menuOverlay.classList.toggle("active");
        });
    });
    
       
      
        document.addEventListener("DOMContentLoaded", function() {
            const burgerMenu = document.querySelector(".burger-menu");
            const menuOverlay = document.querySelector(".menu-overlay");
            const closeButton = document.querySelector(".close-btn-gry");
    
           
            burgerMenu.addEventListener("click", function() {
                menuOverlay.classList.add("active"); 
            });
    
            
            closeButton.addEventListener("click", function() {
                menuOverlay.classList.remove("active"); 
            });
        });
    
   
        document.addEventListener("DOMContentLoaded", function () {
            const searchIcon = document.querySelector(".fa-search");
            const searchPopup = document.querySelector(".search-popup");
     

    
            searchIcon.addEventListener("click", function () {
                searchPopup.classList.add("active");
            });
    
            closeSearch.addEventListener("click", function () {
                searchPopup.classList.remove("active");
            });
    
            // Close on outside click
            searchPopup.addEventListener("click", function (e) {
                if (e.target === searchPopup) {
                    searchPopup.classList.remove("active");
                }
            });
        });


        
    // Buildings with up to 10 halls each (fill manually as needed)
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
        image: "Accademicspics/images.jpg",
        previewVideo: "videos/test for now.mp4"
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
        image: "Accademicspics/مبنى 2.jpg",
        previewVideo: "videos/test for now.mp4"
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
        image: "Accademicspics/download (2).jpg",
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
        image: "Accademicspics/download (1).jpg",
        previewVideo: "videos/test for now.mp4"
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
  
   
    
    
       
    