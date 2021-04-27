<?php
    session_start();
    if ($_SESSION["loggedin"] !== TRUE) {
        header("location: codes.php");
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <!-- Enter your domain -->
    <title>*YourDomain* Links</title>
    <style>
        table, td, th {
            border: 1px solid black;
            padding: 3px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <!-- Enter your domain -->
    <h2>*Your Domain* Links</h2>
    <p><a href="codes.php">Home</a> <a href="logout.php">Log Out</a></p>
    <br>
    <p><strong>Create Link</strong></p>
    <?php
        include("connect.php");

        if (isset($_GET["deleteid"])) {
            $id = $_GET["deleteid"];
            $deleteSQL = "DELETE FROM links WHERE linkID = '$id'";
            if ($conn->query($deleteSQL) === TRUE) {
                $message = "Link Deleted. ID: $id";
            }else {
                $error = "Error deleting link: $conn->error";
            }
        }

        if (isset($_POST["code"]) and isset($_POST["url"])) {
            $code = $_POST["code"];
            $url = $_POST["url"];
            $sql = "SELECT * FROM links WHERE linkCode = '$code'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            if (isset($row)) {
                $error = "Error creating link: Code $code already exists, choose another.";
            }else {
                $insertSQL = "INSERT INTO links (linkCode, linkDestination) VALUES ('$code', '$url')";
                if ($conn->query($insertSQL) === TRUE) {
                    $message = "Link added! Code: $code, URL: $url";
                }
                else {
                    $error = "Error adding link: " . $conn->error;
                }
            }
        }

        if (isset($error)) {
            echo "<p style='color: red'>$error</p>";
        }
        if (isset($message)) {
            echo "<p>$message</p>";
        }
    ?>
    <form action="" method="POST">
        <label for="code">Code</label>
        <input type="text" name="code" required>
        <label for="url">URL</label>
        <input type="text" name="url" required value="https://www.">
        <input type="submit" value="Submit">
    </form>
    <hr>
    <!-- Enter your domain -->
    <p>URL Example: *YourDomain*/YourCode</p>
    <h3>Links</h3>
    <table>
        <tr>
            <th>Code</th>
            <th>URL</th>
        </tr>
        <?php
            $selectSQL = "SELECT * FROM links";
            $selectResult = mysqli_query($conn, $selectSQL);
            while ($selectRow = mysqli_fetch_array($selectResult)) {
                $code = $selectRow[1];
                $url = $selectRow[2];
                $id = $selectRow[0];
                echo "<tr>";
                echo "<td>$code</td>";
                echo "<td>$url</td>";
                #Enter your domain
                echo "<td><a href='http://www.*YourDomain*/$code' target='_blank'>Open Link</a></td>";
                echo "<td><a href='?deleteid=$id'>Delete Link</a></td>";
                echo "</tr>";
            }

            $conn->close();
        ?>
    </table>
</body>
</html>