
<div>
    <h2>Secrets</h2>
    <?php

    require_once 'database.php';

    $sql = "SELECT * FROM secrets where user_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $_COOKIE['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<p>' . $row['secret'] . '</p>';
            }
        } else {
            echo '<p>No secrets found</p>';
        }
    }


    ?>
</div>
