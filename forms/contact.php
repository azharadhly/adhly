<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    $subject = htmlspecialchars($_POST['subject']);

    try {
        $conn = new PDO("mysql:host=localhost;dbname=adhlyazhar", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO contact (Name, Email, Subject, Message) VALUES (:name, :email, :subject, :message)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        // Success message to display after form submission
        echo "OK";

    } catch (PDOException $e) {
        // Error message to display if an exception occurs
        echo "An error occurred: " . $e->getMessage();
    }
    $conn = null;
}
?>
