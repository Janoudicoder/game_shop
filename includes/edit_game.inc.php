<?php
if (isset($_GET['id'])) {
    $gameId = $_GET['id'];
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM games WHERE game_id = :gameId";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
        $game = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
        $categoryQuery = "SELECT categoryId, category_title FROM categorie";
        $categoryStmt = $dbh->prepare($categoryQuery);
        $categoryStmt->execute();
        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

?>


<body>
    <div class="container mt-5">
        <h1>Edit Game</h1>
        <form action="php/edit_game.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="game_id" value="<?php echo $game['game_id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $game['game_title']; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $game['prijs']; ?>">
            </div>
            <div>
                <label for="category" class="form-label">category:</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <?php foreach ($categories as $cat) : ?>
                        <option value="<?php echo $cat['categoryId']; ?>"><?php echo $cat['category_title']; ?></option>
                    <?php endforeach; ?>
                </select>
             </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $game['beschrijving']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $game['vooraad']; ?>">
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Video URL:</label>
                <input type="text" class="form-control" id="url" name="url" value="<?php echo $game['video']; ?>">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo:</label>
                <input type="file" class="form-control" id="photo" name="photo">
                <small class="text-muted">Upload a new photo for the game (optional).</small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Voeg Bootstrap JS toe (optioneel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>



