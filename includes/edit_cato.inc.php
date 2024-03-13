<div class="container mt-5">
    <?php
    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];

        try {
            require './private/conn.php';
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM categorie WHERE categoryId = :categoryId";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->execute();

            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($category) {
                $categoryTitle = htmlspecialchars($category['category_title']);
                $categoryType = htmlspecialchars($category['category_type']);

                echo '<h1>Edit Category</h1>';
                echo '<form method="POST" action="php/edit_cato.php">';
                echo '<input type="hidden" name="category_id" value="' . $categoryId . '">';

                echo '<div class="form-group">';
                echo '<label for="new_category_title">Category Title:</label>';
                echo '<input type="text" class="form-control" name="new_category_title" value="' . $categoryTitle . '">';
                echo '</div>';

                echo '<div class="form-group">';
                echo '<label for="new_category_type">Category Type:</label>';
                echo '<input type="text" class="form-control" name="new_category_type" value="' . $categoryType . '">';
                echo '</div>';
                
                echo '<button type="submit" class="btn btn-primary">Aanpassen</button>';
                echo '</form>';
            } else {
                echo '<div class="alert alert-danger">Categorie niet gevonden</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Categorie-ID niet opgegeven.</div>';
    }
    ?>
</div>

