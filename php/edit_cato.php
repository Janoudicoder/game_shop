<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require '../private/conn.php';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $categoryId = $_POST['category_id'];
        $newCategoryTitle = $_POST['new_category_title'];
        $newCategoryType = $_POST['new_category_type'];

        $query = "UPDATE categorie SET category_title = :new_category_title, category_type = :new_category_type WHERE categoryId = :category_id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':new_category_title', $newCategoryTitle, PDO::PARAM_STR);
        $stmt->bindParam(':new_category_type', $newCategoryType, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        header('location: ../index.php?page=Admin_shop');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
