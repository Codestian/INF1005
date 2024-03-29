const tableHead = document.querySelector('#table-head');
const tableBody = document.querySelector('#table-body');

const addRowForm = document.querySelector('#add-row-form');
const editRowForm = document.querySelector('#edit-row-form');

let tableName;

const API_URI = '/api/v1/';

let selectedId = 0;

function createTable(table) {
    tableName = table;
    getData();

}

function getData() {
    //clear previous table
    tableHead.innerHTML = "";
    tableBody.innerHTML = "";


    fetch(API_URI + tableName)
        .then(response=>response.json())
        .then(data => {

            data.data.forEach((row, idx) => {
                let cid = Object.values(row)[0];
                delete row.tables;
                if(idx === 0) {

                    //Set input type for modals
                    setInputForModals(Object.keys(row));
                    tableHead.appendChild(createTableHead(...Object.keys(row), 'Actions'));
                }
                tableBody.appendChild(createTableRow(row, idx,cid));

            });
        });
}

function addData(inputForms, requestBody) {
    fetch(API_URI + tableName, {
        method: 'POST',
        body: JSON.stringify(requestBody),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            alert('Success: ' + data.data.message);
            getData();
            inputForms.forEach(formGrp => {
                const inputElement = formGrp.querySelector('.form-control');
                inputElement.value = "";
            })
        })
        .catch((error) => {
            alert('Error: ' + error);
            console.error('Error:', error);
        });
}

function updateData(inputForms, requestBody) {
    fetch(API_URI + tableName + "/" + selectedId, {
        method: 'PUT',
        body: JSON.stringify(requestBody),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            alert('Success: ' + data.data.message);
            getData();
            inputForms.forEach(formGrp => {
                const inputElement = formGrp.querySelector('.form-control');
                inputElement.value = "";
            })
        })
        .catch((error) => {
            alert('Error: ' + error);
            console.error('Error:', error);
        });
}

function deleteData() {
    let idChecked = checkedID();
    let idValues = [];
    if(idChecked === 0){
        idValues.push(selectedId);
    }
    else{
        idValues.push(...idChecked);
    }
    idValues.forEach(value => {
        fetch(API_URI + tableName + "/" + value, {
            method: 'DELETE',
        })
            .then(response => response.json())
            .catch((error) => {
                alert('Error: ' + error);
                console.error('Error:', error);
            });

    })
    alert('Success');
    getData();

}

function setInputForModals(keys) {
    addRowForm.innerHTML = "";
    editRowForm.innerHTML = "";

    keys.forEach(column => {
        if (column !== 'id') {
            let inputType;
            switch (true) {
                case column.endsWith('_id'):
                    inputType = 'number';
                    break;
                case column.includes('email'):
                    inputType = 'email';
                    break;
                default:
                    inputType = 'text';
                    break;
            }
            addRowForm.appendChild(createFormGroup(column, column, inputType));
            editRowForm.appendChild(createFormGroup(column, column, inputType));
        }
    });
}

function setInputEdit(e) {
    const rowIdx = Number(e.target.id.split("-")[1]);
    const selectedRow = tableBody.children[rowIdx];
    const columns = [...selectedRow.querySelectorAll('td')];

    columns.slice(1, -1).forEach((column, idx) => {
        const [key] = column.classList[0].split("-").slice(1);
        if (idx === 0) {
            selectedId = column.textContent;
        } else {
            editRowForm.querySelector(`#${key}`).value = column.textContent;
        }
    });

}

function addRow() {
    const inputForms = addRowForm.querySelectorAll('.form-group');

    let requestBody = {};

    inputForms.forEach(formGrp => {
        const inputElement = formGrp.querySelector('.form-control');
        requestBody[inputElement.id] = inputElement.value;
    })

    addData(inputForms, requestBody);
}

function editRow() {
    // console.log(selectedId);
    const inputForms = editRowForm.querySelectorAll('.form-group');

    let requestBody = {};

    inputForms.forEach(formGrp => {
        const inputElement = formGrp.querySelector('.form-control');
        requestBody[inputElement.id] = inputElement.value;
    })


    updateData(inputForms, requestBody);
}


// function test() {
//
//
//     fetch(API_URI + tableName)
//         .then(response=>response.json())
//         .then(data => {
//             data.data.forEach((content,idx)=>{
//                 let value = Object.value(content)[0];
//              console.log(value);
//             })
//         });
// }
