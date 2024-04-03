<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'search.html';</script>";
    exit();
}

// Display user dashboard
$welcome_message = "Welcome, " . $_SESSION['username'] . "! You are logged in.";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Evolve</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="search.css">
    </head>

    <body>
        <div class="main">
            <div data-scroll data-scroll-speed="-5" class="page1">
                <nav>

                    <img src="logo design.png" alt="">
                    <ul class="navbar-links">
                        <li><a href="mainsignlog.html">Home</a></li>
                        <li><a href="status.html">Services</a></li>
                        <li><a href="aboutus.html">About Us</a></li>
                        <li><a href="contactus.html">Contact Us</a></li>
                        <li><a href="Resource.html">Resource</a></li>

                    </ul>
                    <div class="right-nav">
                        <button><i class="ri-menu-line"></i></button>

                    </div>

                </nav>
                <div class="container">
                    <form action="https://www.google.com/maps/@19.0152704,72.8498176,12z?entry=ttu/search" method="get" class="search-bar">
                        <input type="text" placeholder="Search a location" name="q">
                        <button type="submit"><img src="search.png"></button>
                    </form>
                </div>

    </body>

    </html>