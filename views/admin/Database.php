<div class="table-wrapper">

    <?php include("views/admin/components/Header.php"); ?>
    <?php include("views/admin/components/Table.php"); ?>

    <?php include("views/admin/modals/AddModal.php"); ?>
    <?php include("views/admin/modals/EditModal.php"); ?>
    <?php include("views/admin/modals/DeleteModal.php"); ?>

</div>

<script type="text/javascript" src="../../public/js/admin/table.js"></script>
<script type="text/javascript" src="../../public/js/admin/crud.js"></script>
<script>
    createTable(<?php echo "'" . $table_name . "'"; ?>);
</script>