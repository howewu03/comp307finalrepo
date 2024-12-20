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
      href="../../assets/header.css" rel="stylesheet"
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
    <!-- read all settings from database each time changes occur on a button -->
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
        <li class="highlight"><a>Settings</a></li>
        <li><a href="../feedback/feedback.php">Feedback</a></li>
      </ul>
    </aside>

    <!--Main Content-->
    <div class="container my-3">
      <h2 class="my-5">User Settings</h2>
      <!--ALERT-->
      <div
        id="settings-save"
        class="alert alert-success alert-dismissible fade show d-none"
      >
        Your settings have been saved.
        <button type="button" class="btn-close"></button>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h6>Temperature</h6>
          <div
            class="toggle-btn"
            data-setting="temperature"
            onclick="toggle(this)"
          >
            <div class="settings">
              <div class="left">Celsius</div>
              <div class="right">Farenheit</div>
            </div>
            <div class="slider"></div>
          </div>
        </div>
        <div class="col-md-6">
          <h6>Wind Speed</h6>
          <div
            class="toggle-btn"
            data-setting="windSpeed"
            onclick="toggle(this)"
          >
            <div class="settings">
              <div class="left">km/h</div>
              <div class="right">mph</div>
            </div>
            <div class="slider"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h6>Time Preference</h6>
          <div
            class="toggle-btn"
            data-setting="timePreference"
            onclick="toggle(this)"
          >
            <div class="settings">
              <div class="left">24-hour</div>
              <div class="right">12-hour</div>
            </div>
            <div class="slider"></div>
          </div>
        </div>
        <div class="col-md-6">
          <h6>Distance</h6>
          <div
            class="toggle-btn"
            data-setting="distance"
            onclick="toggle(this)"
          >
            <div class="settings">
              <div class="left">km</div>
              <div class="right">miles</div>
            </div>
            <div class="slider"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h6>Color Theme</h6>
          <div
            class="toggle-btn"
            data-setting="colorTheme"
            onclick="toggle(this)"
          >
            <div class="settings">
              <div class="left">Light</div>
              <div class="right">Dark</div>
            </div>
            <div class="slider"></div>
          </div>
        </div>
      </div>

      <div>
        <button class="btn btn-outline-primary reset-btn">
          Reset Settings
        </button>
      </div>
      <div>
        <button class="btn btn-outline-primary save-btn">Save Settings</button>
      </div>
    </div>


    <script>
      function toggle(element) {
        element.classList.toggle("active");
      }

      document.addEventListener("DOMContentLoaded", function () {
        const alertBox = document.getElementById("settings-save");
        const saveBtn = document.querySelector(".save-btn");
        const closeBtn = alertBox.querySelector(".btn-close");
        const resetBtn = document.querySelector(".reset-btn");
        const toggleButtons = document.querySelectorAll(".toggle-btn");

        // defualt settings
        const defaultSettings = {
          temperature: "Celsius",
          windSpeed: "km/h",
          timePreference: "24-hour",
          distance: "km",
          colorTheme: "Light",
        };

        let settings = { ...defaultSettings };

        //fetch from server
        function fetchSettings() {
          fetch("./get_settings.php", {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            },
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error(
                  "Network response was not ok " + response.statusText
                );
              }
              return response.json();
            })
            .then((data) => {
              settings = { ...settings, ...data };
              applyToUI(settings, toggleButtons);
            })
            .catch((error) => {
              console.error("Error fetching settings:", error);
            });
        }

        //settings reflected on UI
        function applyToUI(settings, toggleButtons) {
          toggleButtons.forEach((btn) => {
            const key = btn.getAttribute("data-setting");
            let shouldBeActive = false;

            switch (key) {
              case "temperature":
                shouldBeActive = settings.temperature === "Fahrenheit";
                break;
              case "windSpeed":
                shouldBeActive = settings.windSpeed === "mph";
                break;
              case "timePreference":
                shouldBeActive = settings.timePreference === "12-hour";
                break;
              case "distance":
                shouldBeActive = settings.distance === "miles";
                break;
              case "colorTheme":
                shouldBeActive = settings.colorTheme === "Dark";
                break;
            }

            if (shouldBeActive) {
              btn.classList.add("active");
            } else {
              btn.classList.remove("active");
            }
          });
        }

        // get settings from UI
        function getFromUI(toggleButtons) {
          const newSettings = {};

          toggleButtons.forEach((btn) => {
            const key = btn.getAttribute("data-setting");
            const isActive = btn.classList.contains("active");

            switch (key) {
              case "temperature":
                newSettings.temperature = isActive ? "Fahrenheit" : "Celsius";
                break;
              case "windSpeed":
                newSettings.windSpeed = isActive ? "mph" : "km/h";
                break;
              case "timePreference":
                newSettings.timePreference = isActive ? "12-hour" : "24-hour";
                break;
              case "distance":
                newSettings.distance = isActive ? "miles" : "km";
                break;
              case "colorTheme":
                newSettings.colorTheme = isActive ? "Dark" : "Light";
                break;
            }
          });

          return newSettings;
        }

        // Save btn, save to server
        saveBtn.addEventListener("click", function (e) {
          e.preventDefault();
          settings = getFromUI(toggleButtons);

          fetch("./save_settings.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(settings),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.message) {
                // on success show alert
                alertBox.classList.remove("d-none");
              } else if (data.error) {
                console.error("Error saving settings:", data.error);
              }
            })
            .catch((error) => {
              console.error("Error saving settings:", error);
            });
        });

        //close success alert
        closeBtn.addEventListener("click", function () {
          alertBox.classList.add("d-none");
        });

        //reset settings to default
        resetBtn.addEventListener("click", function () {
          settings = { ...defaultSettings };
          applyToUI(settings, toggleButtons);
        });

        //
        //
        //fetch from server on page load
        fetchSettings();
      });
    </script>
  </body>
</html>
