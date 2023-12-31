<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-image: url('https://wallpapercave.com/wp/wp4465115.jpg');
        font-family: 'PT Sans', sans-serif;
    }

    .active {
        font-weight: 500;
        border-bottom: 2px solid #aaaa;
    }

    @media (max-width:992px) {
        .navbar {
            margin: 0 !important;
            border-radius: 0 !important;
        }
    }


    .navbar {
        border-radius: 2rem;
        background-color: rgba(255, 255, 255, 0.20);
        backdrop-filter: blur(1rem);
        /* border-bottom: 2px solid rgba(255, 255, 255, 0.80); */
        box-shadow: 2rem 0rem 3rem rgba(0, 0, 0, 0.20);
    }
</style>
<nav class="navbar navbar-expand-lg fixed-top mt-3 mx-4">
    <div class="container-fluid px-5 py-2">
        <a class="navbar-brand " href="/index.php">
            <img src="/img/dlihe_logo.png" style="filter: hue-rotate(-30deg) brightness(0.1);margin-left: .8rem;"
                width="40" height="40" alt="">
        </a>

        <div>
            <a class="link-dark link-underline-opacity-0" href="/login.php">
                <button type='button' class=" btn btn-light">
                    Student Login
                </button>
            </a>
            <a class="link-dark link-underline-opacity-0" href="/staffLogin.php">
                <button type='button' class=" btn btn-light">
                    Login Staff
                </button>
            </a>
            <a class="link-dark link-underline-opacity-0" href="/adminLogin.php">
                <button type='button' class=" btn btn-light">
                    Login Admin
                </button>
            </a>
        </div>
    </div>
</nav>