<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Add Staff</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="d-flex flex-column align-items-center ">
    <img style="filter:brightness(0.1);margin-top: 4rem; margin-bottom: 2rem;" width="100px" height="100px"
        src="/img/dlihe_logo.png" alt="">

    <div style="max-width: 500px;margin: 0 auto;" class="d-flex flex-column align-items-center">
        <h2 class='form-title'>Admin Login</h2>
        <form style="margin-top:2rem" class="form" action="./doAdminLogin.php" method="POST">
            <div>
                <label class="form-label" for="AdminId">Admin Id</label>
                <input class="form-control" type="text" name="username" id="AdminId" required>
            </div>
            <div>
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>

            <input class="form-control btn btn-primary mt-3" type="submit" value="Login">
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>