<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <?php
       
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                
            } 
        } 
        ?>
    </div>
</body>
</html>
