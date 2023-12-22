<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>

<body>
    <h2>Login Form</h2>



    <?php
    // Start a session
    session_start();



    // Establish database connection
    require '../inc/dbcon.php'; 



    // Process the login form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input (you can add more validation)
        $email = htmlspecialchars($_POST["email"]);
        $password = $_POST["password"]; // Password from the form

        // Retrieve user data from the database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Check password hash
            if (password_verify($password, $row["password"])) {
                // Store user information in the session
                $_SESSION["id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                // Redirect to the welcome page or wherever you want to go after login
                header("Location: welcome.php");
                exit();
            } else {
                // Incorrect password, handle accordingly
                echo "Invalid email or password.";
            }
        } else {
            // User not found, handle accordingly
            echo "Invalid email or password.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <form action="login.php" method="post">
        <!-- Your login form fields go here -->
        <label for="email">Email:</label>
        <input type="email" name="email" required> <br>


        <label for="password">Password:</label> 
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</body>

</html>