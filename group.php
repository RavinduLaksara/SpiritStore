<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 14 Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .header {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            /* To handle responsiveness */
        }

        .member-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 18%;
            /* Adjust the width as needed */
            text-align: center;
        }

        .member-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .member-info h2 {
            margin: 10px 0;
            font-size: 1.2em;
            color: #000;
        }

        .member-info p {
            margin: 5px 0;
            font-size: 1em;
        }

        .member-info a {
            text-decoration: none;
            color: #0073aa;
            font-weight: bold;
            transition: color 0.3s;
        }

        .member-info a:hover {
            color: #005480;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Group 14 - Team Members</h1>
        <p>Undergraduate Software Engineering Students, 2nd Year, University of Kelaniya</p>
    </div>

    <div class="container">
        <!-- Member 1 -->
        <div class="member-card">
            <img src="image/ravindu.jpg" alt="I.G.R. Laksara">
            <div class="member-info">
                <h2>I.G.R. Laksara</h2>
                <p>Backend Developer</p>
                <a href="https://www.linkedin.com/in/ravindu-laksara-6bb355307" target="_blank">LinkedIn Profile</a>
            </div>
        </div>

        <!-- Member 2 -->
        <div class="member-card">
            <img src="image/sanduni.jpg" alt="Sanduni Ayeshika">
            <div class="member-info">
                <h2>Sanduni Ayeshika</h2>
                <p>Frontend Developer</p>
                <a href="https://www.linkedin.com/in/sanduni-ayeshika-339528290" target="_blank">LinkedIn Profile</a>
            </div>
        </div>

        <!-- Member 3 -->
        <div class="member-card">
            <img src="image/prageet.jpg" alt="Prageeth Ekanayake">
            <div class="member-info">
                <h2>Prageeth Ekanayake</h2>
                <p>Frontend Developer</p>
                <a href="https://www.linkedin.com/in/prageeth-ekanayake-864a37308" target="_blank">LinkedIn Profile</a>
            </div>
        </div>

        <!-- Member 4 -->
        <div class="member-card">
            <img src="image/jashvanth.jpg" alt="Jashvanth">
            <div class="member-info">
                <h2>Balakirushnan Jashvanth</h2>
                <p>Backend Developer</p>
                <a href="https://www.linkedin.com/in/balakirushnan-jashvanth-736a72280" target="_blank">LinkedIn Profile</a>
            </div>
        </div>

        <!-- Member 5 -->
        <div class="member-card">
            <img src="image/chamindu.jpg" alt="Chamindu Dilshan">
            <div class="member-info">
                <h2>Chamindu Dilshan</h2>
                <p>Frontend Developer</p>
                <a href="https://www.linkedin.com/in/chamindu-dilshan-4a4962299/" target="_blank">LinkedIn Profile</a>
            </div>
        </div>
    </div>
</body>

</html>