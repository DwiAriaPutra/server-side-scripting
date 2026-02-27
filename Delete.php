<?php
require 'Koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $sql = "DELETE FROM barang WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        // Redirect back with success message
        header("Location: Read.php?status=success_delete");
        exit;
    } catch (PDOException $e) {
        // If there's an error (e.g. foreign key constraint), we can handle it or log it
        die("Error menghapus data: " . $e->getMessage());
    }
} else {
    header("Location: Read.php");
    exit;
}
