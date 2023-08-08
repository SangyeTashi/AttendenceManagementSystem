<?php
include 'db_connect.php';


$id = $_GET['id'];
$writer = $_GET['w'];

$qry = "select * from announcements where id = '$id'";

$res = mysqli_query($connection, $qry);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>

</head>
<style>
    pre {
        white-space: pre-wrap;
        /* css-3 */
        white-space: -moz-pre-wrap;
        /* Mozilla, since 1999 */
        white-space: -pre-wrap;
        /* Opera 4-6 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        word-wrap: break-word;
        /* Internet Explorer 5.5+ */
    }
</style>

<body style="maxwidth: 1200px;padding: 4rem">

    <?php
    while ($r = mysqli_fetch_array($res)) { ?>

        <h3>
            <?php echo $r['title'] ?>
        </h3>
        <div>
            <span style=" margin-right: auto;">
                <?php echo $r['date'] ?>
            </span>
            <span style="margin-left: 5rem;">
                ~
                <?php echo $writer ?>
            </span>
        </div>
        <pre> <?php echo $r['content'] ?></pre>

        <button> <a href="javascript:history.back()"> done</a></button>
        <?php
    }
    ?>

</body>

</html>