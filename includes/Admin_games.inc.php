<?php


try {
    $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM games";
    $result = $dbh->query($query);
    echo '</br>';
    echo '<a href="index.php?page=ADD_game" class="btn btn-primary">Game toevoegen</a>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
    echo '<th>Price</th>';
    echo '<th>Category</th>';
    echo '<th>Description</th>';
    echo '<th>Stock</th>';
    echo '<th>foto</th>';
    echo '<th>url</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $gameId = $row['game_id'];
        $gameTitle = htmlspecialchars($row['game_title']);
        $price = htmlspecialchars($row['prijs']);
        $category = htmlspecialchars($row['catogerie']);
        $description = htmlspecialchars($row['beschrijving']);
        $stock = htmlspecialchars($row['vooraad']);
        $url = htmlspecialchars($row['video']);
        $photoBlob = $row['foto'];
        $photoBase64 = base64_encode($photoBlob);
        echo '<tr>';
        echo '<td>' . $gameId . '</td>';
        echo '<td>' . $gameTitle . '</td>';
        echo '<td>$' . $price . '</td>';
        echo '<td>' . $category . '</td>';
        echo '<td>' . $description . '</td>';
        echo '<td>' . $stock . '</td>';
        echo '<td><img src="data:image/jpeg;base64,' . $photoBase64 . '" class="card-img" alt="' . htmlspecialchars($gameTitle) . '"></td>';
        echo '<td>' . $url . '</td>';
        echo '<td>';
        echo '<a href="index.php?page=edit_game&id=' . $gameId . '" class="btn btn-warning">Edit</a> ';
        echo '<form method="POST" action="php/delete_game.php" style="display: inline;">
                <input type="hidden" name="game_id" value="' . $gameId . '">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
