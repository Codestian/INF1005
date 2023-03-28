<?php $title="Restaurants"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section>
    <h1>Restaurant master directory here</h1>
</section>

<script>
    let restaurantInfoArr = [];

    function getAllRestaurants() {
        fetch('/api/v1/restaurants')
            .then(response => response.json())
            .then(data => {
                if(data.status === 200) {
                    restaurantInfoArr = data.data;
                    console.log(restaurantInfoArr);
                }
            })
            .catch(err => {
                console.error(err);
            });
    }
    getAllRestaurants();
</script>

<?php include("views/template/Bottom.php"); ?>
