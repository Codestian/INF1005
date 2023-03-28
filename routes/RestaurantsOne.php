<?php $title="Template"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section>
    <h1>One restaurant here</h1>
</section>

<script>
    const url = window.location.href;
    const page = url.split("/").pop();

    let restaurantInfo = {};

    function getOneRestaurants() {
        fetch('/api/v1/restaurants/' + page)
            .then(response => response.json())
            .then(data => {
                if(data.data[0] && data.status === 200) {
                    restaurantInfo = data.data[0];
                    console.log(restaurantInfo);
                }
            })
            .catch(err => {
                console.error(err);
            });
    }
    getOneRestaurants();
</script>


<?php include("views/template/Bottom.php"); ?>
