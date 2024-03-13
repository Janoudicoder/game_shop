<?php

if (isset($_SESSION['melding'])) {
    echo '<p style="color: red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
  }

  
try {
    $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM categorie";

    $result = $dbh->query($query);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categoryTitle = $row['category_title'];
        $categoryType = $row['category_type'];

        echo '<div class="d-inline p-2 text-center">
        <button class="product-filter-btn" data-filter="' . htmlspecialchars($categoryType) . '">' . htmlspecialchars($categoryTitle) . '</button>
        </div>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<div id="myProductFilter" class="container mt-4">
    <div class="row">

         <button class="product-filter-btn active" data-filter="all">Show all</button>
   
     <?php
         try {
    
   

    
            $query = "SELECT * FROM games";
            $result = $dbh->query($query);
        
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $gameId = $row['game_id'];
                $gameTitle = $row['game_title'];
                $price = $row['prijs'];
                $category = $row['catogerie'];
                $description = $row['beschrijving'];
                $stock = $row['vooraad'];
                $youtubeVideoLink = $row['video'];
                $photoBlob = $row['foto'];
                $photoBase64 = base64_encode($photoBlob);
                echo '<div class="col-md-4 filterDiv" data-category="' . htmlspecialchars($category) . '">';
                echo '<div class="card product-card">';
                echo '<div class="product-image-container">';
                echo '<img src="data:image/jpeg;base64,' . $photoBase64 . '" class="card-img" alt="' . htmlspecialchars($gameTitle) . '">';
            
               
                if (!empty($youtubeVideoLink)) {
                    echo '<div class="youtube-video-container">';
                    echo '<iframe src="' . htmlspecialchars($youtubeVideoLink) . '" frameborder="0" allowfullscreen></iframe>';
                    echo '</div>';
                }
            
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($gameTitle) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($description) . '</p>';
                echo '<p class="card-text">$' . htmlspecialchars($price) . '</p>';
                echo '<input type="hidden" name="game_id" value="1">';
                ?>
                <form action="php/add_to_cart.php" method="post">
                    <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($gameId); ?>">
                    <input type="hidden" name="game_title" value="<?php echo htmlspecialchars($gameTitle); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    <button type="submit" name= "add_to_cart" class="btn btn-primary add-to-cart-btn">Add to Cart</button>
                </form>
                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
            
            }
            }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script>
    function filterProducts(category) {
        var productCards = document.getElementsByClassName("filterDiv");

        for (var i = 0; i < productCards.length; i++) {
            var card = productCards[i];
            var cardCategory = card.getAttribute("data-category");

            if (category === "all" || cardCategory === category) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        }
    }

    var filterButtons = document.getElementsByClassName("product-filter-btn");
    for (var i = 0; i < filterButtons.length; i++) {
        filterButtons[i].addEventListener("click", function () {
            var activeButton = document.querySelector(".product-filter-btn.active");
            activeButton.classList.remove("active");
            this.classList.add("active");
            var category = this.getAttribute("data-filter");
            filterProducts(category);
        });
    }

    
    filterProducts("all");
    document.addEventListener('DOMContentLoaded', function () {
    var productContainers = document.querySelectorAll('.product-image-container');

    productContainers.forEach(function (container) {
        var video = container.querySelector('.product-video');
        var videoLink = container.getAttribute('data-video-link');

        container.addEventListener('mouseenter', function () {
            if (videoLink) {
                video.src = videoLink;
                video.style.display = 'block';
            }
        });

        container.addEventListener('mouseleave', function () {
            if (videoLink) {
                video.style.display = 'none';
                video.src = ''; 
            }
        });
    });
});
</script>

