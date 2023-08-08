<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Attendence Management System
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* Custom styles go here */
        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-image: url('/img/dli_sport.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: brightness(.4);
        }

        .jumbotron::before {
            content: '';
            position: absolute;
            top: 82px;
            bottom: 0;
            left: 0;
            width: 100%;

            background: linear-gradient(to bottom, transparent 20%, rgba(0, 0, 0, 0.6) 50%);

            z-index: -1;
            /* Adjust the opacity value (0.5) to make it darker/lighter */
        }

        .jumbotron h1 {
            color: white;
            font-size: 48px;
            font-weight: bold;
        }

        .jumbotron p {
            color: white;
            font-size: 20px;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
        }

        .btn-get-started {
            font-size: 18px;
            font-weight: bold;
            padding: 12px 30px;
            margin-top: 30px;
            border-radius: 30px;
        }

        .text-center {
            margin-top: 3rem;
            max-width: 900px;
            padding: 3rem;
        }
    </style>
</head>

<body style="">
    <?php include_once 'indexNav.php' ?>
    <div class="jumbotron">
        <div class="text-center">
            <h1>DLIHE Attendence Management System</h1>
            <p>providing comprehensive attendance management system for students and faculty.</p>
            <a href="#" class="btn btn-primary btn-get-started">Get Started</a>
        </div>
    </div>
    <?php include_once './footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>