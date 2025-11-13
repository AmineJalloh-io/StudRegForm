<?php
require_once 'db_config.php';
$result = $mysqli->query("SELECT * FROM lecturer_presence ORDER BY recorded_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Lecturer Presence Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="container">
    <h1>Lecturer Presence Records</h1>
    <a href="index.php" class="button">← Back to Form</a>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>ID Type</th>
          <th>Name</th>
          <th>ID Number</th>
          <th>Photo</th>
          <th>Signature</th>
          <th>Date & Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $i = 1;
          while ($row = $result->fetch_assoc()) {
            $photo = $row['photo'] ? '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" width="80">' : 'N/A';
            $signature = $row['signature'] ? '<img src="data:image/png;base64,'.base64_encode($row['signature']).'" width="80">' : 'N/A';
            echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['id_type']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['id_number']}</td>
                    <td>{$photo}</td>
                    <td>{$signature}</td>
                    <td>{$row['recorded_at']}</td>
                  </tr>";
            $i++;
          }
        } else {
          echo '<tr><td colspan="7">No records found.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>