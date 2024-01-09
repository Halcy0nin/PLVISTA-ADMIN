<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <!-- bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <!-- Bootstrap JS CDN for mobile responsiveness -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <div class = "container">
        <h3 class = "mx-3">Registered Schools</h3>
        <br>

        <div class = "row">
            <div class = "col">
            <!-- search bar -->
            <div class = "container d-flex">
                <div style = "width:260px;" class="input-group rounded">
                    <input  type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            <div>

            <!-- dropdown filter -->
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
        
        <!-- add school and export button -->
        <div class = "col">
            <div class = "container d-flex justify-content-end">
                <a href = "#">
                    <button type="button" class="btn btn-primary rounded mx-2">Add School</button>
                </a>

                <a href = "#">
                    <button type="button" class="btn btn-success rounded">Export</button>
                </a>
            </div>
        </div>

    </div>

    <div class = "container mt-5">
        <!-- Table showing all school info in the database -->
        <table style="margin-left: auto; margin-right: auto;" class = "table table-striped centerTable text-center">
            <thead class="thead-light">
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
                        <button type="button" class="btn btn-success btn-sm my-2"><i class="bi bi-pencil-fill"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></i></button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i></i></button>
                    </td>
                </tr>
            </thead>
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