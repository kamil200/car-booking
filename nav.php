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
  <link href="https://fonts.googleapis.com/css2?family=Alice&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- box icons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary myshadow">
    <div class="container-fluid">
      <a class="navbar-brand my-lfont mx-3" href="#">Car Booking System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mynavlinks">
          <a class="nav-link active mx-2" aria-current="page" href="home.php">Home</a>
          <a class="nav-link mx-2" href="#">About Us</a>
          <a class="nav-link mx-2" href="#book">Book Now</a>
          <button class="btn-primary" onclick="logout()">Log Out</button>
        </div>
      </div>
  </nav>

  <script>
    const logout = () => {
      window.location.href = 'signout.php';
    }
  </script>
</body>

</html>