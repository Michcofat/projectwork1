<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
</head>

<body>
    <h2>Registration Form</h2>
    <?php


    // Establish database connection
    require '../inc/dbcon.php'; 


    // Process the registration form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input (you can add more validation)
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Store user data in the database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the login page

            echo "User registered successfully";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>




    <form action="reg.php" method="post">
        <!-- Your registration form fields -->
        <label for="name">Name:</label>
        <input type="text" name="name" required> <br>
          <br>

        <label for="email">Email:</label>
        <input type="email" name="email" required> <br>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required> <br>
        <br>


        <input type="submit" value="Submit">
    </form>
</body>

</html>