// // Define the data for the cards
// let entries = {restaurants:"",roles:"" ,items:"", reviews :"", reservations: "",users:"",regions:"",providers:""  };
// const api = "http://localhost/api/v1/"
//
//
//
//
//
//
//
//
// const mainContainer = document.querySelector(".container");
//
// // Create the row container
// const rowContainer = document.createElement('div');
// rowContainer.id = 'dashboard';
// rowContainer.classList.add('row', 'mb-2', 'row', 'align-items-md-stretch');
//
// for(const i in entries){
//     fetch( api + i.toString())
//         .then(response=>response.json())
//         .then(data => {
//             let val = data.data.length;
//             if ( val > 0){
//                 entries[i] = val;
//             }
//             else{
//                 entries[i] = 0;
//             }
//
//
//         });
// }
//
// // Create a card for each key in entries
// for (const key in entries) {
//
//     const card = document.createElement('div');
//     card.classList.add('col-md-6');
//
//     const cardContent = document.createElement('div');
//     cardContent.id = 'group';
//     cardContent.classList.add('row', 'g-0', 'border', 'rounded', 'overflow-hidden', 'flex-md-row', 'mb-4', 'shadow-sm', 'h-md-250', 'position-relative');
//
//     const cardCol = document.createElement('div');
//     cardCol.classList.add('col-lg', 'p-4', 'position-static');
//
//     const cardHeader = document.createElement('div');
//     cardHeader.classList.add('d-flex', 'justify-content-between', 'align-items-center');
//
//     const cardHeaderText = document.createElement('div');
//     cardHeaderText.id = 'one';
//
//     const cardHeaderTextP = document.createElement('p');
//     cardHeaderTextP.classList.add('d-inline-block', 'mb-2');
//     cardHeaderTextP.textContent = 'No of entries';
//     cardHeaderText.appendChild(cardHeaderTextP);
//
//     const cardHeaderTextH3 = document.createElement('h3');
//     cardHeaderTextH3.classList.add('mb-0');
//     cardHeaderTextH3.textContent = key;
//     cardHeaderText.appendChild(cardHeaderTextH3);
//
//     const cardHeaderNumber = document.createElement('div');
//     cardHeaderNumber.id = 'two';
//
//     const cardHeaderH1 = document.createElement('h1');
//     cardHeaderH1.classList.add('d-inline-block');
//     cardHeaderH1.textContent = entries[key].toString();
//     cardHeaderNumber.appendChild(cardHeaderH1);
//
//     cardHeader.appendChild(cardHeaderText);
//     cardHeader.appendChild(cardHeaderNumber);
//
//     cardCol.appendChild(cardHeader);
//     cardContent.appendChild(cardCol);
//     card.appendChild(cardContent);
//
//     rowContainer.appendChild(card);
// }
// console.log(entries);
// // Append the row container to the main container
// mainContainer.appendChild(rowContainer);

// Define the data for the cards
let entries = {restaurants:"", roles:"", items:"", reviews:"", reservations:"", users:"", regions:"", providers:""};
const api = "http://localhost/api/v1/";

const mainContainer = document.querySelector(".container");

// Create the row container
const rowContainer = document.createElement('div');
rowContainer.id = 'dashboard';
rowContainer.classList.add('row', 'mb-2', 'row', 'align-items-md-stretch');

// Fetch data for each entry type and update the entries object
const fetchEntries = Object.keys(entries).map((key) => {
    return fetch(api + key)
        .then(response => response.json())
        .then(data => {
            entries[key] = data.data.length;
        })
        .catch(error => {
            console.log(`Error fetching ${key} data: ${error}`);
        });
});

// Wait for all fetch requests to complete before creating the cards
Promise.all(fetchEntries)
    .then(() => {
        // Create a card for each key in entries
        for (const key in entries) {
            const card = document.createElement('div');
            card.classList.add('col-md-6');

            const cardContent = document.createElement('div');
            cardContent.id = 'group';
            cardContent.classList.add('row', 'g-0', 'border', 'rounded', 'overflow-hidden', 'flex-md-row', 'mb-4', 'shadow-sm', 'h-md-250', 'position-relative');

            const cardCol = document.createElement('div');
            cardCol.classList.add('col-lg', 'p-4', 'position-static');

            const cardHeader = document.createElement('div');
            cardHeader.classList.add('d-flex', 'justify-content-between', 'align-items-center');

            const cardHeaderText = document.createElement('div');
            cardHeaderText.id = 'one';

            const cardHeaderTextP = document.createElement('p');
            cardHeaderTextP.classList.add('d-inline-block', 'mb-2');
            cardHeaderTextP.textContent = 'No of entries';
            cardHeaderText.appendChild(cardHeaderTextP);

            const cardHeaderTextH3 = document.createElement('h3');
            cardHeaderTextH3.classList.add('mb-0');
            cardHeaderTextH3.textContent = key;
            cardHeaderText.appendChild(cardHeaderTextH3);

            const cardHeaderNumber = document.createElement('div');
            cardHeaderNumber.id = 'two';

            const cardHeaderH1 = document.createElement('h1');
            cardHeaderH1.classList.add('d-inline-block');
            cardHeaderH1.textContent = (entries[key] > 999) ? "999+" : entries[key].toString();
            cardHeaderNumber.appendChild(cardHeaderH1);

            cardHeader.appendChild(cardHeaderText);
            cardHeader.appendChild(cardHeaderNumber);

            cardCol.appendChild(cardHeader);
            cardContent.appendChild(cardCol);
            card.appendChild(cardContent);

            rowContainer.appendChild(card);
        }

        // Append the row container to the main container
        mainContainer.appendChild(rowContainer);
    })
    .catch(error => {
        console.log(`Error fetching data: ${error}`);
    });
