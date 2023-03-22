<?php include("views/template/Top.php"); ?>

    <!-- Honestly IDK why its making me import Bootstrap again for it to work -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <style>
        .carousel-item {
            height: 30rem;
            background: #777;
        }

        .vertical-center-align {
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .col-md-5percent {
            width: 5%;
        }

        .col-md-10percent {
            width: 10%;
        }

        .col-md-50percent {
            width: 50%;
        }

        .col-md-75percent {
            width: 75%;
        }
    </style>
    <section style="padding-top: 65px;">
        <div class="container">
            <div>
                <div style="display: flex; align-items: center">
                    <div style="display: block;  width: 5%; order: 1">
                        <button style="height: 50px; width: 50px" type="button" class="btn btn-outline-danger">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                    <div style="display: block;width: 65%; order: 2">
                        <p style="font-size: 3rem; ">Restaurant Name</p>
                    </div>
                    <div style="display: block;width: 10%; order: 3">
                        <button style="height: 50px; width: 100px; " type="button"
                                class="btn btn-primary btn-outline-success">
                            Book Now
                        </button>
                    </div>
                    <div style="display: block;width: 20%; order: 4">
                        Ratings:<br>
                        STARS HERE
                    </div>
                </div>
                <div>
                    <div style="display: flex; align-items: center">
                        <div style="width: 30%">
                            <p style="font-size: 1.2rem">Restaurant Type, Food Type</p>
                        </div>
                        <div style="width: 42%">
                            <p style="font-size: 1.2rem;">
                                <i class="bi bi-currency-dollar"></i>Estimated Price
                            </p>
                        </div>
                        <div style="width: 5%">
                            <button type="button" class="btn btn-success">
                                <i class="bi bi-share-fill"></i>
                            </button>
                        </div>
                        <div style="width: 15%">
                            <button type="button" class="btn btn-primary btn-outline-success">
                                Add a Review
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; align-items: center">
                        <div style="width: 100%">
                            <p style="font-size: 1.2rem; ">
                                <i class="bi bi-geo-alt"></i>Address
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; align-items: center">
                        <div style="width: 30%">
                            <p style="font-size: 1.2rem;">
                                <i class="bi bi-clock-fill"></i> Opening Hours
                            </p>
                        </div>
                        <div>
                            <p style="font-size: 1.2rem;">
                                <i class="bi bi-book-fill"></i> Menu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="restaurantCarousel">
        <div id="restaurantImageCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#restaurantImageCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#restaurantImageCarousel" data-slide-to="1"></li>
                <li data-target="#restaurantImageCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#restaurantImageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#restaurantImageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
<div style="display: flex; width: 90%; margin-left: 5%; margin-top: 20px ">
    <div style="width: 60%;">
        <p class="font-weight-bold" style="font-size: 1.2rem">Restaurant Description</p>
        <p style="margin: 10px">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <div style="display: flex; margin-top: 30px">
            <p class="font-weight-bold" style="font-size: 1.2rem;">Popular Items</p>
            <p class="font-weight-bold" style="margin-left: auto; margin-right: 10px">view full menu</p>
        </div>
        <div class="swiffy-slider slider-item-show3 slider-item-reveal slider-nav-invisible slider-nav-dark slider-nav-inside">
            <ul class="slider-container py-4" style="padding-top: 0px">
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
            </ul>
            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>

        </div>
        <p class="font-weight-bold" style="font-size: 1.2rem">How to Reserve?</p>
        <p style="margin: 10px;">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>
    <div style="background-color: blue; width: 40%">
        <p class="font-weight-bold" style="font-size: 1.2rem">Restaurant Reviews</p>
    </div>
</div>
<div style="display: flex; margin-top: 30px">
    <div style="width: 90%; margin-left: 5%">
        <p class="font-weight-bold" style="font-size: 1.2rem">Restaurants you May like</p>
        <div class="swiffy-slider slider-item-show4 slider-item-reveal slider-nav-visible slider-nav-dark slider-nav-outside-expand">
            <ul class="slider-container py-4">
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
                <li class="">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="" class="card-img-top" loading="lazy" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title">See the world</p>
                        </div>
                    </div>
                </li>
            </ul>
            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>

        </div>
    </div>
</div>

<?php include("views/template/Bottom.php"); ?>