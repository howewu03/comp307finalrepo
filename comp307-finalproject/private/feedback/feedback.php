<?php
include '../auth.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Climate Compass</title>
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
    <link href="./styles.css" rel="stylesheet" />
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
        <li>
          <a href="../weather-comparison/comparison.php">City Comparison</a>
        </li>
        <li>
          <a href="../user-settings/user-settings.php">Settings</a>
        </li>
        <li class="highlight">
          <a>Feedback</a>
        </li>
      </ul>
    </aside>

    <div class="container my-5">
      <div>
        <h2 class="text-center">Climate Compass Feedback</h2>
        <p class="text-center">
          We value your feedback! Help us improve our weather and pollution info
          service.
        </p>
      </div>
      <img src="../../assets/images/earth.png" class="happyguy" />

      <!--ALERT-->
      <div
        id="feedback-alert"
        class="alert alert-success alert-dismissible fade show d-none"
      >
        <strong>Thank you!</strong> Your feedback has been submitted.
        <button type="button" class="btn-close"></button>
      </div>

      <form
        id="feedback-form"
        class="bg-white p-4 rounded shadow-sm"
        action="./submit_feedback.php"
        method="POST"
      >
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            placeholder="Your Name"
            required
          />
        </div>

        <div class="mb-3">
          <label for="rating" class="form-label"
            >How would you rate your experience?</label
          >
          <select id="rating" name="rating" class="form-select" required>
            <option value="" disabled selected>Select a rating</option>
            <option value="5">★★★★★ - Excellent</option>
            <option value="4">★★★★ - Very Good</option>
            <option value="3">★★★ - Good</option>
            <option value="2">★★ - Fair</option>
            <option value="1">★ - Poor</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="comments" class="form-label">Your Feedback:</label>
          <textarea
            id="comments"
            name="comments"
            class="form-control"
            rows="5"
            placeholder="Share your thoughts..."
            required
          ></textarea>
        </div>

        <div class="mb-3">
          <label for="suggestions" class="form-label"
            >Suggestions for new features or improvements:</label
          >
          <textarea
            id="suggestions"
            name="suggestions"
            class="form-control"
            rows="3"
            placeholder="E.g., more pollutant data..."
          ></textarea>
        </div>

        <button type="submit" class="btn btn-outline-primary submit-btn">
          Submit Feedback
        </button>
      </form>
    </div>

    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("feedback-form");
        const alertBox = document.getElementById("feedback-alert");
        const closeButton = document.querySelector(".btn-close");

        form.addEventListener("submit", function (e) {
          e.preventDefault();
          const formData = new FormData(form);

          fetch(form.action, {
            method: form.method,
            body: formData,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                alertBox.classList.remove("d-none");
                form.reset();
              } else {
                console.error("Error:", data.message);
              }
            })
            .catch((error) => {
              console.error("Unexpected Error:", error);
            });
        });

        //close btn success alert
        closeBtn.addEventListener("click", function () {
          btn.parentElement.classList.add("d-none");
        });
      });
    </script>
  </body>
</html>
