<?php
@include './config.php';

// if(isset($_POST['updateid'])){
//     $user_id = $_POST['updateid'];

//     $sql = "SELECT * FROM `details` WHERE id=$user_id ";

//     $result = mysqli_query($conn,$sql);
//     $response = array();
//     while ($row = mysqli_fetch_assoc($result)){
//         $response = $row;
//     }

//     echo json_encode($response);
// }else{
//     $response['status'] =200;
//     $response['message']='data not found';
// }


// // update query

// if(isset($_POST['hiddendata'])){
//     $uiqueid = $_POST['hiddendata'];

//     $name=$_POST['updatename'];
//     $email=$_POST['updateemail'];
//     $phone=$_POST['updatephone'];
//     $place=$_POST['updateplace'];

//     $sql = "UPDATE `details` SET name='$name',email='$email',phone='$phone',place='$place' WHERE id='$uiqueid'";

//     $result = mysqli_query($conn, $sql);
// }

if($_POST['action'] == 'edit_candidate'){
    $id = (isset($_POST['candidate_Id']) && (!empty($_POST['candidate_Id'])))? $_POST['candidate_Id']: "";
    $sql = "SELECT * FROM `details` WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $candidate = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if($candidate){
        echo json_encode([
            'status' => 'Success',
            'response' => $candidate,
            'code' => 200,
        ]);
    }
}

if($_POST['action'] == 'update_candidate'){
    $id = (isset($_POST['candidate_Id']) && (!empty($_POST['candidate_Id'])))? $_POST['candidate_Id']: "";
    $name = (isset($_POST['name']) && (!empty($_POST['name'])))? $_POST['name']: "";
    $email = (isset($_POST['email']) && (!empty($_POST['email'])))? $_POST['email']: "";
    $phone = (isset($_POST['phone']) && (!empty($_POST['phone'])))? $_POST['phone']: "";
    $place = (isset($_POST['place']) && (!empty($_POST['place'])))? $_POST['place']: "";
    // print_r( $name);
    // return;
    $sql = "UPDATE `details` SET `name` = '$name', `email` = '$email', `phone`= '$phone', `place` = '$place' WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    // $candidate = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if($query){
        exit(json_encode([
            'status' => 'Success',
            'message' => "Updated Successful",
            'code' => 200,
        ]));
    }
}
?>