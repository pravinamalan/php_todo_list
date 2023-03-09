<?php
@include './config.php';
$per_page_record = 2;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    echo $page;
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
// echo $start_from;
$query = "SELECT * FROM details LIMIT $start_from, $per_page_record ";
echo $query;
$rs_result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="pagination d-flex justify-content-end my-2 mx-3 pb-4">
        <?php
        $query = "SELECT COUNT(*) FROM details";
        $rs_result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";

        $total_pages = ceil($total_records / $per_page_record);
        $pagLink = "";

        if ($page >= 2) {
            echo "<a href='index.php?page=" . ($page - 1) . "'>  Prev </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pagLink .= "<a class = 'active' href='index.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pagLink .= "<a href='index.php?page=" . $i . "'>
                                                    " . $i . " </a>";
            }
        };
        echo $pagLink;

        if ($page < $total_pages) {
            echo "<a href='index.php?page=" . ($page + 1) . "'>  Next </a>";
        }

        ?>

    </div>



    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>