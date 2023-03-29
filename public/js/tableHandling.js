










const apiURL = "/api/v1/users";
const idName = 'checkbox';
let count = '';


const userList = document.querySelector('#user-list');



//Update Table
function getData() {
    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            let message = data.message;

            console.log(data.message);
            let tmpData = "";

            message.forEach((user) => {

                tmpData += "<tbody id = user-list data-id = " + user.id + " >\n" +
                    "                        <tr id = "+user.id+">\n" +
                    "                            <td>\n" +
                    "                        <span class= custom-checkbox>\n" +
                    "                            <input type= checkbox id= " + idName + user.id + " name = options[] value= \"1\" >\n" +
                    "                            <label for= " + idName + user.id + "></label>\n" +
                    "                        </span>\n" +
                    "                            </td>";
                tmpData += '<td>' + user.id + "</td>";
                tmpData += '<td>' + user.username + "</td>";
                tmpData += '<td>' + user.email + "</td>";
                tmpData += '<td>' + user.password + "</td>";
                tmpData += '<td>' + user.role_id + "</td>";
                tmpData += "<td>\n" +
                    "                                <a href=\"#editUsersModal\"  class=\"edit\" data-bs-toggle=\"modal\">\n" +
                    "                                    <i class=\"material-icons\" id = \"editIcon\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\n" +
                    "                                <a href=\"#deleteUsersModal\"  class=\"delete\" data-bs-toggle=\"modal\">\n" +
                    "                                    <i class=\"material-icons\" id = \"deleteIcon\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>\n" +
                    "                            </td>";
                tmpData += "</tr>";
                tmpData += "</tbody>";
                count++;

            });

            document.getElementById("user-list").innerHTML = tmpData;



        });
}
getData();

//Add User
function addUser() {
    let userName = document.querySelector("#username").value;
    let userEmail = document.querySelector("#email").value;
    let userPassword = document.querySelector("#password").value;

    const userData = {username: userName, email: userEmail, password: userPassword};



    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            let message = data.message;
            //console.log(message);
            userData.id= message.length.id + 1;
            userData.role_id = 1 ;
            userData.provider_id = 1;
            //console.log(userData);
            //console.log(message.length.id);


            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(userData)
            };

            fetch(apiURL, options)
                .then(response => response.json())
                .then(data => console.log(data))
                .then(()=>location.reload())
                })
                .catch(error => console.error(error));

}


//Delete and Edit Modal
userList.addEventListener('click',(e)=>{

    if (!e.target.matches('input[type="checkbox"]')) {

        e.preventDefault();
        let editButtonPressed = e.target.id == 'editIcon';
        let deleteButtonPressed = e.target.id == 'deleteIcon';

        //Delete - Remove existing user
        //method: DELETE


        let id = e.target.parentElement.parentElement.parentElement.id;
        if(deleteButtonPressed){
            deleteModal(id);
            const deleteBtn = document.querySelector('#deleteUsersModal');
            deleteBtn.addEventListener('click', (t) => {
                //console.log("pressed");
                if(t.target.id == "delete"){
                    fetchDelete(id);
                }



            });

        }
        if(editButtonPressed) {

            //Form modal will contain current
            let editID = document.querySelector("#editID");
            let name = document.querySelector("#editName");
            let email = document.querySelector("#editEmail");
            let password = document.querySelector("#editPassword");
            let role = document.querySelector("#editRole_id");



            fetch(apiURL+"/" + id )
                .then(response => response.json())
                .then(data => {
                    let message = data.message;
                    //console.log(message);


                    message.forEach((user) => {

                        editID.value = user.id;
                        name.value = user.username;
                        email.value = user.email;
                        password.value = user.password;
                        role.value = user.role_id;


                    });
                })

            const editBtn = document.querySelector('#editUsersModal');
            editBtn.addEventListener('click', (r) => {
                if(r.target.id == "update") {
                    const userData = {id : editID ,username: name.value, email: email.value,
                        password: password.value, role_id : role.value, provider_id : "1"};



                   //console.log(userData);

                    const options = {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(userData)
                    };

                    fetch(apiURL + "/" + id, options)
                        //.then(response => response.json())
                        //.then(data => console.log(data))
                        .then(()=>location.reload)

                        .catch(error=>console.log(error))


                }
            })












        }
    }


});

//Get all checkboxIDs to delete
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
    return checkedCheckboxes;

}

//delete fetch template
function fetchDelete(id){
    fetch(apiURL + "/"+  id, {
        method: 'DELETE',
    })
        .then(() => location.reload())

}

//modal for delete
function deleteModal(id){
    const deleteBtn = document.querySelector('#deleteUsersModal');
    deleteBtn.addEventListener('click', (t) => {
        //console.log(id,"pressed");
        if(t.target.id == "delete"){
            fetchDelete(id);
        }



    });
}

//for mass delete button
function deleteAll(){
    const ids = checkedID();
    const deleteBtn = document.querySelector("#delete");

    deleteBtn.addEventListener('click', (f)=>{
        ids.forEach(function(content){
            deleteModal(content);
        })
    })
}

//Disable mass delete button
const table = document.querySelector('.table-form');
table.addEventListener('change', (a) => {
    const checkboxes = table.querySelectorAll('input[type="checkbox"]:checked');
    const deleteButton = document.getElementById(' deleteBtn');


    if (checkboxes.length > 0) {
        //console.log('At least one checkbox is checked');
        deleteButton.disabled = false;
        // Do something here, e.g. enable a button
    } else {
        //console.log('No checkboxes are checked');
        deleteButton.disabled = true;
        // Do something here, e.g. disable a button
    }


});


//selectAll checkbox function
const selectAllCheckbox = document.querySelector('#checkbox0');
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


