<?php $title="Template"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section class="container px-4 pt-3 pb-5">
    <h1 class="fw-bold pb-4 display-5 fade-up" id="title"></h1>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="restaurants-row">
        <div class="col">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1512152272829-e3139592d56f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="card-img-top" alt="Image of Restaurant">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const url = window.location.href;
    const pageName = url.split("/").pop();
    const title = document.querySelector('#title');
    const restaurantsRow = document.querySelector('#restaurants-row');

    title.textContent = "The " + pageName.substring(0,1).toUpperCase() + pageName.substring(1);

    const regionIds = {
        'north': 1,
        'south': 2,
        'east': 3,
        'west': 4
    };

    const regionId = regionIds[pageName] || 0;

    function getRestaurants() {
        restaurantsRow.innerHTML = "";
        fetch('/api/v1/regions/' + regionId + "/restaurants")
            .then(response => response.json())
            .then(data => {
                if(data.status === 200) {
                    data.data.forEach(row => {
                        restaurantsRow.appendChild(
                            createCard(
                                "https://images.unsplash.com/photo-1528279027-68f0d7fce9f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
                                row.id,
                                row.name,
                                row.description
                            ));
                    });
                }
            })
            .catch(err => {
                console.error(err);
            });
    }

    function createCard(imgSrc, id, cardTitle, cardText) {
        // Create elements
        const colDiv = document.createElement("div");
        const cardDiv = document.createElement("div");
        const img = document.createElement("img");
        const cardBody = document.createElement("div");
        const cardTitleElement = document.createElement("h5");
        const cardTextElement = document.createElement("p");
        const buttonElement = document.createElement("a");

        // Set classes and attributes
        colDiv.classList.add("col");
        cardDiv.classList.add("card", "h-100", "fade-up");
        img.classList.add("card-img-top");
        img.setAttribute("src", imgSrc);
        img.setAttribute("alt", "Image of Restaurant");
        cardBody.classList.add("card-body");
        cardTitleElement.classList.add("card-title");
        cardTitleElement.textContent = cardTitle;
        cardTextElement.classList.add("card-text");
        cardTextElement.textContent = cardText;
        buttonElement.classList.add("btn", "btn-primary");
        buttonElement.textContent = "browse";
        buttonElement.href = "/restaurants/" + id;

        // Append child elements
        cardBody.appendChild(cardTitleElement);
        cardBody.appendChild(cardTextElement);
        cardBody.appendChild(buttonElement);

        cardDiv.appendChild(img);
        cardDiv.appendChild(cardBody);
        colDiv.appendChild(cardDiv);

        return colDiv;
    }

    getRestaurants();

</script>

<?php include("views/template/Bottom.php"); ?>
