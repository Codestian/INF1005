<?php $title = "Template";
include("views/template/Top.php"); ?>


<!-- Honestly IDK why its making me import Bootstrap again for it to work -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<script>

    let restName = "";
    let restAddress = "";
    let restDesription = "";

    const apiURL = "/api/v1/restaurants/";
    const queryString = window.location.href;
    if (queryString.includes("restaurants/"))
    {
        // console.log("has rest")
        const restID = queryString.split("restaurants/").pop();
        getData(restID);
    }



    function getData(restID) {
        const apiCallRestInfo = apiURL + restID;
        fetch(apiCallRestInfo)
            .then(response => response.json())
            .then(data => {

                let restInfo = data.data;
                // console.log(restInfo);
                restName = restInfo[0].name;
                document.getElementById("restName").innerText = restName;
                restAddress = restInfo[0].address;
                document.getElementById("restAddr").innerText = restAddress;
                restDesription = restInfo[0].description;
                document.getElementById("restDesc").innerText = restDesription;
            })
        const apiCallMenuItems = apiURL + restID + "/items";
        fetch(apiCallMenuItems)
            .then(response => response.json())
            .then(data => {
                let menuItems = data.data;
                // console.log(menuItems);
                let tmpData = "";
                menuItems.forEach((item) => {
                    // console.log(item.price)
                    tmpData += '<div class="row">\n';
                    tmpData += '<div class="col-sm-8" >\n';
                    tmpData += '<p style="font-size: 1rem">\n';
                    tmpData +=  item.name + '\n';
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
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="menuModalBody" class="modal-body">
                <div id="menuModalSubBody1" class="container">
                    <div class="row">
                        <div class="col-sm-8" >
                            <p class="font-weight-bold" style="font-size: 1rem">
                                Item
                            </p>
                        </div>
                        <div class="col-sm-2" >
                            <p class="font-weight-bold" style="font-size: 1rem">
                                Price
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
<section style="padding-top: 10px;">
    <div style="width: 90%; margin-left: 5%">
        <div style="display: block; width: 100%">
            <div style="display: flex; align-items: center">
                <div style="display: flex; align-items: center">
                    <div>
                        <button style="height: 50px; width: 50px" type="button" class="btn btn-outline-danger">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                    <div style="white-space: nowrap; margin-left: 2%">
                        <p id="restName" style="font-size: 3rem; ">Restaurant Name</p>
                    </div>
                    <div style="margin-left: 5%; display: flex; align-items: center; color: #ffbf00;">
                        <svg style="padding-right: 1%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                            <path fill="currentColor"
                                  d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                        </svg>
                        5.0
                    </div>
                </div>
                <div style="margin-left: auto">
                    <button style="height: 50px; " type="button" class="btn btn-primary btn-outline-success">
                        Book Now
                    </button>
                </div>
            </div>
            <div style="display: flex">
                <div>
                    <p style="font-size: 1.2rem; " id="restAddr">
                        <i class="bi bi-geo-alt"></i>Address
                    </p>
                </div>
                <div style="margin-left: 2%">
                    <p style="font-size: 1.2rem;">
                        <i class="bi bi-clock-fill"></i> Opening Hours
                    </p>
                </div>
                <div style="margin-left: auto; display: flex">
                    <div style="margin-right: 2%;">
                        <button type="button" class="btn btn-success">
                            <i class="bi bi-share-fill"></i>
                        </button>
                    </div>
                    <div">
                    <button type="button" class="btn btn-primary btn-outline-success">
                        Add a Review
                    </button>
                </div>
                </div>
            </div>
            <div style="display: flex">
                <div>
                    <p style="font-size: 1.2rem">Restaurant Type, Food Type</p>
                </div>
                <div style="margin-left: 1%">
                    <p style="font-size: 1.2rem;">
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
        <p id="restDesc" style="margin: 10px">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <div style="display: flex; margin-top: 30px">
            <p class="font-weight-bold" style="font-size: 1.2rem;">Popular Items</p>
            <p class="font-weight-bold" style="margin-left: auto; margin-right: 10px" data-bs-toggle="modal" data-bs-target="#menuModal">view full menu</p>
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
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>
    <div style="width: 40%">
        <!--        <p class="font-weight-bold" style="font-size: 1.2rem">Restaurant Reviews</p>-->
        <div class="container">
            <div id="reviews" class="review-section">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <!--                        <p class="font-weight-bold" style="font-size: 1.2rem;">37 Reviews</p>-->
                    <h4 style="font-size: 1.2rem;">37 Reviews</h4>
                    <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2"
                          style="width: 188px;">
                <span class="selection">
                    <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                          aria-expanded="false" tabindex="0" aria-labelledby="select2-qd66-container">
                        <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                    </span>
                </span>
            </span>
                </div>
                <div class="row">
                    <!--                        <div class="col-md-6">-->
                    <div>
                        <table class="stars-counters">
                            <tbody>
                            <tr class="">
                                <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 Stars</button>
                                </span>
                                </td>
                                <td class="progress-bar-container">
                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                        <div class="fit-progressbar-background">
                                            <span class="progress-fill" style="width: 97.2973%;"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="star-num">(36)</td>
                            </tr>
                            <tr class="">
                                <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 Stars</button>
                                </span>
                                </td>
                                <td class="progress-bar-container">
                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                        <div class="fit-progressbar-background">
                                            <span class="progress-fill" style="width: 2.2973%;"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="star-num">(2)</td>
                            </tr>
                            <tr class="">
                                <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 Stars</button>
                                </span>
                                </td>
                                <td class="progress-bar-container">
                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                        <div class="fit-progressbar-background">
                                            <span class="progress-fill" style="width: 0;"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="star-num">(0)</td>
                            </tr>
                            <tr class="">
                                <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 Stars</button>
                                </span>
                                </td>
                                <td class="progress-bar-container">
                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                        <div class="fit-progressbar-background">
                                            <span class="progress-fill" style="width: 0;"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="star-num">(0)</td>
                            </tr>
                            <tr class="">
                                <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 Stars</button>
                                </span>
                                </td>
                                <td class="progress-bar-container">
                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                        <div class="fit-progressbar-background">
                                            <span class="progress-fill" style="width: 0;"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="star-num">(0)</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="review-list">
                <ul>
                    <li>
                        <div class="d-flex">
                            <div class="left">
                                    <span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                             class="profile-pict-img img-fluid" alt=""/>
                                    </span>
                            </div>
                            <div class="right">
                                <h4> User First Name <span class="gig-rating text-body-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                    <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                                </svg>
                                5.0
                            </span>
                                </h4>
                                <div class="review-description">
                                    <p>
                                        The process was smooth, after providing the required info, Pragyesh sent me
                                        an outstanding packet of wireframes. Thank you a lot!
                                    </p>
                                </div>
                                <span class="publish py-3 d-inline-block w-100">Published on 14/01/2022</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="left">
                                    <span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                             class="profile-pict-img img-fluid" alt=""/>
                                    </span>
                            </div>
                            <div class="right">
                                <h4> User First Name <span class="gig-rating text-body-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                    <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                                </svg>
                                5.0
                            </span>
                                </h4>
                                <div class="review-description">
                                    <p>
                                        The process was smooth, after providing the required info, Pragyesh sent me
                                        an outstanding packet of wireframes. Thank you a lot!
                                    </p>
                                </div>
                                <span class="publish py-3 d-inline-block w-100">Published on 14/01/2022</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="left">
                                    <span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                             class="profile-pict-img img-fluid" alt=""/>
                                    </span>
                            </div>
                            <div class="right">
                                <h4> User First Name <span class="gig-rating text-body-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                    <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                                </svg>
                                5.0
                            </span>
                                </h4>
                                <div class="review-description">
                                    <p>
                                        The process was smooth, after providing the required info, Pragyesh sent me
                                        an outstanding packet of wireframes. Thank you a lot!
                                    </p>
                                </div>
                                <span class="publish py-3 d-inline-block w-100">Published on 14/01/2022</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="left">
                                    <span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                             class="profile-pict-img img-fluid" alt=""/>
                                    </span>
                            </div>
                            <div class="right">
                                <h4> User First Name <span class="gig-rating text-body-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                    <path fill="currentColor"
                                          d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                                </svg>
                                5.0
                            </span>
                                </h4>
                                <div class="review-description">
                                    <p>
                                        The process was smooth, after providing the required info, Pragyesh sent me
                                        an outstanding packet of wireframes. Thank you a lot!
                                    </p>
                                </div>
                                <span class="publish py-3 d-inline-block w-100">Published on 14/01/2022</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

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
