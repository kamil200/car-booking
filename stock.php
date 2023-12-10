<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";
$stock_added = false;
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Sorry we Failed to Connect" . mysqli_connect_error());
} else {
    if (isset($_POST['addstock'])) {
        $Carid = $_POST['Carid'];
        $CarCount = $_POST['CarCount'];
        $sqlGetCurrentStock = "SELECT `car_count` FROM `car_info` WHERE `car_id` = '$Carid'";
        $resGetCurrentStock = mysqli_query($conn, $sqlGetCurrentStock);

        if ($resGetCurrentStock && mysqli_num_rows($resGetCurrentStock) > 0) {
            $currentStockRow = mysqli_fetch_assoc($resGetCurrentStock);
            $currentStock = $currentStockRow['car_count'];
            $newStock = $currentStock + $CarCount;
            $sqlstock = "UPDATE `car_info` SET `car_count` = '$newStock' WHERE `car_id` = '$Carid';";
            $resstock = mysqli_query($conn, $sqlstock);
            if ($resstock) {
                $stock_added = true;
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
        if ($stock_added) {
            echo "<div class='alert alert-secondary alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Stock has been Updated Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        ?>
        <form action="#" method="POST">
            <div class="container">
                <div class="form-group">
                    <label for="Carid">Select Car ID:</label>
                    <select class="form-select" name="Carid" id="Carid" required>
                        <option value="">Select a car ID</option>
                        <option value="500">500</option>
                        <option value="501">501</option>
                        <option value="502">502</option>
                        <option value="503">503</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="CarCount" class="form-label">No. of Cars</label>
                    <input type="number" id="CarCount" name="CarCount" class="form-control"
                        placeholder="Enter Number of cars" required />
                </div>
            </div>
            <button type="submit" name="addstock" class="btn btn-primary my-3">Add Stock</button>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>