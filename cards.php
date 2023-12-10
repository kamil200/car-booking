<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "car_details";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Sorry we Failed to Connect" . mysqli_connect_error());
} else {
    $count_query = "SELECT * FROM `car_info`";
    $result = mysqli_query($conn, $count_query);

    // Store the results in an array
    $carRows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $carRows[] = $row;
    }
    mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="m-container" id="book">
        <?php foreach ($carRows as $row) { ?>
            <div class="card">
                <h3 class="myh4">
                    <?php echo $row['car_name']; ?>
                </h3>
                <div class="card-img">
                    <img src="./imgs/<?php echo strtolower($row['car_name']); ?>.png" alt="">
                </div>
                <span>CAR ID:
                    <?php echo $row['car_id']; ?>
                </span>
                <p>
                    <?php echo $row['description']; ?>
                </p>
                <span>Available Count:
                    <?php echo $row['car_count']; ?>
                </span>
                <?php if ($row['car_count'] <= 0) { ?>
                    <p class="out-of-stock">Out of Stock</p>
                    <button class="m-btn" disabled>BOOK NOW</button>
                <?php } else { ?>
                    <button onclick="redirectToBook('<?php echo $row['car_name']; ?>')" class="m-btn carBuy">BOOK NOW</button>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
    <script>
        function redirectToBook(selectedCar) {
            window.location.href = `book.php?selectedCar=${selectedCar}`;
        }
    </script>
</body>

</html>