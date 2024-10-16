<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form with Multi-Step Progress Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 900px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
        }

        .form-left {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        .form-right {
            width: 50%;
            background-image: url('https://payload.cargocollective.com/1/8/270313/13003736/nyc_2.gif');
            background-size: cover;
            background-position: center;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 180px;
            height: auto;
            display: block;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container input[type="text"],
        .input-container input[type="email"],
        .input-container input[type="password"] {
            width: 100%;
            padding: 15px 45px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-container .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .error {
            color: red;
            font-size: 12px;
            text-align: left;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        /* Progress Bar Styling */
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 25%;
            position: relative;
        }

        .progress-step p {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .progress-step .bullet {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ccc;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .progress-step.active .bullet {
            background-color: #007bff;
        }

        .progress-line {
            position: absolute;
            top: 75%; /* Align line with the center of the circle */
            height: 3px;
            background-color: #ccc;
            z-index: 0;
            width: calc(150% - 0px); /* Space for the circles */
            left:-30px; /* Position line at the center of the step */
            transform: translateX(-50%); /* Center the line */
        }

       

        .progress-step:first-child .progress-line {
            display: none; /* Hide line before the first circle */
        }

        .progress-step.active ~ .progress-step .progress-line {
            background-color: #007bff; /* Highlight line for active steps */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                flex-direction: column;
            }

            .form-left, .form-right {
                width: 100%;
                height: 250px;
            }

            .form-right {
                background-size: contain;
                background-position: top;
            }
        }

        #loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            background-color: white;
            display: flex;
            flex-direction: colum;
            justify-content: center;
            align-items: center;
        }

        #loader img {
            width: 300px;
            height: auto;
            display: inline-block;
        
        }

        /* Hide the content initially */
        #content {
            display: none;
        }
        
        /* Style for registration form container */
       
    </style>
</head>
<body>
    <div id="loader">
       
        <img src="http://localhost/php/logo.png" alt="City Council Logo">
        <img src="https://c.tenor.com/-8MEIx3foV0AAAAC/like-this.gif">
    </div>


<div class="form-container">
    <div class="form-left">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="http://localhost/php/logo.png" alt="City Council Logo">
        </div>

        <!-- Progress Bar Section -->
        <div class="progress-container">
            <div class="progress-step active">
                <p>Intro</p>
                <div class="bullet">1</div>
                <div class="progress-line"></div>
            </div>
            <div class="progress-step">
                <p>Contact</p>
                <div class="bullet">2</div>
                <div class="progress-line"></div>
            </div>
            <div class="progress-step">
                <p>ID</p>
                <div class="bullet">3</div>
                <div class="progress-line"></div>
            </div>
            
        </div>

        <!-- Form Section -->
        <h2>Sign Up</h2>
<form action="registrationphp.php" method="post">
        <!-- First Section -->
        <div class="form-section active" id="section1">
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" id="name" name="name" placeholder="Your Name">
                <span class="error" id="nameError"></span>
            </div>

            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" placeholder="Your Email">
                <span class="error" id="emailError"></span>
            </div>

            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" placeholder="Password">
                <span class="error" id="passwordError"></span>
            </div>

            <button type="button" id="nextBtn">Next</button>
        </div>

        <!-- Second Section -->
        <div class="form-section" id="section2">
            <div class="input-container" style="border: 1px solid black; height: 30px;">
                <i class="fas fa-phone icon"></i>
                <input type="number" id="phone" name="mobile" placeholder="Your Phone Number" style="margin-left: 40px; margin-top: 5px;">
                <span class="error" id="phoneError"></span>
            </div>

            <div class="input-container">
                <i class="fas fa-address-card icon"></i>
                <input type="text" id="address" name="address" placeholder="Your Address">
                <span class="error" id="addressError"></span>
            </div>

            <div class="input-container" style="border: 1px solid black; height: 30px;">
                <i class="fas fa-city icon"></i>
                <input type="date" id="city" name="dob" placeholder="Your Date of Birth" style="margin-left: 40px; margin-top: 5px;">
                <span class="error" id="cityError"></span>
            </div>

            <button type="button" id="prevBtn">Previous</button>
            <button type="button" id="nextBtn2">Next</button>
        </div>

        <!-- Third Section -->
        <div class="form-section" id="section3">
            <div class="input-container">
                <i class="fas fa-id-card icon"></i>
                <input type="text" id="id" name="occupation" placeholder="Your Occupation">
                <span class="error" id="idError"></span>
            </div>

            <button type="button" id="prevBtn2">Previous</button>
            <button type="submit" id="submitBtn" name="submit">Submit</button>
        </div>
    </form>
    </div>

    <div class="form-right"></div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle the Next button click for the first section
        $("#nextBtn").on("click", function() {
            var isValid = true;

            // Clear previous errors
            $(".error").text("");

            // Name validation
            var name = $("#name").val().trim();
            if (name === "") {
                $("#nameError").text("Please enter your name.");
                isValid = false;
            }

            // Email validation
            var email = $("#email").val().trim();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                $("#emailError").text("Please enter your email.");
                isValid = false;
            } else if (!emailRegex.test(email)) {
                $("#emailError").text("Please enter a valid email address.");
                isValid = false;
            }

            // Password validation
            var password = $("#password").val().trim();
            if (password === "") {
                $("#passwordError").text("Please enter your password.");
                isValid = false;
            }

            // If valid, move to the next section
            if (isValid) {
                $("#section1").removeClass("active");
                $("#section2").addClass("active");

                // Update progress bar
                $(".progress-step").removeClass("active");
                $(".progress-step").eq(1).addClass("active");
            }
        });

        // Handle the Next button click for the second section
        $("#nextBtn2").on("click", function() {
            var isValid = true;

            // Clear previous errors
            $(".error").text("");

            // Phone validation
            var phone = $("#phone").val().trim();
            if (phone === "") {
                $("#phoneError").text("Please enter your phone number.");
                isValid = false;
            }

            // Address validation
            var address = $("#address").val().trim();
            if (address === "") {
                $("#addressError").text("Please enter your address.");
                isValid = false;
            }

            // City validation
            var city = $("#city").val().trim();
            if (city === "") {
                $("#cityError").text("Please enter your DOB.");
                isValid = false;
            }

            // If valid, move to the next section
            if (isValid) {
                $("#section2").removeClass("active");
                $("#section3").addClass("active");

                // Update progress bar
                $(".progress-step").removeClass("active");
                $(".progress-step").eq(2).addClass("active");
            }
        });

        // Handle the Previous button click for the second section
        $("#prevBtn").on("click", function() {
            $("#section2").removeClass("active");
            $("#section1").addClass("active");

            // Update progress bar
            $(".progress-step").removeClass("active");
            $(".progress-step").eq(0).addClass("active");
        });

        // Handle the Previous button click for the third section
        $("#prevBtn2").on("click", function() {
            $("#section3").removeClass("active");
            $("#section2").addClass("active");

            // Update progress bar
            $(".progress-step").removeClass("active");
            $(".progress-step").eq(1).addClass("active");
        });
 
       

            
        });
   
</script>

<script>
    // Show loader for 4 seconds, then display the content
    window.onload = function() {
        setTimeout(function() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }, 4000); // 4000 milliseconds = 4 seconds
    }
</script>

</body>
</html>


