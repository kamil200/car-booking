<?php 
include 'nav.php';
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";
$insert = false;
//Creating a connection with the database
$conn = mysqli_connect($servername,$username,$password,$db);
//Die if Connection Failed
if(!$conn){
    die("Sorry we Failed to Connect". mysqli_connect_error());
}
else{
    $retreive = "SELECT * FROM `booking_info`";
    $result = mysqli_query($conn,$retreive);
    $sno=0;
    $count = mysqli_num_rows($result);
    if($count>0)
    {
        echo "<table class='table'>
        <tr>
            <th>Sr No.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact No.</th>
            <th>Booking Date</th>
            <th>Car Name</th>
        </tr>";
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
                echo "<tr>
                <td >". $sno ."</td>
                <td>".$row['Name']."</td>
                <td>".$row['Address']."</td>
                <td>".$row['Contact']."</td>
                <td>".$row['Cdate']."</td>
                <td>".$row['car_name']."</td>
              </tr>";
        }
        echo "</table>
            </div>";
    }
    else {
        echo "No records Found";
    }
}
?>