<?php
session_start();
if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {
    $showDeleteButton = true;
    $showBookForm = false;
} else {
    $showDeleteButton = false;
    $showBookForm = true;
}
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";
$insert = false;
//Creating a connection with the database
$conn = mysqli_connect($servername, $username, $password, $db);
//Die if Connection Failed
if (!$conn) {
    die("Sorry we Failed to Connect" . mysqli_connect_error());
} else {
    if (isset($_POST['submit'])) {

        $Cid = $_POST['Cid'];
        $Name = $_POST['name'];
        $Adress = $_POST['address'];
        $Contact = $_POST['phone'];
        $Cdate = $_POST['bookdate'];
        if (isset($_GET['selectedCar'])) {
            $car = $_GET['selectedCar'];
        }
        $sql = "INSERT INTO `booking_info` (`Cid`, `Name`, `Address`, `Contact`, `Cdate`, `car_name`) VALUES ('$Cid', '$Name', '$Adress', '$Contact', '$Cdate', '$car')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'nav.php'; ?>
    <section class="main-section">
        <?php
        if ($insert) {
            echo "<div class='alert alert-secondary alert-dismissible fade show' role='alert'>
  <strong>Congratulation!</strong> " . $Name . " You have Booked the " . $car . " Successfully
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
            $updateCarQuery = "UPDATE `car_info` SET `car_count` = `car_count` - 1 WHERE `car_name` = '$car'";
            $updateCarResult = mysqli_query($conn, $updateCarQuery);
        }
        ?>
        <?php if ($showBookForm) { ?>
            <div class="form-container">
                <form action="#" method="POST">
                    <div class="container">
                        <div class="mb-3">
                            <label for="Cid" class="form-label">Customer ID:</label>
                            <input type="number" id="Cid" name="Cid" class="form-control" min="0" placeholder="Enter Customer ID"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name Here"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <textarea name="address" id="address" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number:</label>
                            <input type="number" name="phone" id="phone" pattern="[0-9]{10}" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="bookdate" class="form-label">Booking Date:</label>
                            <input type="date" name="bookdate" id="bookdate" class="form-control"
                                min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="car">Selected Car:</label>
                            <select class="form-select" name="car" id="car" disabled>
                                <option value="">Select a car...</option>
                                <option value="SEDAN">SEDAN</option>
                                <option value="SUV">SUV</option>
                                <option value="THAR">THAR</option>
                                <option value="XUV">XUV</option>
                            </select>
                        </div>
                        <script>
                            const urlParams = new URLSearchParams(window.location.search);
                            const selectedCar = urlParams.get('selectedCar');
                            if (selectedCar) {
                                const carDropdown = document.getElementById('car');
                                carDropdown.value = selectedCar;
                                carDropdown.disabled = true;
                            }
                        </script>
                        <button type="submit" name="submit" class="btn btn-primary my-3">Submit</button>
                    </div>
                </form>
                <img src="./imgs/rent.png" alt="Car">
            </div>
        <?php } ?>
        <button class="btn btn-primary mx-4" onclick="redirectToResult()">View Details</button>
        <a href="update.php"><span class="btn btn-primary mx-4">UPDATE</span></a>
        <?php if ($showDeleteButton) { ?>
            <a href="delete.php"><span class="btn btn-primary mx-4">DELETE</span></a>
            <a href="stock.php"><span class="btn btn-primary mx-4">ADD STOCK</span></a>

        <?php } ?>
    </section>
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script>
        function redirectToResult() {
            window.location.href = "result.php";
        }
    </script>
</body>

</html>