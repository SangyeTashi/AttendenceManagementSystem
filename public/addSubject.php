<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Manage subjects</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<?php include './adminNav.php' ?>

<body style="margin-top:7rem">
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] === '1') {
        echo '<p align="center" style="margin:0"  class="form-description text-success">Subject added successfully! Add more..</p>';
    }
    if (isset($_GET['msg']) && $_GET['msg'] === '3') {
        echo '<p align="center"  style="margin:0" class="form-description text-danger">Subject Id already exists in the database. Please try a different Subject Id</p>';
    }
    ?>
    <div class="addForm" style="display:none; max-width: 500px;margin: 0 auto;">
        <h2 class="form-title">Enter Subject details</h2>

        <form style="margin-top:2rem" class="form" action="./doAddSubject.php" method="POST">
            <div>
                <label class="form-label" for="subjectId">Subject Id</label>
                <input class="form-control" type="number" name="subjectId" id="subjectId" required>
            </div>
            <div>
                <label class="form-label" for="subjectName">Subject Name </label>
                <input class="form-control" type="text" name="subjectName" id="subjectName" required>
            </div>
            <div>
                <label class="form-label" for="teacherId">Teacher Id</label>
                <input class="form-control" type="number" name="teacherId" id="teacherId" required>
            </div>
            <div>
                <label class="form-label" for="department">Department</label>
                <select class="form-select" required name="department">
                    <?php
                    include 'db_connect.php';
                    $sql = 'select id from departments';
                    $res = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        ?>

                        <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <label class="form-label" for="semester">Semester:</label>
                <input class="form-control" type="number" name="semester" id="semester" required>

            </div>

            <div>
                <input class="form-control btn btn-danger mt-3" type="button" value="Cancel" onclick="hideAddForm()">
                <input class="form-control btn btn-primary mt-3" type="submit" value="Add Subject">

            </div>
        </form>

    </div>

    <?php
    include 'db_connect.php';
    $query = "SELECT * FROM subjects";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if there are any rows in the result
    if (mysqli_num_rows($result) > 0) {
        // Output HTML table start
        echo "<div style='display:flex;flex-direction:column;padding:2rem;align-items:center;'>
        <button  class='mb-3 btn btn-primary' onclick='handleAddClick()'>+ Add </button>
        <table style='max-width:900px;' class='table ' border='1'  id='sortable-table'>
            <tr>
                <th onclick='sortTable(0)' style='cursor:pointer'>ID</th>
                <th onclick='sortTable(1)' style='cursor:pointer'>Name</th>
                <th onclick='sortTable(2)' style='cursor:pointer'>Department</th>
                <th onclick='sortTable(3)' style='cursor:pointer'>Semester</th>
                <th onclick='sortTable(3)' style='cursor:pointer'>Lecturer ID</th>
                <th>Edit</th>
            </tr>";

        // Loop through each row of the result and fetch data
        while ($row = mysqli_fetch_assoc($result)) {
            // Output each row as a table row
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['department'] . "</td>
                <td>" . $row['semester'] . "</td>
                <td>" . $row['staff_id'] . "</td>
                <td>
                    <a href='./editSubject.php?id=" . $row['id'] . "'><button class='btn btn-secondary'>Edit</button></a>
                    <a href='./delete.php?id=" . $row['id'] . "&table=subjects&redirect=" . $_SERVER['PHP_SELF'] . "'>
                    <button class='btn btn-danger'>Delete</button>
                </a>
                </td>
              </tr>";
        }

        // Output HTML table end
        echo "</table>
        </div>";
    } else {
        // If there are no subjects in the database
        echo "No subjects found in the database.";
    }

    // Don't forget to close the MySQL connection when done
    mysqli_close($connection);
    ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

    <script>

        function handleAddClick() {
            let addForm = document.getElementsByClassName('addForm');
            addForm[0].style.display = 'block';
        }
        function hideAddForm() {
            document.getElementsByClassName('addForm')[0].style.display = 'none';
        } function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch; table = document.getElementById("sortable-table");
            switching = true;

            // Set the sorting direction to ascending
            var sortDirection = "asc";

            while (switching) {
                switching = false;
                rows = table.getElementsByTagName("tr");

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;

                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (sortDirection === "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (sortDirection === "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }

            // Reverse the sorting direction
            if (sortDirection === "asc") {
                sortDirection = "desc";
            } else {
                sortDirection = "asc";
            }
        }
    </script>

</body>

</html>