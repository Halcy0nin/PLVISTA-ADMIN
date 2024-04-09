<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
     <!-- CSS FILES -->
  <link href="../Coordinator View/assets/css/bootstrap.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/dashboard.css" rel="stylesheet">
  <link href="../Coordinator View/assets/css/modal.css" rel="stylesheet">

  <!-- bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- icon sa tab -->
  <link rel="icon" type="images/x-icon" href="sdo.png"/>
</head>

<body>

<nav class="sidebar">
    <div class="menu">
  
      <div class="main-menu">
  
        <div class="logo">
        <a href="#" class="SDOlogo"><img src="sdo.png"></a>
        </div>
  
      <div class="menu-content">
      <ul class="menu-items">
        <div class="menu-title">ICT Resource Management System</div>
        <li class="item">
          <a href="dashboard_content.php">
          <i class="bi bi-bar-chart-fill"></i>Dashboard</a>
        </li>
        <li class="item">
          <a href="resource_allocation_content.php">
          <i class="bi bi-pie-chart-fill"></i>Resource Allocation</a>
        </li>
        <li class="item">
          <a href="school_content.php">
          <i class="bi bi-building-fill"></i>Schools</a>
        </li>
        <li class="item">
          <a href="manage_users_content.php">
          <i class="bi bi-person-vcard-fill"></i>Manage Users</a>
        </li>
        <li class="item">
          <a href="profile_content.php">
          <i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="item">
          <a href="login.php">
          <i class="bi bi-box-arrow-in-left"></i>Log Out</a>
        </li>
      </ul>
    </div>
          </div>
        </div>
     </nav>

    <div class = "content-container">
        <h3 class = "mx-3">Registered Schools</h3>
        <br>

        <div class = "row">
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px; margin-left: 11%" class="input-group rounded">
                    <input  type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            

            <!-- dropdown filter -->
            <div>
            <div class = "container d-flex">
            <div class="dropdown">
    <button style="margin-left: 10%;"class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        Filter
    </button>
    <ul class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
    </ul>
</div>
            </div>
            </div>
        
        <!-- add school and export button -->
        <div class = "col">
            <div class = "container d-flex justify-content-end">

<!-- Button for add schools -->
<button style = "margin-left: 0px; margin-bottom: 0px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchool">
        Add School
        </button><br>

        <!-- Pop-up form for adding schools -->
        <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSchoolLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSchoolLabel">Add School</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action = "../Coordinator View/Processes/add_school.php" method ="POST">
            <div class="modal-body">
                
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolname" placeholder= "School name" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolid" placeholder= "School ID" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                    <label> Division </label> <br>
                        <select name="schooldivision">
                        <option>DCS-Valenzuela</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                    <label> School Type </label> <br>
                        <select name="schooltype">
                            <option> Public School </option>
                            <option> Private School</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolcontact" placeholder= "School Contact Person" value = ""></input>
                `   </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolcontactno" placeholder= "School Contact Number" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                        <input type = "text" name ="schoolemail" placeholder= "School Email" value = ""></input>
                    </div>
                    <div class="form-group mb-3">
                    <label> School District </label> <br>
                        <select name="schooldistrict" value = "">
                            <option>Congressional I</option>
                            <option>Congressional II</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name = "add_school" class="btn btn-primary">Add School</button>
            </form>
            </div>
            </div>
        </div>
        </div>



                <!--export data button -->
                <button style = "margin-left: 10px; margin-bottom: 0px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#exportSchools">
            Export
            </button>

            <!-- modal before exporting data -->
            <div class="modal fade" id="exportSchools" tabindex="-1" role="dialog" aria-labelledby="exportSchoolsLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportSchoolsLabel">Export Registered Schools Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to export this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>

    </div>

    <div class = "container mt-5">
        <!-- Table showing all school info in the database -->
        <table style="width: 1000px; margin-left: auto; margin-right: auto;" class="table table-striped centerTable">
    <thead class="thead-light"></thead>
        <tr class="text-center">
            <th style="width: 10%;" scope="col">ID</th>
            <th style="margin: right 50px;" scope="col">School Name</th>
            <th style="width: 10%;" scope="col">School ID</th>
            <th style="width: 10%;" scope="col">Division</th>
            <th style="width: 10%;" scope="col">School Type</th>
            <th style="width: 10%;" scope="col">Contact Person</th>
            <th style="width: 10%;" scope="col">Contact No.</th>
            <th style="width: 10%;" scope="col">Email</th>
            <th style="width: 10%;" scope="col">School District</th>
            <th style="width: 10%;" scope="col">Date Added</th>
            <th style="width: 10%;" scope="col"></th>
            <th style="width: 10%;" scope="col">Action</th>
            <th style="width: 10%;" scope="col"></th> <!-- Adjusted width -->
        </tr>

                <!-- loops through all of the data in the table and displays it per row -->

                <td scope="row"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateschool">
            Edit School
            </button></td>

                <!-- Pop-up form for updating schools -->
                <div class="modal fade" id="updateschool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateschoolLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateschoolLabel">Edit School</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action = "../Coordinator View/Processes/edit_school.php" method ="POST">
                            <div class="modal-body">
                                <!-- set the following values to the last selected value in the dropdown list -->

                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolname" placeholder= "School name" value = ""></input>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolid" placeholder= "School ID" value = ""></input>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> Division </label> <br>
                                        <select name="schooldivision">
                                        <option value="DCS-Valenzuela" >DCS-Valenzuela</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> School Type </label> <br>
                                        <select name="schooltype">
                                            <option value="Public School" > Public School </option>
                                            <option value="Private School" > Private School</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolcontact" placeholder= "School Contact Person" value = ""></input>
                                `   </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolcontactno" placeholder= "School Contact Number" value = ""></input>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type = "text" name ="schoolemail" placeholder= "School Email" value = ""></input>
                                    </div>
                                    <div class="form-group mb-3">
                                    <label> School District </label> <br>
                                        <select name="schooldistrict">
                                            <option value="Congressional I" >Congressional I</option>
                                            <option value="Congressional II" >Congressional II</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- shows the current id of the row of data through an input field -->
                                <input type = "hidden" name = "id_to_update" value = "">
                                <button type="submit" name = "updateschool" class="btn btn-primary">Edit School</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>

             <!-- button to delete school record -->
            <td>
            <!-- creates a unique id for each modal as to not create loops -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteschool">
            Delete School
            </button>
            </td>   
            <div class="modal fade" id="deleteschool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteschoolLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteschoolLabel">Delete School</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action = "../Coordinator View/Processes/delete_school.php" method ="POST">
                                        <div class="modal-body">
                                        <h4>Are you sure you want to delete </h4>
                                        <p>This action cannot be undone</p>
                                        
                                                <!-- shows the current id of the row of data through an input field -->
                                                <input type = "hidden" name = "id_to_delete" value = "">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!-- submits id of current row to POST array and sends it to delete_school.php -->
                                                <input type = "submit" name = "deleteschool" value = "Delete School" class = "btn btn-primary">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
            <td><form action='"../Coordinator View/Processes/school_inventory.php"' method='GET'>
                                <input type='hidden' name='inventoryid' value= "">
                                <input type='hidden' name='inventoryname' value= "">
                                <button type='submit' class="btn btn-primary btn-sm">View Inventory</button>
                            </form></td>
        </tr>
        </table>

           
    <!-- JS FILES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.js"></script>
    <script src="../Coordinator View/assets/js/bootstrap.bundle.min.js"></script>
</body>


</html>