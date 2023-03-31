<?php $title="Template"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section>
    <div class="container-fluid">
        <h3 class="text-dark mb-4" id="welcome"></h3>
        <div class="row mb-3" style="padding-bottom: 0px;margin-bottom: 80px;">
            <div class="col-lg-4" style="margin-bottom: 99px;">
                <div class="card mb-3">
                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" id="profile-pic" width="160" height="160">
                        <div class="mb-3" id="profile-container">
                            <image id="profile-pic" />
                        </div>
                        <input type="file" id="my-file" hidden="hidden"/>
                        <button class="btn btn-primary btn-sm" id="button-file" type="button">Change Photo</button>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0">Recent Reviews</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Restaurant ID</h4>
                        <div class="card"><img class="card-img w-100 d-block">
                            <div class="card-img-overlay"></div>
                        </div>
                        <p class="card-text">Review Comment</p>
                    </div>
                </div>
                <div class="card"></div>
            </div>
            <div class="col-lg-8" style="padding-bottom: 0px;margin-bottom: 98px;">
                <div class="row">
                    <div class="col" style="padding-bottom: 0px;margin-bottom: -2px;">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Make A Booking!</p>
                            </div>
                            <div class="card-body">
                                <p>To make a restaurant booking, choose your preferred restaurant and book on their page!</p>
                                <a href="/restaurants"><button class="btn btn-primary" type="button" >Restaurants</button></a>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Favorite Restaurants!</p>
                            </div>
                            <div class="card-body">
                                <p>To check restaurants that you loved. Click on the Favorites button below!</p><button class="btn btn-primary" type="button">Favourites</button>
                            </div>
                        </div>
                        <div class="card shadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript" src="../../public/js/auth/profile.js"></script>


<?php include("views/template/Bottom.php"); ?>
