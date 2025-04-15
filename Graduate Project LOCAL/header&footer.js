document.addEventListener("DOMContentLoaded", function () { 
    // Burger Menu Toggle
    const burgerMenu = document.querySelector(".burger-menu"); 
    const menuOverlay = document.querySelector(".menu-overlay"); 
    const closeButton = document.querySelector(".close-btn"); 

    burgerMenu.addEventListener("click", function () { 
        menuOverlay.classList.toggle("active"); 
    }); 

    closeButton.addEventListener("click", function () { 
        menuOverlay.classList.remove("active"); 
    }); 

    // Search Popup
    const searchIcon = document.querySelector(".fa-search"); 
    const searchPopup = document.querySelector(".search-popup"); 
    const closeSearch = document.querySelector(".close-search"); 

    searchIcon.addEventListener("click", function () { 
        searchPopup.classList.add("active"); 
    }); 

    closeSearch.addEventListener("click", function () { 
        searchPopup.classList.remove("active"); 
    }); 
});
