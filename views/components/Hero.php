<section class="hero">
    <div class="container px-4">
        <h1 class="fw-bold pb-4 display-5 text-white"><?php echo $title ?? "Empty Page"; ?></h1>
    </div>
    <div class="hero-gradient"></div>
    <div class="hero-overlay"></div>
    <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80" alt="Photo of a restaurant">
</section>

<style>
    .hero {
        width: 100%;
        height: 280px;
        position: relative;
        display: flex;
        align-items: end;
    }

    .hero .container {
        z-index: 2;
    }

    .hero .hero-gradient {
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
        position: absolute;
        top: 0;
        left: 0;
    }

    .hero .hero-overlay {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
    }

    .hero img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
    }

</style>