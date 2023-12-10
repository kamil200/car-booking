<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";
$update = false;
$error = false;
//Creating a connection with the database
$conn = mysqli_connect($servername, $username, $password, $db);
//Die if Connection Failed
if (!$conn) {
    die("Sorry we Failed to Connect" . mysqli_connect_error());
} else {
    if (isset($_POST['update'])) {
        $Cid = $_POST['Cid'];
        $Adress = $_POST['address'];
        $Contact = $_POST['phone'];
        $Updated_car = $_POST['car'];
        $sql_check1 = "SELECT car_count FROM `car_info` WHERE `car_name` = '$Updated_car'";
        $result_check1 = mysqli_query($conn, $sql_check1);
        if ($result_check1 && mysqli_num_rows($result_check1) >= 1) {
            $row = mysqli_fetch_assoc($result_check1);
            if ($row['car_count'] >= 1) {
                $sql_check = "SELECT * FROM `booking_info` WHERE `Cid` = '$Cid'";
                $result_check = mysqli_query($conn, $sql_check);
                if (mysqli_num_rows($result_check) > 0) {
                    $sql1 = "UPDATE `booking_info` SET `Address` = '$Adress' WHERE `booking_info`.`Cid` = '$Cid'";
                    $sql2 = "UPDATE `booking_info` SET `Contact` = '$Contact' WHERE `booking_info`.`Cid` = '$Cid'";
                    $sql3 = "UPDATE `booking_info` SET `car_name` = '$Updated_car' WHERE `booking_info`.`Cid` = '$Cid'";
                    $res1 = mysqli_query($conn, $sql1);
                    $res1 = mysqli_query($conn, $sql2);
                    $res1 = mysqli_query($conn, $sql3);
                    if ($res1) {
                        $update = true;
                    }
                }else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        }
    }
}
?>

<?php
include 'nav.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main-section">
        <?php
        if ($update) {
            echo "<div class='alert alert-secondary alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Record has been Updated Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            $updateCarQuery = "UPDATE `car_info` SET `car_count` = `car_count` - 1 WHERE `car_name` = '$Updated_car'";
            $updateCarResult = mysqli_query($conn, $updateCarQuery);
        }
        if ($error) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> No matching record found or invalid customer ID
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        ?>
        <form action="#" method="POST">
            <div class="container">
                <div class="mb-3">
                    <label for="Cid" class="form-label">Customer ID:</label>
                    <input type="number" id="Cid" name="Cid" min="0" class="form-control"
                        placeholder="Enter Customer ID" required />
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="number" name="phone" id="phone" pattern="[0-9]{10}" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="car">Select a Car:</label>
                    <select class="form-select" name="car" id="car" required>
                        <option value="">Select a car...</option>
                        <option value="SEDAN">SEDAN</option>
                        <option value="SUV">SUV</option>
                        <option value="THAR">THAR</option>
                        <option value="XUV">XUV</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary my-3">Update</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>