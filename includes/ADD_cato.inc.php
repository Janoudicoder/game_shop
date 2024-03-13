<?php
if (isset($_SESSION['melding'])) {
    echo '<p style="color: red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
  }
?>
<div class="container mt-5">
        
        <form action="php/add_category.php" method="POST">


            <div class="mb-3">
                <label for="category_title" class="form-label">Categorie Titel</label>
                <input type="text" class="form-control" id="category_title" name="category_title" required>
            </div>
            <div class="mb-3">
                <label for="category_type" class="form-label">Categorie Soort</label>
                <input type="text" class="form-control" id="category_type" name="category_type" required>
            </div>
          
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>