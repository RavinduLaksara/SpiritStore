<?php
include("dbconnect.php");
include("Headers/customerHeader.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link ref="stylesheet" href="styles/home.css">

</head>

<body>

    <section class="hero">

        <div class="slide">
            <img src="https://picsum.photos/200/300" alt="liquor bottle 3" class="animated-image">

        </div>

        <div class="slide">
            <img src="image/home1 (2).jpg" alt="liquor bottle 2" class="animated-image">
        </div>

        <div class="slide">
            <img src="image/home1 (3).jpg" alt="liquor bottle 1" class="animated-image">
        </div>

        <h1 class="hero-heading">Welcome to Spirit Store</h1>

        <p class="hero-subheading">Discover Our Exclusive Collection</p>

    </section>



    <section class="brandshow">
        <div class="brand-marquee">
            <div class="marquee-content">
                <img src="image/brands1.webp" alt="Brand 1" >
                <img src="image/brands2.webp" alt="Brand 2">
                <img src="image/brands3.webp" alt="Brand 3">
                <img src="image/brands4.webp" alt="Brand 4">
                <img src="image/brands5.webp" alt="Brand 5">
                <img src="image/brands6.webp" alt="Brand 6">
                <img src="image/brands7.webp" alt="Brand 7">
                <img src="image/brands8.webp" alt="Brand 8">
                <img src="image/brands9.webp" alt="Brand 9">
                <img src="image/brands10.webp" alt="Brand 10">

               
            </div>
        </div>
    </section>

    <section class="shop-section">
        <div class="category">
            <div class="title">
                <h2> POPULAR CATEGORIES</h2>
                <a href="pages\products.php">VIEW ALL</a>
            </div>

            <div class="boxes">
             <div class="box">
                <a href="pages\products_by_category.php?id=4">
                    <div class="">
                        <img src="image\whiskey.jpg" alt="whiskey">
                        <h4>whiskey</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_category.php?id=1">
                    <div class="">
                        <img src="image\Brandy.jpg" alt="Brandy">
                        <h4>Brandy</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_category.php?id=3">
                    <div class="">
                        <img src="image\vodka.jpg" alt="Vodka">
                        <h4>Vodka</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_category.php?id=2">
                    <div class="">
                        <img src="image\gin.jpeg" alt="Gin">
                        <h4>Gin</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_category.php?id=10">
                    <div class="">
                        <img src="image\beer.jpg" alt="Beer">
                        <h4>Beer</h4>
                    </div>
                </a>
                </div>


            </div>
        </div>
        <div class="video_part">
            <video autoplay loop muted>
                <source src="image\chill video.mp4" type="video/mp4">
            </video>
            <p>"Life is full of moments to celebrate, to savor, and to share. Raise your glass to friendship, laughter, and unforgettable memories. Drink responsibly and let every sip remind you of the good times and the joy of living in the moment."</p>
        </div>
        <div class="brand">
            <div class="title">
                <h2>POPULAR BRANDS</h2>
                <a href="pages\products.php">VIEW ALL</a>
            </div>

            <div class="boxes">

            <div class="box">
                <a href="pages\products_by_brand.php?id=3">
                    <div class="">
                        <img src="image\jack daniels.jpg" alt="Jack Daniels">
                        <h4>Jack Daniels</h4>
                    </div>
                </a>
            </div>

                <div class="box">
                <a href="pages\products_by_brand.php?id=15">
                    <div class="">
                        <img src="image\Glenfiddich.jpg" alt="Glenfiddich">
                        <h4>Glenfiddich</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_brand.php?id=4">
                    <div class="">
                        <img src="image\johnnie walker.jpg" alt="Jonnie Walker">
                        <h4>Jonnie Walker</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_brand.php?id=10">
                    <div class="">
                        <img src="image\Beluga.jpg" alt="Beluga">
                        <h4>Beluga</h4>
                    </div>
                </a>
                </div>

                <div class="box">
                <a href="pages\products_by_brand.php?id=1">
                    <div class="">
                        <img src="image\rockland.png" alt="Rockland">
                        <h4>Rockland</h4>
                    </div>
                </a>
                </div>

            </div>
        </div>

        <div class="services">
            <div class="service">
                <div class="left">
                    <img src="image\delivery.png" alt="delivery">
                </div>
                <div class="right">
                    <h4>Fast delivery</h4>
                    <p>Delivery within 3 to 5 days</p>
                </div>
            </div>
            <div class="service">
                <div class="left">
                    <img src="image\wine-bottle.png" alt="bottle">
                </div>
                <div class="right">
                    <h4>Authenticity Guarantee</h4>
                    <p>Shop for items with confidence</p>
                </div>
            </div>
            <div class="service">
                <div class="left">
                    <img src="image\payment.png" alt="payment">
                </div>
                <div class="right">
                    <h4>Secure payments</h4>
                    <p>Secure payment methods</p>
                </div>
            </div>
            <div class="service">
                <div class="left">
                    <img src="image\store.png" alt="store">
                </div>
                <div class="right">
                    <h4>Multiple outlets</h4>
                    <p>We have more stores</p>
                </div>
            </div>
        </div>

        <style>

    * {
        font-family: 'Roboto', sans-serif;
    }

    h2{
        font-size: 30px;
        margin-top: 40px;
    }

    .title{
        margin-left: 5%;
    }

    
    .hero {
    position: relative;
    margin-top: 20px;
    width: 100%;
    height: 500px; 
    overflow: hidden;
    }
    
    
    .hero-heading {
    font-family: 'Roboto', sans-serif;
    font-size: 3em;
    font-weight: 700;
    color: white; 
    margin-top: 150px;
    margin-left: 50px;
    
    /* Animation properties */
    opacity: 0;
    transform: translateX(-50px); /* Start 50px left for sliding effect */
    animation: slideIn 1s ease-out forwards; /* 1s slide-in animation */
    }
    
    /* Keyframes for slide-in animation */
    @keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px); /* Start slightly to the left */
    }
    to {
        opacity: 1;
        transform: translateX(0); /* End at original position */
    }
    }
    
    
    /* Optional: Subheading styling */
    .hero-subheading {
    font-size: 1.5em;
    font-weight: 400;
    margin-top: 10px;
    margin-left: 50px;
    animation: slideIn 1s ease-out forwards;
    transform: translateX(-50px);
    
    }
    
    .slide {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    animation: slideshow 60s infinite; /* 180s = 3 images x 60s each */
    }
    
    
    .slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
    
    
    @keyframes slideshow {
    0% { opacity: 1; }
    33.33% { opacity: 1; }
    36.66% { opacity: 0; }
    100% { opacity: 0; }
    }
    
    .slide:nth-child(1) {
    animation-delay: 0s;
    }
    
    .slide:nth-child(2) {
    animation-delay: 20s;
    }
    
    .slide:nth-child(3) {
    animation-delay: 40s;
    }
    
    
    .animated-image {
    width: 100%;
    height: 80vh;
    object-fit: cover;
    filter: blur(1px);
    -webkit-filter: blur(1px);
    
    animation: fadeIn 3s ease-in-out, slideUp 3s ease-in-out;
    
    
    }
    
    @keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
    }
    
    @keyframes slideUp {
    0% { transform: translateY(20px); }
    100% { transform: translateY(0); }
    }

