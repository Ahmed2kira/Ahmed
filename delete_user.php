<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'");
$stmt->execute([$id]);

header('Location: dashboard.php?success=deleted');
?>