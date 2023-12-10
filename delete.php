<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";
$delete = false;
$error = false;
//Creating a connection with the database
$conn = mysqli_connect($servername, $username, $password, $db);
//Die if Connection Failed
if (!$conn) {
    die("Sorry we Failed to Connect" . mysqli_connect_error());
} else {
    if (isset($_POST['delete'])) {
        $Cid = $_POST['Cid'];
        $sql_check = "SELECT * FROM `booking_info` WHERE `Cid` = '$Cid'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            $sql3 = "DELETE FROM `booking_info` WHERE `Cid` = '$Cid'";
            $res3 = mysqli_query($conn, $sql3);
            if ($res3) {
                $delete = true;
            }
        } else {
            $error = true;
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
        if ($delete) {
            echo "<div class='alert alert-secondary alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Record has been Deleted Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
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
            </div>
            <button type="submit" name="delete" class="btn btn-primary my-3">Delete</button>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>