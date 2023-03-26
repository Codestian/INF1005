<?php $title="Home"; include("views/template/Top.php"); ?>

<section>

    <div id="main-map">
        <img src="../public/images/SingaporeMap.png" alt="Map of Singapore" usemap="#image-map" class="maparea"
             style="justify-content:center;max-width:100%;height:auto;">
        <map name="image-map" id="image-map">

            <area class="area" target="" alt="West-side" title="West-side" href="/restaurants/west"
                  coords="485,77,549,124,494,229,539,274,541,309,484,366,520,424,486,456,476,553,15,565,0,544,54,368,188,124,299,58,341,44,393,67,423,88,450,91" shape="poly">

            <area class="area" target="" alt="North-side" title="North-side" href="/restaurants/north"
                  coords="603,0,682,10,740,57,783,112,721,184,687,196,696,232,692,264,564,302,543,260,509,226,561,123,486,70,565,10" shape="poly">

            <area class="area" target="" alt="Central-side" title="Central-side" href="/restaurants/south"
                  coords="553,322,499,370,534,414,522,459,498,478,486,585,592,626,746,639,800,586,918,514,918,465,869,412,814,377,746,358,770,333,771,308,789,289,771,261,748,236,714,230,709,277" shape="poly">

            <area class="area" target="" alt="East-side" title="East-side" href="/restaurants/east"
                  coords="706,201,702,215,753,226,808,293,786,304,778,336,775,355,810,360,842,381,883,403,904,436,937,463,933,500,1318,487,1319,441,1202,438,1243,271,1212,235,1141,234,989,204,956,226,963,198,946,174,940,145,896,146,874,186,878,170,888,143,817,109,767,152,741,180" shape="poly">
        </map>
    </div>
    <div id="heading">
        <h1 class="d-1" style="padding-top: 10px;justify-content: center;">Hello Singingingingapore</h1>
    </div>

</section>

<script>
    $(function() {
        $('.maparea').maphilight();
    });

</script>



<?php include("views/template/Bottom.php"); ?>



