<?php
@include './config.php';
@include './pagination.php';
if (isset($_POST['displaySend'])) {
  $table = '<table class="table table-hover table-bordered" id="myTable">
        <thead>
          <tr class="text-center">
          <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">mobile</th>
            <th scope="col">place</th>
            <th scope="col">operations</th>
          </tr>
        </thead>';
  $sql = "SELECT * FROM `details`";
  $rs_result = mysqli_query($conn, $sql);
  $id = 1;

  while ($row = mysqli_fetch_assoc($rs_result)) {
    $table .= '<tbody id="body">
    <tr class="text-center">
            <td>' . $id . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] .  '</td>
            <td>' . $row['phone'] . '</td>
            <td>' . $row['place'] . '</td>
            <td>
  <button class="btn btn-info" onclick="viewUser(' . $row['id'] . ')">view</button>
  <button class="btn btn-dark" onclick="updateUser(' . $row['id'] . ')">update</button>
  <button class="btn btn-danger" id="dlt-btn " onclick="deleteUser(' . $row['id'] . ')">delete</button>
</td>
          </tr>
          </tbody>';
    $id++;
  }
  $table .= '</table>';

  echo $table;
}
