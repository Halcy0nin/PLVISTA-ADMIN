<!-- main HTML/PHP file -->

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Inventory Management System | DEPED</title>
  <link rel="stylesheet" href="school_inventory.css" /> <!-- css -->
  <link rel="icon" type="images/x-icon" href="sdo.png" /> <!-- icon sa tab -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> <!-- bootstrap -->
 <!-- bootstrap icons-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <!-- this is the side bar -->
  <nav class="sidebar">
    <a href="#" class="SDOlogo"><img src="sdo.png" height="80px" width="80px"></a>
    <div class="menu-content">
      <ul class="menu-items">
        <div class="menu-title">ICT Resource Management System</div>
        <li class="item">
          <a href="#" data-content="school_inventory_content.php" class="menu-link"><i class="bi bi-archive-fill"></i>School Inventory</a>
        </li>
        <li class="item">
          <a href="#" data-content="resource_allocation_content.php" class="menu-link"><i class="bi bi-journal-bookmark-fill"></i>Report</a>
        </li>
        <li class="item">
          <a href="#" data-content="profile_content.php" class="menu-link"><i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="item">
          <a href="login.php"><i class="bi bi-box-arrow-in-left"></i>Log Out</a>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="navbar">
  </nav>

  <main class="main">
  </main>

  <script src="dashboard.js"></script>

  <!-- Bootstrap JS CDN for mobile responsiveness -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- loads pages indicated in data_content while retaining the sidebar-->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // click event listener to the menu links
      var menuLinks = document.querySelectorAll('.menu-link');
      menuLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
          e.preventDefault();

          // Get the data-content attribute value
          var contentUrl = link.getAttribute('data-content');

          // Use fetch to get the content
          fetch(contentUrl)
            .then(function (response) {
              return response.text();
            })
            .then(function (data) {
              // Replace the content of the main section with the fetched data
              document.querySelector('.main').innerHTML = data;
            })
            .catch(function (error) {
              console.error('Error loading content:', error);
            });
        });
      });
    });
  </script>

</body>

</html>