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
    <link rel="stylesheet" href="styles\customer.css">
    <link rel="stylesheet" href="styles/home.css">



</head>

<body>

<section class="hero">
    
    <video autoplay muted loop class="hero-video">
        <source src="image\homevideo4.mp4" type="video/mp4">
    </video>

   
    <h1 class="hero-heading">Welcome to Spirit Store</h1>
    <p class="hero-subheading">Discover Our Exclusive Collection</p>

</section>

<br>
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

    <br>

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
                <p>" Life is full of moments to celebrate, to savor, and to share. Raise your glass to friendship, laughter, and unforgettable memories. Drink responsibly and let every sip remind you of the good times and the joy of living in the moment. "</p>
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

</body>

</html>