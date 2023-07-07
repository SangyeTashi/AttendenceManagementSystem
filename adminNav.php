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

    .active {
        font-weight: 500;
        border-bottom: 2px solid #aaaa;
    }

    .nav-link {
        margin: 2px .7rem;
        border-bottom: solid 2px transparent;
    }

    .nav-link:hover {
        border-bottom: solid 2px #000;
    }

    @media (max-width:992px) {
        .nav-link:hover {
            border-bottom: transparent solid 2px;
        }

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

    .form-title {
        margin-top: calc(82px + 4rem);
    }


    /* form */

    .form div {
        margin-bottom: 1rem;
    }

    .form {
        border: 1px #ffff solid;
        border-radius: 1rem;
        padding: 2rem;
        background-color: rgba(255, 255, 255, 0.30);
        box-shadow: .5rem .5rem 2rem #a1a1a1;
    }
</style>
<nav class="navbar navbar-expand-lg fixed-top mt-3 mx-4">
    <div class="container-fluid px-5 py-2">
        <a class="navbar-brand " href="/index.php">
            <img src="/img/dlihe_logo.png" style="filter: hue-rotate(-30deg) brightness(0.1);margin-left: .8rem;"
                width="40" height="40" alt="">
        </a>
        <button class="navbar-toggler" type="button" style="border:none;" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'index.php')
                        echo ' active' ?>" href="/index.php">Home
                        </a>
                    </li>
                    <a class="nav-link <?php if ($currentPage === 'addSubject.php')
                        echo ' active' ?>" href="/addSubject.php">Add Subject
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'addStudent.php')
                        echo ' active' ?>" href="/student/addStudent.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'recordAttendence.php')
                        echo ' active' ?>" href="/recordAttendence.php">Record Attendence</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>