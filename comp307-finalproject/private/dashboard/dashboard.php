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
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!--GLOBAL STUFF-->
    <link href="../../assets/footer.css" rel="stylesheet" />
    <link href="../../assets/header.css" rel="stylesheet" />
    <link href="../../assets/sidebar.css" rel="stylesheet" />
    <link href="./styles.css" rel="stylesheet" />
    <style></style>
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
        <li class="highlight"><a>Dashboard</a></li>
        <li>
          <a href="../weather-comparison/comparison.php">City Comparison</a>
        </li>
        <li><a href="../user-settings/user-settings.php">Settings</a></li>
        <li><a href="../feedback/feedback.php">Feedback</a></li>
      </ul>
    </aside>

    <!--Main content-->
    <div class="container">
      <h2>Locations</h2>
      <p>Navigate the Future of Our Planet - One Location at a Time.</p>
      <div class="add-location">
        <button id="addLocationButton">+ Add Location</button>
      </div>
      <div class="location-list" id="locationList">
        <!-- Locations will appear here -->
      </div>
    </div>

    <div class="modal" id="modal">
      <span class="close" id="closeButton">&times;</span>
      <h4>Where have you lived?</h4>
      <div class="form-group">
        <label for="locationInput">City, Country</label>
        <input type="text" id="locationInput" />
      </div>
      <button class="btn" id="saveButton">Save</button>
      <div id="errorMessage" class="error">City not found.</div>
    </div>

    

    <script>
      const addLocationButton = document.getElementById("addLocationButton");
      const modal = document.getElementById("modal");
      const saveButton = document.getElementById("saveButton");
      const closeButton = document.getElementById("closeButton");
      const locationInput = document.getElementById("locationInput");
      const locationList = document.getElementById("locationList");
      const errorMessage = document.getElementById("errorMessage");

      let locations = [];

      addLocationButton.addEventListener("click", () => {
        modal.style.display = "block";
        locationInput.focus();
      });

      closeButton.addEventListener("click", () => {
        modal.style.display = "none";
        locationInput.value = "";
        errorMessage.style.display = "none";
      });

      const saveLoc = () => {
        const location = locationInput.value;
        if (location) {
          const dateAdded = new Date().toLocaleDateString();

          const results = fetch(
            `https://geocoding-api.open-meteo.com/v1/search?name=${location}&count=1&language=en&format=json`
          )
            .then((response) => response.json())
            .then((data) => {
              if (!data.results) {
                throw new Error(`City "${location}" not Found`);
              }
              console.log(data.results);
              var realLocation =
                data.results[0]["name"] +
                ", " +
                data.results[0]["admin1"] +
                ", " +
                data.results[0]["country"];
              locations.push({ realLocation, dateAdded });
              updateLocationList();

              modal.style.display = "none";
              locationInput.value = "";
              errorMessage.style.display = "none";
            })
            .catch((err) => {
              console.log("Error thrown: ", err);
              errorMessage.style.display = "block";
              errorMessage.innerText = err.message;
            });
        }
      };

      locationInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
          saveLoc();
        }
      });

      saveButton.addEventListener("click", saveLoc);

      function updateLocationList() {
        locationList.innerHTML = "";
        if (locations.length === 0) {
          errorMessage.style.display = "block";
        } else {
          errorMessage.style.display = "none";
        }

        locations.forEach((loc, index) => {
          const div = document.createElement("div");
          div.className = "location-item";

          const details = document.createElement("div");
          details.textContent = `${loc.realLocation} (Added on: ${loc.dateAdded})`;

          const deleteButton = document.createElement("button");
          deleteButton.textContent = "X";
          deleteButton.style.backgroundColor = "red";
          deleteButton.addEventListener("click", () => {
            locations.splice(index, 1);
            updateLocationList();
          });

          div.appendChild(details);
          div.appendChild(deleteButton);
          locationList.appendChild(div);
        });
      }
    </script>
  </body>
</html>
