<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_details";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// Process sign-up form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sname"], $_POST["semail"], $_POST["spassword"])) {
    $sname = $_POST["sname"];
    $semail = $_POST["semail"];
    $snew_password = $_POST["spassword"];

    $sql = "INSERT INTO car_login (name, email, password) VALUES ('$sname', '$semail', '$snew_password')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Signup successfull, now please Sign in");</script>';
    } else {
        echo '<script>alert("Signup failed");</script>';
    }
}

// Process sign-in form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $user_password = $_POST["password"];

    $sql = "SELECT * FROM car_login WHERE email = '$email' AND password = '$user_password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        $userIsAdmin = false;
        if($row['name']=='admin'){
            $userIsAdmin = true;
        }
        if ($userIsAdmin) {
            session_start();
            $_SESSION['userType'] = 'admin';
            header("Location: book.php");
            exit;
        } else {
            session_start();
            $_SESSION['userType'] = 'user';
            header("Location: home.php");
            exit;
        }
    } else {
        echo '<script>alert("Login failed");</script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>SignUp and Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">

            <form action="#" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="sname" placeholder="Name" required>
                <input type="email" name="semail" placeholder="Email" required>
                <input type="password" name="spassword" placeholder="Password" required>
                <button>SignUp</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign In</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#">Forgot Your Password</a>

                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>


</body>

</html>