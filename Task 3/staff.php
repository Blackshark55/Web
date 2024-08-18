<?php
  session_start();

  // Check if the staff member is logged in
  if (!isset($_SESSION['staff_logged_in']) || $_SESSION['staff_logged_in'] !== true) {
    header('Location: login.php');
    exit;
  }

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbanme = "bookings";
  $conn = new mysqli($servername,$username,$password,$dbanme);
  

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch upcoming appointments
  $upcoming_appointments_query = "SELECT * FROM booking WHERE date_booked >= CURDATE()";
  $upcoming_appointments_result = $conn->query($upcoming_appointments_query);

  // Fetch past appointments
  $past_appointments_query = "SELECT * FROM booking WHERE appointment_date < CURDATE()";
  $past_appointments_result = $conn->query($past_appointments_query);

  // Close the connection
  $conn->close();
?>

<!-- Display the staff page content -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Portal - Appointments</title>
  <link rel="stylesheet" href="staff2.css">
  <style>
    .appointment-list {
      margin-top: 100px; /* Add a margin to the top of the form */
    }
  </style>
</head>

<body>
  <div class="background">
    <div class="staff-portal">
      <h2>Staff Portal - Appointments</h2>
      <br><br> <!-- Add some extra space before the form -->
      <div class="appointment-list">
        <br><br> <!-- Add some extra space before the Upcoming Appointments text -->
        <h3>Upcoming Appointments</h3>
        <table id="upcoming-appointments">
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Email</th>
              <th>Service</th>
              <th>Date Booked</th>
              <th>Appointment Date</th>
            </tr>
          </thead>
          <tbody id="upcoming-appointments-body">
            <?php while ($row = $upcoming_appointments_result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['date_booked']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <h3>Past Appointments</h3>
        <table id="past-appointments">
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Email</th>
              <th>Service</th>
              <th>Date Booked</th>
              <th>Appointment Date</th>
            </tr>
          </thead>
          <tbody id="past-appointments-body">
            <?php while ($row = $past_appointments_result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['date_booked']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>