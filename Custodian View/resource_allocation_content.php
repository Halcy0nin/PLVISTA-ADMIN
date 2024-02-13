<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- bootstrap icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <!-- Bootstrap JS CDN for mobile responsiveness -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <div class = "container">
        <h3 class = "mx-3">Resource Allocation</h3>
        <br>

        <div class = "row">
            <div class = "col">

            <!-- dropdown -->
            <div class = "container d-flex">
                <div class="dropdown">

                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter
                    </button>

                    <div class="dropdown-menu rounded" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            </div>
        
        <!-- export button -->
        <div class = "col">
            <div class = "container d-flex justify-content-end">

                <!--export data button -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportReport">
            Export
            </button>

            <!-- modal before exporting data -->
            <div class="modal fade" id="exportReport" tabindex="-1" role="dialog" aria-labelledby="exportReportLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportReportLabel">Export Resource Allocation Report</h5>
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
        <!-- Table showing resource allocation info in the database -->
        <table style="margin-left: auto; margin-right: auto;" class = "table table-striped centerTable text-center">
            <thead class="thead-light"></thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">School Name</th>
                    <th scope="col">School ID</th>
                    <th scope="col">Division</th>
                    <th scope="col">School Type</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">School District</th>
                    <th scope="col">Date Added</th>
                    <th style = "width:13%;" scope="col">Action</th>
                </tr>

                <tr>
                    <td scope="row">123456</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>
                        <!-- Approve Button -->
                        <button type="button" class="btn btn-success "><i class="bi bi-check-lg"></i></button>
                        <!-- Reject Button -->
                        <button type="button" class="btn btn-danger"><i class="bi bi-x"></i></button>
                    </td>
                </tr>
        </table>

            <div class = "container d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
            </div>
    </div>
</body>


</html>