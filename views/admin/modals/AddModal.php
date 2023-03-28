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