<?php $title = "Template";
include("views/template/Top.php"); ?>


<!-- Honestly IDK why its making me import Bootstrap again for it to work -->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"-->
<!--      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Swiffy Slider CSS -->
<link href="own-carousel.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>


<script>

    let restName = "";
    let restAddress = "";
    let restDesription = "";
    let restRating = "";
    let restOpeningHours = "";
    let restClosingHours = "";
    let restPrice = "";
    let restCuisineID = "";
    let restCuisine = "";


    const apiURL = "/api/v1/restaurants/";
    const queryString = window.location.href;
    if (queryString.includes("restaurants/"))
    {
        // console.log("has rest")
        let restID = queryString.split("restaurants/").pop();
        getData(restID);
        checkLogin()
    }

    function reviewSubmit(){
        const reviewapiURL = "http://localhost/api/v1/reviews";
        var reviewScore = document.getElementById("reviewForm").elements[0].value;
        var reviewBody = document.getElementById("reviewForm").elements[1].value;
        const restID = window.location.href.split("restaurants/").pop();
        const apiCallAuthVerify = "http://localhost/api/v1/auth/verify";
        fetch(apiCallAuthVerify)
            .then(response => response.json())
            .then(data => {
                let userID = data.data.id;
                var datetime = new Date()
                datetime = datetime.toISOString()
                // console.log("User with ID: " + userID + " posted a view" + " for rest with ID: " + restID + " with score: " + reviewScore + " saying: " + reviewBody + " at ISO Date: " + datetime )
                fetch(reviewapiURL, {
                    method: 'POST',
                    body: JSON.stringify({ "rating": reviewScore, "description": reviewBody, "date": datetime, "restaurant_id": restID, "user_id": userID })
                })
                    .then(response => response.json())
                    .then(response => console.log(JSON.stringify(response)))

            })
    }

    function bookingSubmit(){
        var bookingDateTime = document.getElementById("bookingForm").elements[0].value;
        var bookingPax = document.getElementById("bookingForm").elements[1].value;
        const apiCallAuthVerify = "http://localhost/api/v1/auth/verify";
        fetch(apiCallAuthVerify)
            .then(response => response.json())
            .then(data => {
                let userID = data.data.id;
                const queryString = window.location.href;
                let restID = queryString.split("restaurants/").pop();
                let bookingTime = new Date(bookingDateTime)
                console.log(bookingTime.toISOString())
                fetch("http://localhost/api/v1/reservations", {
                    method: 'POST',
                    body: JSON.stringify({ "datetime": bookingTime.toISOString(), "pax": bookingPax, "user_id": userID, "restaurant_id": restID })
                })
                    .then(response => response.json())
                    .then(response => console.log(JSON.stringify(response)))
            })
    }

    function checkLogin(){
        const apiCallAuthVerify = "http://localhost/api/v1/auth/verify";
        fetch(apiCallAuthVerify)
            .then(response => response.json())
            .then(data => {
                message = data.data.isVerified;
                if (message == true)
                {
                    // console.log("logged in")
                    document.getElementById("restDescBookNow").setAttribute("data-bs-target", "#reviewModalLoggedInModal");
                    let tmpData = "";
                    tmpData += '<button type="button" class="btn btn-outline-success"  data-bs-toggle="modal" data-bs-target="#reviewModalLoggedInModal">\n';
                    tmpData += 'Add a Review\n';
                    tmpData += '</button>';
                    document.getElementById("ReviewButton").innerHTML = tmpData;
                    tmpData = '<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#bookingModalLoggedInModal">\n'
                    tmpData += 'Book Now\n';
                    tmpData += '</button>';
                    document.getElementById("BookingButton").innerHTML = tmpData;
                    // <button style="height: 50px; " type="button" class="btn btn-primary btn-outline-success">
                    //     Book Now
                    // </button>
                }
                else if (message == false)
                {
                    // console.log("not logged in")
                    document.getElementById("restDescBookNow").setAttribute("data-bs-target", "#reviewModalNotLoggedInModal");
                    let tmpData = "";
                    tmpData += '<button type="button" class="btn btn-outline-success"  data-bs-toggle="modal" data-bs-target="#reviewModalNotLoggedInModal">\n';
                    tmpData += 'Add a Review\n';
                    tmpData += '</button>';
                    document.getElementById("ReviewButton").innerHTML = tmpData;
                    tmpData = '<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#bookingModalNotLoggedInModal">\n'
                    tmpData += 'Book Now\n';
                    tmpData += '</button>';
                    document.getElementById("BookingButton").innerHTML = tmpData;
                }
            })
        return message;
    }

    function getData(restID) {
        const apiCallRestInfo = apiURL + restID;
        fetch(apiCallRestInfo)
            .then(response => response.json())
            .then(data => {
                let restInfo = data.data;
                console.log(restInfo[0].tables.cuisine[0].name);
                restName = restInfo[0].name;
                document.getElementById("restName").innerText = restName;
                restAddress = restInfo[0].address;
                document.getElementById("restAddr").innerText = restAddress;
                restDesription = restInfo[0].description;
                document.getElementById("restDesc").innerText = restDesription;
                restRating = restInfo[0].rating;
                let tmpData = "";
                tmpData += '<svg style="padding-right: 1%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">';
                tmpData += '<path fill="currentColor" d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>';
                tmpData += '</svg>';
                tmpData += restRating;
                document.getElementById("restRating").innerHTML = tmpData;
                restOpeningHours = restInfo[0].opening_hours;
                restClosingHours = restInfo[0].closing_hours;
                tmpData = '<i class="bi bi-clock-fill"></i>' + " " + restOpeningHours + ' - ' + restClosingHours;
                document.getElementById("restHours").innerHTML = tmpData;
                restPrice = restInfo[0].estimated_price;
                tmpData = '<i class="bi bi-currency-dollar"></i>'+ restPrice + '/pax ';
                document.getElementById("restPrice").innerHTML = tmpData;
                document.getElementById("restCuisine").innerText = "Cuisine: " + restInfo[0].tables.cuisine[0].name;

            })
        const apiCallMenuItems = apiURL + restID + "/items";
        fetch(apiCallMenuItems)
            .then(response => response.json())
            .then(data => {
                let menuItems = data.data;
                let tmpData = "";
                menuItems.forEach((item) => {
                    // console.log(item.price)
                    tmpData += '<div class="row">\n';
                    tmpData += '<div class="col-sm-3" >\n';
                    tmpData += '<p style="font-size: 1rem">\n';
                    tmpData +=  item.name + '\n';
                    tmpData += '</p>\n';
                    tmpData += '</div>\n';
                    tmpData += '<div class="col-sm-7" >\n';
                    tmpData += '<p style="font-size: 1rem">\n';
                    tmpData +=  item.description + '\n';
                    tmpData += '</p>\n';
                    tmpData += '</div>\n';
                    tmpData += '<div class="col-sm-2" >\n';
                    tmpData += '<p style="font-size: 1rem">\n';
                    tmpData +=  item.price + "S$";
                    tmpData += ' </p>\n';
                    tmpData += '</div>\n';
                    tmpData += '</div>\n';
                })
                document.getElementById("menuModalSubBody2").innerHTML = tmpData;
                tmpData = "";
                menuItems.forEach((item) => {
                    // console.log(item.price)
                    tmpData += '<li class="">\n';
                    tmpData += '<div class="card">\n';
                    tmpData += '<div class="card-body">\n';
                    tmpData += '<p class="card-title">\n';
                    tmpData +=  '<strong>' + item.name + '</strong>\n';
                    tmpData += '</p>\n';
                    tmpData += '<p class="card-title">\n';
                    tmpData +=  item.price + ' S$';
                    tmpData += '</p>\n';
                    tmpData += '</div>\n';
                    tmpData += '</div>\n';
                    tmpData += '</li>\n';
                })
                document.getElementById("menuPopularItemsList").innerHTML = tmpData;
            })

        const apiCallReviews = "http://localhost/api/v1/reviews/";
        fetch(apiCallReviews)
            .then(response => response.json())
            .then(data => {
                let reviewItems = data.data;
                // console.log(reviewItems)
                let reviewCount = 0;
                let tmpData = ""
                reviewItems.forEach((review) => {
                    if (review.restaurant_id == restID)
                    {
                        let datetime = new Date(review.date);
                        let userName = review.tables.user[0].username;
                        // console.log(review.tables.user[0].username)

                        tmpData += '<div class="d-flex">\n';
                        tmpData += '<div class="left">\n';
                        tmpData += '<span>\n';
                        tmpData += '<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="profile-pict-img img-fluid" alt=""/>\n';
                        tmpData += '</span>\n';
                        tmpData += '</div>\n';
                        tmpData += '<div class="right">\n';
                        tmpData += '<h4> ' + userName + '<span class="gig-rating text-body-2">\n';
                        tmpData += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">';
                        tmpData += '<path fill="currentColor" d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>';
                        tmpData += '</svg>\n';
                        tmpData +=  review.rating + '\n';
                        tmpData +=  '</span>\n';
                        tmpData +=  '</h4>\n';
                        tmpData +=  '<div class="review-description">\n';
                        tmpData +=  '<p>\n';
                        tmpData +=  '<p>' + review.description + '\n';
                        tmpData +=  '</p>\n';
                        tmpData +=  '</div>\n';
                        tmpData +=  '<span class="publish py-3 d-inline-block w-100">\n';
                        tmpData +=   'Published on ' + datetime.getDate() + '/' + datetime.getMonth() + '/' + datetime.getFullYear() + '\n';
                        tmpData +=  '</span>\n';
                        tmpData +=  '</div>\n';
                        tmpData += '</div>\n';
                        reviewCount++;
                    }

                })
                console.log(reviewCount)
                document.getElementById("restReviewCount").innerText = reviewCount + " Reviews";
                document.getElementById("restReviewList").innerHTML = tmpData;
            })

        const apiCallRetList = "http://localhost/api/v1/restaurants/";
        fetch(apiCallRetList)
            .then(response => response.json())
            .then(data => {
                let restList = data.data;
                let tmpData = "";
                restList.forEach((rest) => {
                    if (rest.id != restID)
                    {
                        tmpData += '<a style="color: inherit ;text-decoration: none;" href="/restaurants/' + rest.id +'" \n';
                        tmpData += '<li class="slide-visible">\n';
                        tmpData += '<div class="card">\n';
                        tmpData += '<div class="card-body">\n';
                        tmpData += '<p class="card-title"><strong>' + rest.name + '</strong></p>\n';
                        tmpData += '<p class="card-text">\n';
                        tmpData +=  rest.address + '<br> \n';
                        tmpData += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15" color="#ffbf00">';
                        tmpData += '<path fill="currentColor" d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>';
                        tmpData += '</svg>\n';
                        tmpData +=  rest.rating + '\n';
                        tmpData += '</p>\n';
                        tmpData += '</div>\n';
                        tmpData += '</div>\n';
                        tmpData += '</li>\n';
                        tmpData += '</a>\n';
                    }
                })
                document.getElementById("restRecommendList").innerHTML = tmpData;
            })


    }

