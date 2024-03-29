let count =0;
//Row for column Headers
function createTableHead(...rowData) {
    const tableRow = document.createElement('tr');
    const tableData = rowData.map(data => {
        const th = document.createElement('th');
        th.textContent = snakeToCapitalizedSpaced(data);
        return th;
    });



    tableRow.appendChild(createRowCheckBox(false));

    for (let i = 0; i < rowData.length; i++) {
        tableRow.appendChild(tableData[i] || document.createElement('th'));

    }

    return tableRow;
}
//Create row for users
function createTableRow(row, idx, cid) {

    const tableRow = document.createElement('tr');

    const keyArr =Object.keys(row);

    const tableData = keyArr.map(key => {
        const td = document.createElement('td');
        td.classList.add("key-" + key);
        td.textContent = row[key];

        return td;
    });



    //Checkbox
    tableRow.appendChild(createRowCheckBox(true,cid));

    //Content
    for (let i = 0; i < keyArr.length; i++) {
        tableRow.appendChild( tableData[i] || document.createElement('td'));
    }

    //Edit and delete buttons
    tableRow.appendChild(createRowButtons(idx));

    return tableRow;

}

function createRowCheckBox(isTD,cid) {

    // create the table cell element
    let td;
    if (isTD) {
        td = document.createElement('td');
    } else {
        td = document.createElement('th');
    }

// create the span element with class "custom-checkbox"
    const span = document.createElement('span');
    span.classList.add('custom-checkbox');

// create the input element with type "checkbox", id "checkbox1", name "options[]", and value "1"
    const input = document.createElement('input');
    input.type = 'checkbox';
    input.name = 'options[]';
    input.value = cid;

// create the label element with "for" attribute "checkbox1"
    const label = document.createElement('label');


    if (isTD) {
        input.id = 'checkbox'+ cid.toString();
        label.setAttribute('for', 'checkbox'+ cid.toString());
    } else {
        input.id = 'selectAll';
        label.setAttribute('for', 'selectAll');
    }
    //count++;
// append the input and label elements to the span element
    span.appendChild(input);
    span.appendChild(label);

// append the span element to the table cell element
    td.appendChild(span);

    return td;
}

//create Row buttons for users
function createRowButtons(idx) {
    // create the table cell element
    const td = document.createElement('td');

    // create the edit icon link element
    const editLink = document.createElement('a');
    editLink.href = '#editRowModal';
    editLink.classList.add('edit-row-btn');
    editLink.addEventListener('click', setInputEdit);
    editLink.dataset.bsToggle = 'modal';

    // create the edit icon element
    const editIcon = document.createElement('i');
    editIcon.classList.add('material-icons');
    editIcon.dataset.toggle = 'tooltip';
    editIcon.id = "row-" + idx;
    editIcon.title = 'Edit';
    editIcon.innerHTML = '&#xE254;';

    // append the edit icon to the edit link
    editLink.appendChild(editIcon);

    // create the delete icon link element
    const deleteLink = document.createElement('a');
    deleteLink.href = '#deleteRowModal';
    deleteLink.classList.add('delete');
    deleteLink.dataset.bsToggle = 'modal';

    // create the delete icon element
    const deleteIcon = document.createElement('i');
    deleteIcon.classList.add('material-icons');
    deleteIcon.id = 'deleteIcon';
    deleteIcon.dataset.toggle = 'tooltip';
    deleteIcon.title = 'Delete';
    deleteIcon.innerHTML = '&#xE872;';

    // append the delete icon to the delete link
    deleteLink.appendChild(deleteIcon);

    // append the edit link and delete link to the table cell element
    td.appendChild(editLink);
    td.appendChild(deleteLink);

    return td;
}

//Create textboxes for add and edit button
function createFormGroup(labelText, inputId, inputType) {
    const formGroup = document.createElement('div');
    formGroup.classList.add('form-group');

    const inputLabel = document.createElement('label');
    inputLabel.textContent = labelText;

    const inputElement = document.createElement('input');
    inputElement.type = inputType;
    inputElement.id = inputId;
    inputElement.classList.add('form-control');
    inputElement.required = true;

    inputLabel.setAttribute('for', inputId);

    formGroup.appendChild(inputLabel);
    formGroup.appendChild(inputElement);

    return formGroup;
}

//Cleaning codes
function snakeToCapitalizedSpaced(str) {
    return str.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
}
