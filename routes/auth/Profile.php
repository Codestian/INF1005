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

    <div class="modal" id="itemModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" id="add-item">
                <div class="modal-header">
                    <h5 class="modal-title">Add a Restaurant Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                        <div class="form-group">
                            <label for="res-item">Restaurant Item: </label>
                            <input type="text" class="form-control" id="res-item" required name="res-item" placeholder="Enter the Restaurant's item.">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="res-item-desc">Item Description: </label>
                            <input type="text" class="form-control" id="res-item-desc" required name="res-item-desc" placeholder="What is this Item about.">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="rest-item-price">Price: </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="rest-item-price" required name="rest-item-price" placeholder="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="restaurant">Restaurant: </label>
                            <select class="form-select" required id="restaurant">
                            </select>
                        </div>
                        <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="../../public/js/auth/profile.js"></script>


<?php include("views/template/Bottom.php"); ?>
