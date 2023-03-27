<div class="table-wrapper">

    <?php include("views/admin/components/Header.php"); ?>

    <?php include("views/admin/components/Table.php"); ?>

    <!-- ADD ROW MODAL -->
    <div id="addRowModal" class="modal fade" tabindex="-1" aria-labelledby="addRowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add <?php echo $table_name; ?></h4>
                        <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="add-row-form">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input onclick="addRow()" type="button" id = "addBtn" class="btn btn-success" data-bs-dismiss="modal" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT ROW MODAL -->
    <div id="editRowModal" class="modal fade" tabindex="-1" aria-labelledby="editRowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?php echo $table_name; ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="edit-row-form">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input onclick="editRow()" type="button" data-bs-dismiss="modal" id = "update" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DELETE ROW MODAL -->
    <div id="deleteRowModal" class="modal fade" tabindex="-1" aria-labelledby="deleteRowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Users</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm deletion of row?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input onclick="deleteData()" type="button" class="btn btn-danger" id = "delete" data-bs-dismiss="modal" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="../../public/js/admin/table.js"></script>
<script type="text/javascript" src="../../public/js/admin/crud.js"></script>
<script>
    createTable(<?php echo "'" . $table_name . "'"; ?>);
</script>