/* Container for brand row with horizontal scrolling */
.brand-marquee {
  display: flex;
  overflow-x: hidden; /* Hide scrollbar */
  white-space: nowrap; /* Prevents images from wrapping to the next line */
  padding: 20px;
  background-color: #f5f5f5; /* Optional background color */
  gap: 30px; /* Adds spacing between images */
  position: relative;
}

/* Content within the marquee (images) */
.marquee-content {
  width: 100px; /* Adjust size as needed */
  height: auto; /* Keeps aspect ratio */
  transition: transform 0.6s; /* Adds a hover effect */
  display: inline-block;
  flex-shrink: 0; /* Prevents shrinking */
}

/* Hover effect: Enlarge on hover */
.marquee-content:hover {
  transform: scale(1.1); /* Enlarge on hover */
}

/* Continuous scrolling effect */
@keyframes marquee-scroll {
  0% {
    transform: translateX(0); /* Start position */
  }
  100% {
    transform: translateX(-100%); /* Scroll all the way to the left */
  }
}

/* Apply the animation on the .brand-marquee container */
.brand-marquee {
  display: flex;
  animation: marquee-scroll 30s linear infinite; /* Scrolls the images smoothly */
  animation-timing-function: linear; /* Keeps a smooth scroll */
}

/* Optional: Duplicate the images for seamless loop */
.brand-marquee .marquee-content {
  animation: marquee-scroll 30s linear infinite; /* Same animation for the images */
  display: inline-block;
  white-space: nowrap; /* Prevent wrapping */
  flex-shrink: 0;
  animation-timing-function: linear;
}

