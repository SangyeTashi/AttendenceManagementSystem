<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName']) && !isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Manage Announcements</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<?php include './adminNav.php' ?>

<body style="margin-top:7rem">
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] === '1') {
        echo '<p align="center" style="margin:0"  class="form-description text-success">Announcement added successfully! Add more..</p>';
    }
    if (isset($_GET['msg']) && $_GET['msg'] === '3') {
        echo '<p align="center"  style="margin:0" class="form-description text-danger">Announcement Id already exists in the database. Please try a different Announcement Id</p>';
    }
    ?>
    <div class="addForm" style="display:none; max-width: 800px;margin: 0 auto;">
        <h2 class="form-title">Enter Announcement details</h2>
        <form style="margin-top : 3rem" class="form" action="./doAddAnnouncement.php" method="POST">
            <div>
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" id="username" required>
            </div>
            <div>
                <label class="form-label" for="content">Announcement</label>
                <textarea style="height: 16rem;" class="form-control" type="text" name="content" required></textarea>
            </div>
            <div>
                <label class="form-label" for="content">To</label>
                <select class="form-control" type="text" name="to" required>
                    <option value="everyone">Everyone</option>
                    <option value="staff">staff</option>
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


            <div style="display:flex">
                <input class="form-control btn btn-danger mt-3" onclick="hideAddForm()" value="Cancel">
                <input class="form-control btn btn-primary mt-3" type="submit" value="Add Announcement">
            </div>
        </form>

    </div>

    <?php
    include 'db_connect.php';
    $query = "select * from announcements";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if there are any rows in the result
    if (mysqli_num_rows($result) > 0) {
        // Output HTML table start
        echo "<div style='display:flex;flex-direction:column;padding:2rem;align-items:center;'>
        <button  class='mb-3 btn btn-primary' onclick='handleAddClick()'>+ Add </button>
        <table style='max-width:900px;' class='table ' border='1'  id='sortable-table'>
            <tr>
                <th onclick='sortTable(0)' style='cursor:pointer'>Date</th>
                <th onclick='sortTable(1)' style='cursor:pointer'>Title</th>
                <th onclick='sortTable(2)' style='cursor:pointer'>To</th>
                <th onclick='sortTable(3)' style='cursor:pointer'>Edit</th>
            </tr>";

        // Loop through each row of the result and fetch data
        while ($row = mysqli_fetch_assoc($result)) {
            // Output each row as a table row
            echo "<tr>
                <td>" . $row['date'] . "</td>
                <td>" . $row['title'] . "</td>
                <td>" . $row['written_to'] . "</td>
                <td>
                    <a href='./editAnnouncement.php?id=%22" . $row['id'] . "%22'><button class='btn btn-secondary'>Edit</button></a>
                    <a href='./delete.php?id=%22" . $row['id'] . "%22&table=announcements&redirect=" . $_SERVER['PHP_SELF'] . "'>
                    <button class='btn btn-danger'>Delete</button>
                </a>
                </td>
              </tr>";
        }

        // Output HTML table end
        echo "</table>
        </div>";
    } else {
        // If there are no announcements in the database
        echo "No announcements found in the database.";
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