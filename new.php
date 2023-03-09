<?php session_start(); ?>

<?php
@include './config.php';


$per_page_record = 3;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
$query = "SELECT * FROM details LIMIT $start_from, $per_page_record ";
$rs_result = mysqli_query($conn, $query);
?>

<section class="custom-h">
    <div class="container-fluid mt-3 mb-5">
        <div class="row">
            <div class="d-flex flex-column flex-lg-row justify-content-between my-3 px-lg-5">
                <h5 class="fw-bold">USERS LIST</h5>
                <div class="form-group">
                    <input id="myInput" class="p-2" type="text" name="search_query" placeholder="Search....!">
                </div>
            </div>
        </div>
        <div class="table table-responsive ">
            <table class="table table-white border table-striped table-hover table-bordered" id="dataTable">
                <thead class="bg-images text-center">
                    <tr class="text-dark">
                        <th class="ps-5 " scope="col">id</th>
                        <th scope="col" class="">name</th>
                        <th scope="col" class="">email</th>
                        <th class="pe-5 " scope="col">phone</th>
                        <th class="pe-5 " scope="col">place</th>
                        <th class="pe-5 " scope="col">actions</th>
                    </tr>
                </thead>
                <tbody id="myTable" class="text-center">
                    <?php
                    while ($row = mysqli_fetch_array($rs_result)) {
                    ?>
                        <tr>
                            <td class="ps-5"><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["phone"]; ?></td>
                            <td><?php echo $row["place"]; ?></td>
                            <td class=""><a href="" class="view" id="view" data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#viewModal"><span class="text-success fs-4"><i class='bx bx-show'></i></span></a>
                                <a href="" class="edit" data-id="<?php echo $row['id'] ?>" id="edit" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="updateUser()"><span class="text-dark fs-4"><i class='bx bx-edit'></i></span></a>
                                <a href="" class="delete" data-id="<?= $row['id'] ?>" id="delete"><span class="text-danger fs-4"><i class='bx bx-trash-alt'></i></span></a>
                            </td>
                        </tr>
                    <?php   
                    };
                    ?>

                </tbody>
            </table>
            <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="user_form">

                        </div>
                    </div>
                </div>
            </div>

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


        </div>
    </div>

    </div>
</section>