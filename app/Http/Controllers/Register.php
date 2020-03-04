<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

if(isset($_POST["Token"])){

    $token = $_POST["Token"];

    $conn = mysqli_connect("localhost", "root", "", "fcm");

    $query = "INSERT INTO users(Token) Values ('$token') ON DUPLICATE KEY UPDATE Token = '$token' ; ";

    mysqli_query($conn, $query);

    mysqli_close($conn);
}