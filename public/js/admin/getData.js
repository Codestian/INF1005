const tableHead = document.querySelector('#table-head');
const tableBody = document.querySelector('#table-body');
function createTable(table) {
    fetch('/api/v1/' + table)
        .then(response=>response.json())
        .then(data => {
            data.data.forEach((row, idx) => {
                if(idx === 0) {
                    tableHead.appendChild(createTableHead(...Object.keys(row), 'Actions'));
                }
                tableBody.appendChild(createTableRow(...Object.values(row)));
            });
        });
}
