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

function createTableRow(...rowData) {
    const tableRow = document.createElement('tr');
    const tableData = rowData.map(data => {
        const td = document.createElement('td');
        td.textContent = data;
        return td;
    });

    tableRow.appendChild(createRowCheckBox(true));

    for (let i = 0; i < rowData.length; i++) {
        tableRow.appendChild(tableData[i] || document.createElement('td'));
    }

    tableRow.appendChild(createRowButtons());

    return tableRow;
}

function createRowCheckBox(isTD) {
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
    input.id = 'checkbox1';
    input.name = 'options[]';
    input.value = '1';

// create the label element with "for" attribute "checkbox1"
    const label = document.createElement('label');
    label.setAttribute('for', 'checkbox1');

// append the input and label elements to the span element
    span.appendChild(input);
    span.appendChild(label);

// append the span element to the table cell element
    td.appendChild(span);
    return td;
}

function createRowButtons() {
    // create the table cell element
    const td = document.createElement('td');

    // create the edit icon link element
    const editLink = document.createElement('a');
    editLink.href = '#editUsersModal';
    editLink.classList.add('edit');
    editLink.dataset.bsToggle = 'modal';

    // create the edit icon element
    const editIcon = document.createElement('i');
    editIcon.classList.add('material-icons');
    editIcon.id = 'editIcon';
    editIcon.dataset.toggle = 'tooltip';
    editIcon.title = 'Edit';
    editIcon.innerHTML = '&#xE254;';

    // append the edit icon to the edit link
    editLink.appendChild(editIcon);

    // create the delete icon link element
    const deleteLink = document.createElement('a');
    deleteLink.href = '#deleteUsersModal';
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

function snakeToCapitalizedSpaced(str) {
    return str.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
}
