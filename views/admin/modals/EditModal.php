
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