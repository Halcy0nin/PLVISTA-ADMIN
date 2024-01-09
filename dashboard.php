<!-- main HTML/PHP file -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Inventory Management System | DEPED</title>
  <link rel="stylesheet" href="dashboard.css" /> <!-- css -->
  <link rel="icon" type="images/x-icon" href="sdo.png" /> <!-- icon sa tab -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" /> <!-- bootstrap -->
</head>

<body>
  <!-- this is the side bar -->
  <nav class="sidebar">
    <a href="#" class="SDOlogo"><img src="sdo.png" height="80px" width="80px"></a>
    <div class="menu-content">
      <ul class="menu-items">
        <div class="menu-title">ICT Resource Management System</div>
        <li class="item">
          <a href="#" data-content="dashboard_content.php" class="menu-link">Dashboard</a>
        </li>
        <li class="item">
          <a href="#" data-content="school_content.php" class="menu-link">Schools</a>
        </li>
        <li class="item">
          <a href="#" data-content="users_content.php" class="menu-link">Manage Users</a>
        </li>
        <li class="item">
          <a href="#" data-content="account_settings_content.php" class="menu-link">Account Settings</a>
        </li>
        <li class="item">
          <a href="login.php">Log Out</a>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="navbar">
    <i class="fa-solid fa-bars" id="sidebar-close"></i>
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