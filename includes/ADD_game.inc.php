<?php
require './private/conn.php';

// Fetch categories from the database
try {
    $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
    $categoryQuery = "SELECT categoryId, category_title FROM categorie";
    $categoryStmt = $dbh->prepare($categoryQuery);
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
}
?>

<?php
if (isset($_SESSION['melding'])) {
    echo '<p style="color: red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
}
?>
<div class="container mt-5">
    <form action="php/Add_game.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div>
             <label for="categorie" class="form-label">categorie</label>

            <select name="category" class="form-select" aria-label="Default select example">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['categoryId'] ?>"><?= $category['category_title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="aantal" class="form-label">Voorraad</label>
            <input type="number" class="form-control" id="aantal" name="aantal" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prijs</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Photo:</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="text" class="form-control" id="video" name="video" accept="video/webm" required>
        </div>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>
