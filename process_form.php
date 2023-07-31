<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $servername = 'localhost';
    $username = 'root';
    $dbname = 'users';

    $conn = new mysqli($servername, $username, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_destination = 'uploads/' . $file_name;
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        $file_destination = null;
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, profile_pic) VALUES ('Monica','monica@gmail.com', 'oooooooo', profile_pics/logo.jpeg)");
    $stmt->bind_param("ssss", $name, $email, $password, $file_destination);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: view_users.php");
    exit;
}
?>
