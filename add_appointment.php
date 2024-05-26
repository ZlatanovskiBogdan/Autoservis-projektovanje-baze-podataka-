<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vozilo_id = $_POST['vozilo_id'];
    $datum = $_POST['datum'];
    $opis = $_POST['opis'];

    $sql = "INSERT INTO servisni_termini (vozilo_id, datum, opis) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $vozilo_id, $datum, $opis);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}