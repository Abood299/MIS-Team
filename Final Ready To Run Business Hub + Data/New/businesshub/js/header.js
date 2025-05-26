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


        
   
    
       
    