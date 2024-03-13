<?php
require '../private/conn.php';

$category_title = $_POST['category_title'];
$category_type = $_POST['category_type'];

$query = "SELECT * FROM categorie WHERE category_title = :category_title OR category_type = :category_type";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':category_title', $category_title); 
$stmt->bindParam(':category_type', $category_type);  
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['melding'] = 'De categorie bestaat al.';
    header('location:../index.php?page=ADD_cato');
    exit;
} else {
    $insertQuery = "INSERT INTO categorie (category_title, category_type) VALUES (:category_title, :category_type)";
    $insertStmt = $dbh->prepare($insertQuery);
    $insertStmt->bindParam(':category_title', $category_title); 
    $insertStmt->bindParam(':category_type', $category_type);  

    if ($insertStmt->execute()) {
        $_SESSION['melding'] = 'Categorie is toegevoegd.';
        header('location:../index.php?page=ADD_cato');
        exit;
    } else {
        $_SESSION['melding'] = 'Toevoegen mislukt. Probeer het opnieuw.';
        header('location:../index.php?page=ADD_cato');
        exit;
    }
}
?>
