<div class="table-wrapper">

    <header class="navbar bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><?php echo ucfirst($table_name) ?? "Table"; ?></span>
        </div>
    </header>

    <div class="container">

        <div class="table-title">
            <div class="row d-flex">
                <div class="d-flex justify-content-end p-4">
                    <button id="submit" type="submit" class="btn btn-success me-3 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addUsersModal">
                        <i class="material-icons">&#xE147;</i> <span class="ps-2">Add</span></button>
                    <button id="delete" type="button" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteUsersModal">
                        <i class="material-icons">&#xE15C;</i> <span class="ps-2">Delete</span></button>
                </div>
            </div>
        </div>

        <table id= "tableForm" class="table table-striped table-hover">
            <thead id="table-head">
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>

    </div>

    <div id="addUsersModal" class="modal fade" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Users</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User Name</label>
                            <input id = "username" type="text" class="form-control" required>
                            <label for="username"></label>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input id = "email" type="email" class="form-control" required>
                            <label for="email"></label>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id = "password" type="text" class="form-control" required>
                            <label for="password"></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input type="button" id = "addBtn" onclick="addUser();" class="btn btn-success" data-bs-dismiss="modal" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="../../../public/js/admin/getData.js"></script>
<script>
    createTable(<?php echo "'" . $table_name . "'"; ?>);
</script>