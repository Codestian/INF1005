
window.onload = function() {
    console.log("Loaded");
    const selectAllCheckbox = document.querySelector('#selectAll');
    if (selectAllCheckbox) {
        console.log("Exist");
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            // If the "Select All" checkbox is checked, check all the other checkboxes
            if (this.checked) {
                console.log("pressed");
                checkboxes.forEach(function(checkbox) {
                    //console.log(checkbox.id);
                    checkbox.checked = true;
                });
            } else {
                // If the "Select All" checkbox is unchecked, uncheck all the other checkboxes
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }

        });
    }
};

