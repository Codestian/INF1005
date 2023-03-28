<?php $title="Template"; include("views/template/Top.php"); ?>


<!-- INSERT CONTENT HERE -->
<section>
    <h1>East side best side</h1>
</section>

<script>
    const url = window.location.href;
    const page = url.split("/").pop();

    console.log(page);

    // const pageIndices = {
    //     '': 0,
    //     'restaurants': 1,
    //     'about': 2,
    //     'contact': 3,
    //     'work': 4
    // };
    //
    // if(pageIndices[page]) {
    //     navigationLinks[pageIndices[page]].classList.add("active");
    // }
</script>

<?php include("views/template/Bottom.php"); ?>
