<div class="container">
    <div class="table-title">
        <div class="row d-flex">
            <div class="d-flex justify-content-end p-4">
                <button id="add-row-btn" type="submit" class="btn btn-success me-3 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addRowModal">
                    <i class="material-icons">&#xE147;</i> <span class="ps-2">Add</span></button>
                <button id="deleteRow" type="button" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteRowModal">
                    <i class="material-icons">&#xE15C;</i> <span class="ps-2">Delete</span></button>
            </div>
        </div>
    </div>
    <table id= "table-form" class="table table-striped table-hover">
        <thead id="table-head" style = "background-color:rgba(5,53,116,0.29)">
        </thead>
        <tbody id="table-body">
        </tbody>
    </table>
</div>