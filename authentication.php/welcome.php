<?php
// Start a session
session_start();
// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
</head>

<body>
    <h2> Welcome, <?php echo $_SESSION["name"]; ?>!</h2>
    <p> WELCOME TO OUR WEBSITE </p>
    <a href="logout.php">Logout</a>
</body>

</html>