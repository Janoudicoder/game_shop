<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM categorie";

    $result = $dbh->query($query);
    echo '</br>';
    echo '<a href="index.php?page=ADD_cato" class="btn btn-primary">Categorie toevoegen</a>'; 
    echo '</br>';

    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Categorie Title</th>';
    echo '<th>Categorie Soort</th>';
    echo '<th>Aanpassen</th>';
    echo '<th>verwijderen</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categoryTitle = htmlspecialchars($row['category_title']);
        $categoryType = htmlspecialchars($row['category_type']);
        $categoryId = $row['categoryId'];

        echo '<tr>';
        echo '<td>' . $categoryTitle . '</td>';
        echo '<td>' . $categoryType . '</td>';
        echo '<td><a href="index.php?page=edit_cato&id=' . htmlspecialchars($categoryId) . '" class="btn btn-warning">Aanpassen</a></td>';
        echo '<td>
                <form method="POST" action="php/delete_category.php">
                    <input type="hidden" name="categoryId" value="' . htmlspecialchars($categoryId) . '">
                    <input type="hidden" name="category_type" value="' . htmlspecialchars($categoryType) . '">
                    <button class="btn btn-danger" type="submit">verwijderen</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