/* Optional styling for hiding scrollbars in WebKit browsers */
.brand-marquee::-webkit-scrollbar {
  display: none; /* Hides the scrollbar in WebKit browsers */
}

/* Container for the boxes */
.boxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    align-items: center;
    margin: 50px 0;
}

/* Individual box styling */
.box {
    width: 15%; /* Adjusted for larger screens */
    margin: 15px;
    box-sizing: border-box;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding-top: 10px;
    cursor: pointer;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22); 
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: white;
}

/* Hover effect for boxes */
.box:hover {
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2), 0 3px 6px rgba(0, 0, 0, 0.15);
    transform: translateY(-8px);
}

/* Image styling */
.box img {
    width: 200px;
    height: 200px;
    display: block;
    margin: 0 auto;
    border-radius: 10px;
}

/* Text styling for box titles */
.box h4 {
    margin-top: 10px;
    font-size: 1.2em;
    color: #333;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .box {
        width: 30%; /* 3 boxes per row on medium screens */
    }
}

@media (max-width: 768px) {
    .box {
        width: 45%; /* 2 boxes per row on tablets */
    }
}

@media (max-width: 480px) {
    .box {
        width: 100%; /* 1 box per row on small screens */
    }
}

.video_part {
    display: flex;
    align-items: center; /* Aligns content vertically within the row */
    gap: 20px; /* Adds space between the video and text */
    padding: 20px;
    margin: 20px 0;
}

/* Styling for the video */
.video_part video {
    width: 50%; /* Takes up half the width of the container */
    height: 1100px;
    border-radius: 20px;
}

/* Styling for the text */
.video_part p {
    width: 40%; /* Takes up the other half */
    font-size: 2em;
    line-height: 1.8;
    color: #333;
    margin: 10;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .video_part {
        flex-direction: column; /* Stacks video and text vertically */
        text-align: center; /* Centers text */
    }

    .video_part video,
    .video_part p {
        width: 100%; /* Takes up full width on small screens */
    }
}


/* Container for services */
.services {
    display: flex;
    gap: 20px;
    justify-content: space-between;
    align-items: center;
    margin: 40px 0; /* Space above and below */
    padding: 20px;
}

/* Individual service box */
.service {
    display: flex;
    align-items: center;
    flex-direction: column; /* Stack image and text vertically within each box */
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 22%; /* Each box takes about 1/4th of the container’s width */
    text-align: center;
}

.service:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Left section for image */
.service .left img {
    width: 50px; /* Icon size */
    height: 50px;
    margin-bottom: 10px; /* Space between image and text */
}

/* Right section for text */
.service .right h4 {
    font-size: 1.2em;
    margin: 0 0 5px;
    color: #333;
}

.service .right p {
    margin: 0;
    color: #666;
    font-size: 1em;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .services {
        flex-direction: column; /* Stacks items vertically on small screens */
        gap: 15px;
    }

    .service {
        width: 100%; /* Full width for each box on small screens */
    }
}

        </style>

    </section>

    <section class="footer-section">
        <h1>Good Times, Great Memories—Drink Responsibly</h1>
    </section>
</body>

</html>