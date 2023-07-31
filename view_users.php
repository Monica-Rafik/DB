<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
</head>
<body>
    <div class="container">
        <h2>All Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Profile Picture</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php

            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td><img src='{$row['profile_pic']}' width='50' height='50'></td>";
                    echo "<td><a href='edit_user.php?id={$row['id']}'>Edit</a></td>";
                    echo "<td><a href='delete_user.php?id={$row['id']}'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
