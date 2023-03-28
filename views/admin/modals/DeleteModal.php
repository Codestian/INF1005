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
