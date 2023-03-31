
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

    function deleteAll(){
        const ids = checkedID();
        const deleteBtn = document.querySelector("#delete");

        deleteBtn.addEventListener('click', (f)=>{
            ids.forEach(function(content){
                deleteModal(content);
            })
        })
    }


};

function checkedID(){
    // Get all checkboxes on the page
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Create an empty array to store the checked checkboxes
    const checkedCheckboxes = [];

// Loop through all the checkboxes
    checkboxes.forEach((checkbox) => {
        // Check if the checkbox is checked
        if (checkbox.checked) {
            // Check if the checkbox is the selectAll checkbox
            if (checkbox.id != 'selectAll') {
                checkedCheckboxes.push(checkbox.id.replace('checkbox', ''));
            }
        }
    });
    console.log(checkedCheckboxes);
    return checkedCheckboxes;

}