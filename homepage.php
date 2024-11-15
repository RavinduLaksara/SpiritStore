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
    <link rel="stylesheet" href="<?php echo 'styles/style.css'; ?>">

</head>

<body>

    <section class="hero">

        <div class="slide">
            <img src="image/pexels-wendywei-1554654.jpg" alt="liquor bottle 3" class="animated-image">

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
                <img src="image/brands1.webp" alt="Brand 1">
                <img src="image/brands2.webp" alt="Brand 2">
                <img src="image/brands3.webp" alt="Brand 3">
                <img src="image/brands4.webp" alt="Brand 4">
                <img src="image/brands5.webp" alt="Brand 5">
                <img src="image/brands6.webp" alt="Brand 6">
                <img src="image/brands7.webp" alt="Brand 7">
                <img src="image/brands8.webp" alt="Brand 8">
                <img src="image/brands9.webp" alt="Brand 9">
                <img src="image/brands10.webp" alt="Brand 10">

                <img src="image/brands1.webp" alt="Brand 1">
                <img src="image/brands2.webp" alt="Brand 2">
                <img src="image/brands3.webp" alt="Brand 3">
                <img src="image/brands4.webp" alt="Brand 4">
                <img src="image/brands5.webp" alt="Brand 5">
                <img src="image/brands6.webp" alt="Brand 6">
                <img src="image/brands7.webp" alt="Brand 7">
                <img src="image/brands8.webp" alt="Brand 8">
                <img src="image/brands9.webp" alt="Brand 9">
                <img src="image/brands10.webp" alt="Brand 10">

                <img src="image/brands1.webp" alt="Brand 1">
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
            <h2> POPULAR CATEGORIES</h2>
            <div class="title">
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
        <div class="video">
            <div class="video_part">
                <video autoplay loop muted>
                    <source src="image\chill video.mp4" type="video/mp4">
                </video>
                <p>"Life is full of moments to celebrate, to savor, and to share. Raise your glass to friendship, laughter, and unforgettable memories. Drink responsibly and let every sip remind you of the good times and the joy of living in the moment."</p>
            </div>
        </div>



        <div class="brand">
            <h2>POPULAR BRANDS</h2>
            <div class="title">
                <a href="pages\products.php">VIEW ALL</a>
            </div>
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


    </section>

    <section class="footer-section">
        <div class="text-wrapper">
            <h1>Good Times, Great Memories—Drink Responsibly</h1>
        </div>
    </section>

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h2 {
            font-size: 30px;
            margin-top: 40px;
            margin-left: 5%;
            margin-bottom: 0;
        }

        .title {
            text-align: end;
            margin-right: 5%;
            margin-bottom: 1px;
            text-decoration: none;

        }

        .title a {
            text-decoration: none;
            color: black;
            cursor: pointer;
        }

        .title a:hover {
            text-decoration: underline;
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
            transform: translateX(-50px);
            /* Start 50px left for sliding effect */
            animation: slideIn 1s ease-out forwards;
            /* 1s slide-in animation */
        }

        /* Keyframes for slide-in animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-50px);
                /* Start slightly to the left */
            }

            to {
                opacity: 1;
                transform: translateX(0);
                /* End at original position */
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
            color: white;

        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            animation: slideshow 60s infinite;
            /* 180s = 3 images x 60s each */
        }


        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        @keyframes slideshow {
            0% {
                opacity: 1;
            }

            33.33% {
                opacity: 1;
            }

            36.66% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
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
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            0% {
                transform: translateY(20px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* Brand marquee styling */
        .brand-marquee {
            display: flex;
            overflow: hidden;
            /* Hides the scrollbar */
            white-space: nowrap;
            background-color: white;
            /* Optional: background color for the marquee */
            padding: 10px 0;
            position: relative;
        }

        /* Container for marquee content */
        .marquee-content {
            display: inline-flex;
            align-items: center;
            animation: scroll 30s linear infinite;
            /* Continuous scrolling */
        }

        /* Logo styling */
        .marquee-content img {
            width: 100px;
            /* Adjust size of the brand logos */
            height: 100px;
            margin-right: 30px;
            /* Space between logos */
            opacity: 0.8;
            /* Optional: make logos slightly transparent */
            transition: opacity 0.3s;
        }

        .marquee-content img:hover {
            opacity: 1;
            /* Full opacity on hover */
        }

        /* Continuous scrolling effect */
        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Duplicate the content for a seamless scroll */
        .brand-marquee .marquee-content::after {
            content: attr(data-content);
            /* Duplicate content attribute for seamless scroll */
            display: inline-flex;
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
            width: 15%;
            /* Adjusted for larger screens */
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
            text-decoration: none;
        }

        .box a {
            text-decoration: none;
            /* No underline for links in boxes */
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .box {
                width: 30%;
                /* 3 boxes per row on medium screens */
            }
        }

        @media (max-width: 768px) {
            .box {
                width: 45%;
                /* 2 boxes per row on tablets */
            }
        }

        @media (max-width: 480px) {
            .box {
                width: 100%;
                /* 1 box per row on small screens */
            }
        }

        .video {
            background: black;
        }

        .video_part {
            display: flex;
            align-items: center;
            /* Aligns content vertically within the row */
            gap: 20px;
            /* Adds space between the video and text */
        }

        /* Styling for the video */
        .video_part video {
            width: 500px;
            /* Ensures square dimensions */
            height: 650px;
            border-radius: 10px;
            object-fit: cover;
            /* Ensures the video fills the square without distortion */
            margin-left: 50px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* Styling for the text */
        .video_part p {

            width: 40%;
            /* Takes up the other half */
            font-size: 2em;
            line-height: 1.8;
            color: #333;
            margin: 10px;
            /* Fixed typo: added "px" for margin */
            text-align: justify;
            margin-left: 11%;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .video_part {
                flex-direction: column;
                /* Stacks video and text vertically */
                text-align: center;
                /* Centers text */
            }

            .video_part video,
            .video_part p {
                width: 100%;
                /* Takes up full width on small screens */
                height: auto;
                /* Keeps aspect ratio on smaller screens */
            }
        }



        /* Container for services */
        .services {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0;
            /* Space above and below */
            padding: 20px;
        }

        /* Individual service box */
        .service {
            display: flex;
            align-items: center;
            flex-direction: column;
            /* Stack image and text vertically within each box */
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 22%;
            /* Each box takes about 1/4th of the container’s width */
            text-align: center;
        }

        .service:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Left section for image */
        .service .left img {
            width: 50px;
            /* Icon size */
            height: 50px;
            margin-bottom: 10px;
            /* Space between image and text */
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
                flex-direction: column;
                /* Stacks items vertically on small screens */
                gap: 15px;
            }

            .service {
                width: 100%;
                /* Full width for each box on small screens */
            }
        }

        .footer-section {
            background-image: url('image/footer1.jpg');
            /* Replace with the path to your background image */
            background-size: cover;
            /* Ensures the image covers the entire section */
            background-position: center;
            /* Centers the background image */
            background-repeat: no-repeat;
            /* Prevents the image from repeating */
            display: flex;
            /* Enables flexbox for centering */
            justify-content: center;
            /* Centers content horizontally */
            align-items: center;
            /* Centers content vertically */
            height: 300px;
            /* Set height as needed */
            padding: 20px;
        }

        /* Wrapper for the text with a transparent, blurred background */
        .text-wrapper {
            background-color: transparent;
            /* Semi-transparent black */
            padding: 20px 40px;
            /* Padding inside the box */
            border-radius: 10px;
            /* Rounded corners */
            backdrop-filter: blur(10px);
            /* Adds blur effect */
            -webkit-backdrop-filter: blur(10px);
            /* Safari support */
            color: white;
            /* Text color to contrast with the background */
            text-align: center;
            /* Centers the text */
        }

        /* Styling for the footer heading */
        .footer-section h1 {
            font-size: 2em;
            /* Adjust font size */
            font-weight: bold;
            margin: 0;
        }
    </style>
</body>

</html>