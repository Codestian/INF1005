




let table = document.querySelector("#tableForm");


const apiURL = "/api/v1/users";
const idName = 'checkbox';
const count = document.querySelectorAll('input[type="checkbox"]').length -1 ;
const userList = document.querySelector('#user-list');




function getData() {
    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            let message = data.message;
            console.log(message);
            let tmpData = "";
            message.forEach((user) => {
                tmpData += "<tbody id = user-list data-id =" + user.id + " >\n" +
                    "                        <tr id = "+user.id+">\n" +
                    "                            <td>\n" +
                    "                        <span class= custom-checkbox>\n" +
                    "                            <input type= checkbox id=" + idName + count  + " name = options[] value=\"1\">\n" +
                    "                            <label for=" + idName + count + "></label>\n" +
                    "                        </span>\n" +
                    "                            </td>";
                tmpData += '<td>' + user.id + "</td>";
                tmpData += '<td>' + user.username + "</td>";
                tmpData += '<td>' + user.email + "</td>";
                tmpData += '<td>' + user.password + "</td>";
                tmpData += '<td>' + user.id + "</td>";
                tmpData += "<td>\n" +
                    "                                <a href=\"#editUsersModal\"  class=\"edit\" data-bs-toggle=\"modal\">\n" +
                    "                                    <i class=\"material-icons\" id = \"editIcon\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\n" +
                    "                                <a href=\"#deleteUsersModal\"  class=\"delete\" data-bs-toggle=\"modal\">\n" +
                    "                                    <i class=\"material-icons\" id = \"deleteIcon\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>\n" +
                    "                            </td>";
                tmpData += "</tr>";
                tmpData += "</tbody>";

            });

            document.getElementById("user-list").innerHTML = tmpData;



        });
}
getData();

function addUser() {
    let userName = document.querySelector("#username").value;
    let userEmail = document.querySelector("#email").value;
    let userPassword = document.querySelector("#password").value;

    const userData = {username: userName, email: userEmail, password: userPassword};



    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            let message = data.message;
            console.log(message);
            message.forEach((user) => {
                let userID = user.id;
                userData.role_id = userID + 2;
                userData.provider_id = userID;
            });

            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(userData)
            };

            fetch(apiURL, options)
                .then(response => response.json())
                .then(data => {
                    let message = data.message;
                    console.log(message);
                    getData();
                })
                .catch(error => console.error(error));
        })
}



userList.addEventListener('click',(e)=>{

    e.preventDefault();
    let editButtonPressed = e.target.id == 'editIcon';
    let deleteButtonPressed = e.target.id == 'deleteIcon';

    //Delete - Remove existing user
    //method: DELETE


    let id = e.target.parentElement.parentElement.parentElement.id;
    if(deleteButtonPressed){

        const deleteBtn = document.querySelector('#deleteUsersModal');
        deleteBtn.addEventListener('click', (t) => {
            fetch(apiURL + "/"+  id, {
                method: 'DELETE',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log('User deleted successfully!');
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        });

    }
    if(editButtonPressed) {

        //Form modal will contain current
        let name = document.querySelector("#editName");
        let email = document.querySelector("#editEmail");
        let password = document.querySelector("#editPassword");

        fetch(apiURL+"/" + id )
            .then(response => response.json())
            .then(data => {
                let message = data.message;
                console.log(message);
                let tmpData = "";
                message.forEach((user) => {
                    name.value = user.username;
                    email.value = user.email;
                    password.value = user.password;


                });

                const editBtn = document.querySelector('#editUsersModal');
                editBtn.addEventListener('click', (r) => {


                })



            })
    }

});



