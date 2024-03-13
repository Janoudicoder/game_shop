<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        require '../private/conn.php';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $categoryId = $_POST['categoryId'];

        $query = "DELETE FROM categorie WHERE categoryId = :categoryId";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId , PDO::PARAM_STR);
        
        $stmt->execute();

        header('location: ../index.php?page=Admin_shop');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
