<!DOCTYPE HTML>
<html>
<head>
    <title>What are you doing here?</title>
</head>
<body>
    <?php
        include("connect.php");
        if (!isset($_GET["c"])) {
            echo "No ID URL parameter found.";
            #Enter a address to goto if a code was not provided
            header("location: https://www.*AnotherDomain*");
            $conn->close();
        }
        $linkCode = $_GET["c"];
        $sql = "SELECT * FROM links WHERE linkCode = '$linkCode'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if (isset($row)) {
            $linkDestination = $row[2];
            $conn->close();
            if (strpos($linkDestination, "www.") === false) {
                $linkDestination = "www." . $linkDestination;
            }
            if (strpos($linkDestination, "http") === false) {
                $linkDestination = "https://" . $linkDestination;
            }
            echo $linkDestination;
            header("location: $linkDestination");
        }else {
            echo "ID not found.";
            $conn->close();
            #Enter a address to goto if a code was not provided
            header("location: https://www.*AnotherDomain*");
        }
    ?>
</body>
</html>