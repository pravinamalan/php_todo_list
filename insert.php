<?php
@include './config.php';
$name = $email = $phone =$place ='';
$nameErr = $emailErr = $genderErr = $placeErr ='';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['completename'])){
        $nameErr = 'name is required';
    }elseif(!preg_match("/^[a-zA-z]*$/", $_POST['completename'])){
        $nameErr ="only alphabets and whitespace are allowed";
    }else{
        $nameErr = "";
    }
    if(empty($_POST['email'])){
        $emailErr = 'email field is required';
    }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $emailErr = "invlid email format";
    }else{
        $emailErr ="";
    }
}
// insert a data
// $name = $_POST['completename'];
$name = isset($_POST['completename']) ? $_POST['completename'] : "";
$email = $_POST['email'];
$phone = $_POST['phone'];
$place = $_POST['place'];

if ($name != '' && $email != '' && $phone != '' && $place != '') {
    $sql = "INSERT INTO details (name, email, phone,place) VALUES ('$name', '$email', '$phone', '$place')";

    $run_data = mysqli_query($conn, $sql);
    if ($run_data) {
        exit(json_encode([
            'status' => 'success',
            'code' => 200,
            'message' => 'data inserted successfully',
            'data' => $run_data,
        ]));
    }else {
        echo "Data insert fails";
    }

    $conn -> close();
}else{
    echo json_encode([
        'status' => 'error',
        'code' => 500,
        'message' => 'Please Fill the all required field',
    ]);
}
