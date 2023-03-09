<?php
@include './config.php';

// if(isset($_POST['deletesend'])){
//     $unique = $_POST['deletesend']; 

//     $sql = "DELETE FROM `details` WHERE id=$unique";

//     $result = mysqli_query($conn,$sql);
// }
// ******
if ($_POST['action'] == 'delete_candidate') {
    $id = (isset($_POST['candidate_Id']) && (!empty($_POST['candidate_Id']))) ? $_POST['candidate_Id']: "";
    
    $sql = "DELETE FROM details WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo json_encode([
            'code' => 200,
            'response' => $query
        ]);
    }
}
?>