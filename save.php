<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_type = trim($_POST['id_type']);
  $name = trim($_POST['name']);
  $id_number = trim($_POST['id_number']);

  // Decode base64 photo & signature
  $photo_data = $_POST['photo_data'] ?? null;
  $signature_data = $_POST['signature_data'] ?? null;

  $photo_blob = null;
  $signature_blob = null;

  if ($photo_data && preg_match('/^data:image\\/(png|jpeg);base64,/', $photo_data)) {
    $photo_blob = base64_decode(preg_replace('/^data:image\\/(png|jpeg);base64,/', '', $photo_data));
  }

  if ($signature_data && preg_match('/^data:image\\/(png|jpeg);base64,/', $signature_data)) {
    $signature_blob = base64_decode(preg_replace('/^data:image\\/(png|jpeg);base64,/', '', $signature_data));
  }

  if ($id_type && $name && $id_number) {
    $stmt = $mysqli->prepare("INSERT INTO lecturer_presence (id_type, name, id_number, photo, signature) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id_type, $name, $id_number, $photo_blob, $signature_blob);
    $stmt->send_long_data(3, $photo_blob);
    $stmt->send_long_data(4, $signature_blob);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Presence recorded successfully!');window.location='index.php';</script>";
  } else {
    echo "<script>alert('Please fill all required fields.');window.location='index.php';</script>";
  }
}
?>