<?php
include '../auth.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather and Pollution Comparison</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link href="../../assets/footer.css" rel="stylesheet" />
    <link href="../../assets/header.css" rel="stylesheet" />
    <link href="../../assets/sidebar.css" rel="stylesheet" />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        box-sizing: border-box;
        min-height: 100vh;
        margin: 0;
        display: grid;
        grid-template-columns: 250px 1fr;
        grid-template-rows: auto 1fr auto;
      }

      /* page structure should be
      [head] [head]
      [side] [main]
      */
      header {
        grid-column: 1 / 3;
        grid-row: 1;
      }

      .sidebar {
        grid-column: 1;
        grid-row: 2;
      }

      .container {
        grid-column: 2;
        grid-row: 2;
        padding: 50px;
      }

      footer {
        grid-column: 1 / 3;
        grid-row: 3;
      }

      h2 {
        text-align: center;
        color: #1a73e8;
        padding: 20px;
        margin-top: 20px;
      }

      table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      th,
      td {
        padding: 15px;
        border: 1px solid #ddd;
        text-align: center;
      }

      th {
        background-color: #1a73e8;
        color: white;
        font-size: 1.2em;
      }

      tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      tr:nth-child(odd) {
        background-color: #ffffff;
      }

      td {
        background-color: #fff;
        color: #555;
        font-size: 1em;
      }

      td p {
        margin: 0;
        padding: 5px;
      }

      .pollutant-row {
        white-space: pre-line;
      }

      .location-name {
        font-weight: bold;
        color: #1a73e8;
      }

      /* Responsive Design */
      @media screen and (max-width: 768px) {
        table {
          width: 100%;
          font-size: 0.9em;
        }
      }

      /* Pollutant Values */
      .pollutant-values {
        font-size: 0.9em;
      }
    </style>
  </head>
  <body>
    <!--HEADER-->
    <header>
      <div class="logo">
        <img src="../../assets/images/climatelogo.png" alt="Climate Compass logo" />
      </div>
      <nav>
        <a href="../../public/landing/landingpage.html">HOME</a>
        <a href="../../public/take_action/take_action.html">TAKE ACTION</a>
        <a href="../../public/about-us/about-us.html">ABOUT US</a>
        <a href="../../private/logout.php">LOG OUT</a>
      </nav>
    </header>
    

    <!--SIDEBAR-->
    <aside class="sidebar">
      <ul>
        <li><a href="../dashboard/dashboard.php">Dashboard</a></li>
        <li class="highlight"><a>City Comparison</a></li>
        <li><a href="../user-settings/user-settings.php">Settings</a></li>
        <li><a href="../feedback/feedback.php">Feedback</a></li>
      </ul>
    </aside>

    <div class="container">
      <h2>Weather and Pollution Comparison</h2>
      <p style="text-align: center">
        Quickly compare weather and pollution statistics for cities worldwide.
      </p>

      <table id="comparison-table">
        <thead>
          <tr id="table-headers">
            <!-- Dynamic headers will be inserted here -->
          </tr>
        </thead>
        <tbody id="comparison-table-body">
          <!-- Dynamic rows will be inserted here -->
        </tbody>
      </table>
    </div>

    
    <script src="comparisonPage.js"></script>
  </body>
</html>