</script>

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

    .review-list ul li .left span {
        width: 32px;
        height: 32px;
        display: inline-block;
    }

    .review-list ul li .left {
        flex: none;
        max-width: none;
        margin: 0 10px 0 0;
    }

    .review-list ul li .left span img {
        border-radius: 50%;
    }

    .review-list ul li .right h4 {
        font-size: 16px;
        margin: 0;
        display: flex;
    }

    .review-list ul li .right h4 .gig-rating {
        display: flex;
        align-items: center;
        margin-left: 10px;
        color: #ffbf00;
    }

    .review-list ul li .right h4 .gig-rating svg {
        margin: 0 4px 0 0px;
    }

    .country .country-flag {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
        margin: 0 7px 0 0px;
        border: 1px solid #fff;
        border-radius: 50px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .country .country-name {
        color: #95979d;
        font-size: 13px;
        font-weight: 600;
    }

    .review-list ul li {
        border-bottom: 1px solid #dadbdd;
        padding: 0 0 30px;
        margin: 0 0 30px;
    }

    .review-list ul li .right {
        flex: auto;
    }

    .review-list ul li .review-description {
        margin: 20px 0 0;
    }

    .review-list ul li .review-description p {
        font-size: 14px;
        margin: 0;
    }

    .review-list ul li .publish {
        font-size: 13px;
        color: #95979d;
    }

    .review-section h4 {
        font-size: 20px;
        color: #222325;
        font-weight: 700;
    }

    .review-section .stars-counters tr .stars-filter.fit-button {
        padding: 6px;
        border: none;
        color: #4a73e8;
        text-align: left;
    }

    .review-section .fit-progressbar-bar .fit-progressbar-background {
        position: relative;
        height: 8px;
        background: #efeff0;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        background-color: #ffffff;;
        border-radius: 999px;
    }

    .review-section .stars-counters tr .star-progress-bar .progress-fill {
        background-color: #ffb33e;
    }

    .review-section .fit-progressbar-bar .progress-fill {
        background: #2cdd9b;
        background-color: rgb(29, 191, 115);
        height: 100%;
        position: absolute;
        left: 0;
        z-index: 1;
        border-radius: 999px;
    }

    .review-section .fit-progressbar-bar {
        display: flex;
        align-items: center;
    }

    .review-section .stars-counters td {
        white-space: nowrap;
    }

    .review-section .stars-counters tr .progress-bar-container {
        width: 100%;
        padding: 0 10px 0 6px;
        margin: auto;
    }

    .ranking h6 {
        font-weight: 600;
        padding-bottom: 16px;
    }

    .ranking li {
        display: flex;
        justify-content: space-between;
        color: #95979d;
        padding-bottom: 8px;
    }

    .review-section .stars-counters td.star-num {
        color: #4a73e8;
    }

    .ranking li > span {
        color: #62646a;
        white-space: nowrap;
        margin-left: 12px;
    }

    .review-section {
        border-bottom: 1px solid #dadbdd;
        padding-bottom: 24px;
        margin-bottom: 34px;
        padding-top: 0px;
    }

    .review-section select, .review-section .select2-container {
        width: 188px !important;
        border-radius: 3px;
    }

    ul, ul li {
        list-style: none;
        margin: 0px;
    }

    .helpful-thumbs, .helpful-thumb {
        display: flex;
        align-items: center;
        font-weight: 700;
    }

</style>

<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalTitle">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menuModalBody" class="modal-body">
                <div id="menuModalSubBody1" class="container">
                    <div class="row">
                        <div class="col-sm-3" >
                            <strong><p style="font-size: 1rem">
                                    Item
                                </p>
                            </strong>
                        </div>
                        <div class="col-sm-7" >
                            <p style="font-size: 1rem">
                                <strong>
                                    Description
                                </strong>

                            </p>
                        </div>
                        <div class="col-sm-2" >
                            <p  style="font-size: 1rem">
                                <strong>
                                    Price
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="menuModalSubBody2" class="container">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reviewModalLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLoggedInModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLoggedInModalTitle">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div id="reviewModalLoggedInBody" class="modal-body">
                <form id="reviewForm">
                    <div>
                        <label for="reviewRating" >Rating out of 5</label>
                        <div>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="reviewBody">Review</label>
                        <div>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <br>
                    <div style="display: flex; justify-content: center">
                        <a id="reviewSubmit" onclick="reviewSubmit()" data-bs-dismiss="modal" class="btn btn-primary">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reviewModalNotLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalNotLoggedInModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLoggedInModalTitle">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div id="reviewModalNotLoggedInModalBody" class="modal-body">
                Please Log-in to leave a review!
                <br>
                <br>
                <a href="/login" class="btn btn-warning">Login</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingModalLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLoggedInModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLoggedInModalTitle">Make a Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div id="bookingModalLoggedInBody" class="modal-body">
                <form id="bookingForm">
                    <div>
                        <label for="reviewRating" >Date Time</label>
                        <div>
                            <input type="datetime-local">
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="reviewBody">Pax</label>
                        <div>
                            <input type="number">
                        </div>
                    </div>
                    <br>
                    <a id="bookingSubmit" onclick="bookingSubmit()" data-bs-dismiss="modal" class="btn btn-primary">Submit</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingModalNotLoggedInModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalNotLoggedInModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLoggedInModalTitle">Make a Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div id="bookingModalNotLoggedInModalBody" class="modal-body">
                Please Log-in to make a booking!
                <br>
                <br>
                <a href="/login" class="btn btn-warning">Login</a>
            </div>
        </div>
    </div>
</div>

<section style="padding-top: 10px;">
    <div style="width: 90%; margin-left: 5%">
        <div style="display: block; width: 100%">
            <div style="display: flex; align-items: center">
                <div style="display: flex; align-items: center">
                    <div style="white-space: nowrap; margin-left: 2%">
                        <p id="restName" style="font-size: 3rem; ">Restaurant Name</p>
                    </div>
                    <div id="restRating" style="margin-left: 5%; display: flex; align-items: center; color: #ffbf00;">

                    </div>
                </div>
                <!--                <div style="margin-left: auto">-->
                <!--                    <div id="BookingButton"></div>-->
                <!--                </div>-->
            </div>
            <div style="display: flex">
                <div>
                    <p style="font-size: 1.2rem; " id="restAddr">
                        <i class="bi bi-geo-alt"></i>Address
                    </p>
                </div>
                <div style="margin-left: 2%">
                    <p style="font-size: 1.2rem;" id="restHours">
                        <i class="bi bi-clock-fill"></i> Opening Hours
                    </p>
                </div>
                <div style="margin-left: auto; display: flex">
                    <!--                    <div style="margin-right: 2%;">-->
                    <!--                        <button type="button" class="btn btn-success">-->
                    <!--                            <i class="bi bi-share-fill"></i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <div style="margin-right: 2%" id="BookingButton"></div>
                    <div id="ReviewButton"></div>
                </div>
            </div>
            <div style="display: flex">
                <div>
                    <p style="font-size: 1.2rem" id="restCuisine">Cuisine: </p>
                </div>
                <div style="margin-left: 1%">
                    <p style="font-size: 1.2rem;" id="restPrice">
                        <i class="bi bi-currency-dollar"></i>Estimated Price
                    </p>
                </div>
                <div style="margin-left: 2%">
                    <p data-bs-toggle="modal" data-bs-target="#menuModal" style="font-size: 1.2rem;"> <i class="bi bi-book-fill"></i> Menu
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="restauratItemsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" id="restauratItemsCarouselInnerBody">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1499028344343-cd173ffc68a9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#restauratItemsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#restauratItemsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div style="display: flex; width: 90%; margin-left: 5%; margin-top: 20px ">
    <div style="width: 60%;">
        <p style="font-size: 1.2rem"><strong>Restaurant Description</strong></p>
        <p id="restDesc" style="margin: 10px">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <div style="display: flex; margin-top: 30px">
            <p style="font-size: 1.2rem;"> <strong>Popular Items </strong></p>
            <p style="margin-left: auto; margin-right: 10px" data-bs-toggle="modal" data-bs-target="#menuModal"> <strong>view full menu </strong></p>
        </div>
        <div class="swiffy-slider slider-item-show3 slider-item-reveal slider-nav-invisible slider-nav-dark slider-nav-inside">
            <ul id="menuPopularItemsList" class="slider-container py-4" style="padding-top: 0px">

            </ul>
            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>

        </div>
        <p style="font-size: 1.2rem"><strong>How to Reserve?</strong></p>
        <p style="margin: 10px;">
            You must be logged-in to make a Reservation. To make a reservation, simply click on <a id="restDescBookNow" data-bs-toggle="modal" data-bs-target="#bookingModalNotLoggedInModal">Book Now</a> at the top of the page, fill in your number of pax, date, and time for your reservations and click Sumbit. It's that easy!
        </p>
    </div>
    <div style="width: 40%">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 id="restReviewCount" style="font-size: 1.2rem;">0 Reviews</h4>
            </div>


            <div class="review-list">
                <ul>
                    <li id="restReviewList">

                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<div style="display: flex; margin-top: 30px">
    <div style="width: 90%; margin-left: 5%">
        <strong><p style="font-size: 1.2rem">Restaurants You May Like</p></strong>
        <div class="swiffy-slider slider-item-show4 slider-item-reveal slider-nav-visible slider-nav-dark slider-nav-outside-expand">
            <ul class="slider-container py-4" id="restRecommendList">

            </ul>
            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>

        </div>
    </div>
</div>


<?php include("views/template/Bottom.php"); ?>
