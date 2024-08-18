<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbanme = "bookings";
$conn = new mysqli($servername,$username,$password,$dbanme);

if($conn->connect_error){
    die("Connection Failed:" .$conn->connect_error);

}
//Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $service = $_POST["service"];
    $date_booked = $_POST["date-booked"];
    $appointment_date = $_POST["appointment-date"];

    //prepare and execute the database insertion
    $sql = "INSERT INTO `booking`(`name`, `email`, `service`, `date_booked`, `appointment_date`)
     VALUES ('$name','$email','$service','$date_booked','$appointment_date')";

     if($conn->query($sql) == TRUE){
        echo "Booking Successfully";
     }else{
        echo "Error: " .$sql . "<br>" .$conn->error; 
     }
}
$conn->close();
?>