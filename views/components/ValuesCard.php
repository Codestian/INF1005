<div class="card text-white <?php echo $color ?? "bg-primary"; ?> col-md-6 col-lg-3 m-3 rounded-3" style="max-width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?php echo $name ?? "Value"; ?></h5>
        <p class="card-text"><?php echo $description ?? "Description"; ?></p>
    </div>
</div>