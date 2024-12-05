<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Booking</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .greetCard {
            background-color:lightblue;
            margin-top:50px;
            width:80%;
            height:80%;
            border-radius:20px;
            position:relative;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .header {
            font-size:48px;
            font-weight:bold;
        }

        .button {
            background-color: white;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius:5px;
            transition: transform 0.3s ease;
        }
        .button:hover {
            background-color: white;
            color: black;
            text-decoration: none;
            cursor: pointer;
            transform: scale(1.2);
        }
        .cardText{
            text-align:left;
            margin:10px;
        }
    </style>
</head>
<body>
    <div class="container greetCard">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div style="text-align:left;">
                <h1 class="header">Welcome to Doctor Booking</h1>
                <h4>6 Easy Steps. 100% HIPPA Compliant</h4>
                <h4 style="margin-bottom:50px;">Quick Online Certification</h4>
                <a href="?page=booking" class="button">Book an Appointment</a>
                <a href="?page=login" class="button">Login</a>
            </div>
            <img src="./asset/doctor.avif" alt="Doctor Booking" width="500" style="border-radius:20px"/>
        </div>
        <div class="container mt-5">
            <h2>How It Works</h2>
            <p>Virtual Seesions With Board Certified Doctors</p>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="card p-2" style="width:22%; border-radius:20px;">
                    <img class="cardText" src="./asset/icon/profile.jpg" width="50"/>
                    <h4 class="cardText">Complete your patient profile</h4>
                    <h6 class="cardText">Complete your medical consent form, upload your id, email, etc.</h6>
                </div>
                <div class="card p-2" style="width:22%; border-radius:20px;">
                    <img class="cardText" src="./asset/icon/office.png" width="50"/>
                    <h4 class="cardText">Choose a suitable office</h4>
                    <h6 class="cardText">Pick a suitable office from a variety of our different branches</h6>
                </div>
                <div class="card p-2" style="width:22%; border-radius:20px;">
                    <img class="cardText" src="./asset/icon/doctor_icon.jpg" width="50"/>
                    <h4 class="cardText">Appoint a doctor of your choice</h4>
                    <h6 class="cardText">Appoint base on Specialization, Experience or Reputation </h6>
                </div>
                <div class="card p-2" style="width:22%; border-radius:20px;">
                    <img class="cardText" src="./asset/icon/schedule.png" width="50"/>
                    <h4 class="cardText">Set a suitable schedule</h4>
                    <h6 class="cardText">Choose a comfortable timeslot from our working schedule </h6>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
