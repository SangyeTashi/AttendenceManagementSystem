<?php session_destroy(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="d-flex flex-column align-items-center ">
    <img style="filter:brightness(0.1);margin-top: 4rem; margin-bottom: 4rem;" width="100px" height="100px"
        src="/img/dlihe_logo.png" alt="">

    <div style="max-width: 500px;margin: 0 auto;" class="d-flex flex-column align-items-center">
        <h2 class='form-title'>Login</h2>
        <form style="margin-top:2rem" class="form" action="./doStudentLogin.php" method="POST">
            <div>
                <label class="form-label" for="studentId">Username</label>
                <input class="form-control" type="number" name="username" id="studentId" required>
            </div>
            <div>
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <div class="d-flex align-items-center mt-3">
                <label class="form-label" style="width: 50%;" for="loginType">Login as:</label>
                <select class="form-select" name="loginType" id="loginType">
                    <option value="students">
                        Student
                    </option>
                    <option value="staffs">Staff</option>
                    <option value="admins">Admin</option>
                </select>
            </div>


            <input class="form-control btn btn-primary mt-3" type="submit" value="Login">
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>