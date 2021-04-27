<?php
    session_start();
    include("connect.php");
    $sql = "SELECT * FROM password";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $correctPassword = $row[0];

    if ($_SESSION["loggedin"] === TRUE) {
        header("location: edit.php");
    }
    if (isset($_POST["password"])) {
        if ($_POST["password"] === $correctPassword) {
            $_SESSION["loggedin"] = TRUE;
            header("location: edit.php");
        }else {
            $message = "Wrong Password!";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Log in</title>
</head>
<body>
    <h3>URL Shortner</h3>
    <p style="color: red;"><?php echo $message; ?></p>
    <form method="POST" action="">
        <label for="passwordinput">Password: </label>
        <input id="passwordinput" type="password" name="password" required/>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>