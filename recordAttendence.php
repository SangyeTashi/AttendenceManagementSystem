<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include '/nav.php' ?>

    <?php
    include 'db_connnect';

    $staffId = $_POST['staffId'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];

    $qry = "select students.* from students join departments on students.department = departments.abbreviation where students.semester = $semester ";
    $res = mysqli_query($connection, $qry);

    while ($r = mysqli_fetch_array($res)) {
        ?>
        <h1>
            <?php echo $r['name']; ?>
        </h1>
        <?php
    }

    ?>
</body>

</html>