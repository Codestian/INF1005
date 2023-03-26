<?php $title="Admin Dashboard"; $showNavbar = true; include("views/template/Top.php"); ?>


    <!-- INSERT CONTENT HERE -->

    <!--google fonts -->
    <head>
        <title>CRUD Application</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <!-- My Css -->
        <link rel = "stylesheet" href = "../../public/css/tableHandling.css">
    </head>



    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <div class="main-content">
        <div style = "position:relative; top: 60px;" class="row">

            <!--Table Manager-->
            <div class="col-md-12">
                <div style = "left:-2px; padding:15px 15px; " class="table-wrapper">
                    <!-- Table Header -->
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Users</h2>
                            </div>
                            <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center">
                                <button id = "submit" type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUsersModal">
                                    <i class="material-icons">&#xE147;</i> <span>Add New Users</span></button>
                                <button id=" deleteBtn" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUsersModal" onclick="deleteAll()" disabled  >
                                    <i class="material-icons">&#xE15C;</i> <span>Delete</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Table Content -->

                    <table id= "tableForm" class="table table-striped table-hover">
                        <!-- Table Column Names -->
                        <thead>
                        <tr>
                            <th>
            <span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                            </th>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role ID</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <!-- User Row -->
                        <tbody id="user-list">
                        <tr>
                            <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                            <label for="checkbox1"></label>
                        </span>
                            </td>
                            <td>0</td>
                            <td>Thomas Hardy</td>
                            <td>thomashardy@mail.com</td>
                            <td>Thomas123!</td>
                            <td>0</td>
                            <td>0</td>
                            <td>
                                <a href="#editUsersModal"  class="edit" data-bs-toggle="modal">
                                    <i class="material-icons" id = "editIcon" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteUsersModal"  class="delete" data-bs-toggle="modal">
                                    <i class="material-icons" id = "deleteIcon" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>

                        </tbody>


                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#">Previous</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item active"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Add Users Modal HTML -->
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
            <!-- Edit Modal HTML -->
            <div id="editUsersModal" class="modal fade" tabindex="-1" aria-labelledby="editUsersModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Users</h4>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" id = "editID" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id = "editName" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id = "editEmail" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type = "text" id ="editPassword" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Role ID</label>
                                    <input type="text" id = "editRole_id" class="form-control" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                                <input type="button" data-bs-dismiss="modal" id = "update" class="btn btn-info" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Delete Modal HTML -->
            <div id="deleteUsersModal" class="modal fade" tabindex="-1" aria-labelledby="deleteUsersModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Users</h4>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete these Records?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                                <input type="button" class="btn btn-danger" id = "delete" data-bs-dismiss="modal" value="Delete">
                            </div>
                        </form>
                    </div>
            </div>


        </div>




    </div>
    <script src="../../public/js/tableHandling.js"></script>




<?php include("views/template/Bottom.php"); ?>