<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NSPACE</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <h2 class="logo"><a href="#">NSpace</a></h2>
            <input type="checkbox" id="menu-toggle" />
            <label for="menu-toggle" id="hamburger-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </label>
            <ul class="links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Articles</a></li>
                <li><a href="#">Feedbacks</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <div class="buttons">
                <a href="signin.php" class="signin">Sign In</a>
                <a href="#" class="signup">Sign Up</a>
            </div>
        </nav>
    </header>
    <section class="hero-section">
        <div class="hero">
            <h2>Welcome to NSpace Hostel Management System!</h2>
            <p>
                Best Place to find  your dream hostel!
            </p>
            <div class="buttons">
                <a href="#" class="join">Explore</a>
                <a href="#" class="learn">Articles</a>
            </div>
        </div>
        <div class="img">
            <img src="https://www.codingnepalweb.com/demos/create-responsive-website-html-css/hero-bg.png"
                alt="hero image" />
        </div>
    </section>
</body>

</html>
