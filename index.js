document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const staffList = document.getElementById("staff-list");
    const staffRows = staffList.getElementsByTagName("tr");

    searchInput.addEventListener("keyup", function () {
        let filter = searchInput.value.toLowerCase();

        for (let i = 0; i < staffRows.length; i++) {
            let nameCell = staffRows[i].getElementsByTagName("td")[2];
            if (nameCell) {
                let nameText = nameCell.textContent || nameCell.innerText;
                if (nameText.toLowerCase().indexOf(filter) > -1) {
                    staffRows[i].style.display = "";
                } else {
                    staffRows[i].style.display = "none";
                }
            }
        }
    });
});

function filterCategory(category) {
    alert("Filtering by category: " + category);
    // Implement category filtering logic if needed
}
