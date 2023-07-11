<?php
$currentPage = basename($_SERVER['PHP_SELF']);

?>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-image: url('https://wallpapercave.com/wp/wp4465115.jpg');
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

    .staff-profile {
        display: flex;
        align-items: center;
        position: relative;
    }

    .icon-more {
        height: 2rem;
        margin-left: 1rem;
        cursor: pointer;
        padding: .5rem;
        border-radius: 50%;
    }

    .icon-more:hover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    .options {
        position: absolute;
        top: 50%;
        opacity: 0;
        padding: .5rem 1rem;
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(1rem);
        transition: all ease-out .1s;
    }

    .options-show {
        top: 150%;
        opacity: 1;
    }
</style>
<nav class="navbar navbar-expand-lg fixed-top mt-3 mx-4">
    <div class="container-fluid px-5 py-2">
        <a class="navbar-brand " href="/staffDashboard.php">
            <img src="/img/dlihe_logo.png" style="filter: hue-rotate(-30deg) brightness(0.1);margin-left: .8rem;"
                width="40" height="40" alt="">
        </a>
        <div class='staff-profile'>
            <?php echo $_SESSION['name']; ?>
            <img src="/img/more-svgrepo-com.svg" class="icon-more icon" />
            <div class="options ">
                <div><a href="/logout.php"> Logout</a></div>
            </div>
        </div>
    </div>

    <script>
        var dropDownButton = document.getElementsByClassName('icon-more')[0];
        var options = document.getElementsByClassName('options')[0];
        dropDownButton.addEventListener('click', () => {
            options.classList.toggle('options-show')
        })
    </script>
</nav>