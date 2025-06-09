<?php


include_once('config.php');

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    $stmt = $conn->prepare("INSERT INTO books (title, author, price, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $title, $author, $price, $description);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>