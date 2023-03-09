<?php
@include './config.php';

// if(isset($_POST['viewid'])){
//     $user_view_id = $_POST['viewid'];

//     $sql = "SELECT * FROM `details` WHERE id=$user_view_id";

//     $result = mysqli_query($conn,$sql);
//     $response = array();
//     while($row = mysqli_fetch_assoc($result)){
//         $response = $row;
//     }
//     echo json_encode($response);

// }else{
//     $response['status' ]= 400;
//     $response['message']='invalid data';
// }
// *****
if ($_POST['action'] == 'view_candidate') {
    $id = (isset($_POST['candidate_Id']) && (!empty($_POST['candidate_Id'])))? $_POST['candidate_Id']: "";

    $sql = "SELECT * FROM `details` WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $candidate = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if ($candidate) {
        echo json_encode([
            'code' => 200,
            'response' => $candidate,
            'message' => 'Success'
        ]);
    }
}


if ($_POST['action'] == 'search_candidate') {
    $searchInp = $_POST['search_inp'];
    // print_r($searchInp);
    // return;
    $sql = "SELECT * FROM `details` WHERE name LIKE '%$searchInp%'";
    $query = mysqli_query($conn, $sql);
    $candidate = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if ($candidate) {
        echo json_encode([
            'code' => 200,
            'response' => $candidate,
            'message' => 'Success'
        ]);
    }
}
?>
