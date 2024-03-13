<?php
$menu = array(
    

    'gast' => array(
        'welkom' => 'home',
        'winkel' => 'shop',
        'inloggen' => 'login'
        
    ),
    'admin' => array(
        'welkom' => 'home',
        'Categorie' => 'Admin_shop',
          'games' => 'Admin_games'
          
          
          
  
    ),
    'gebruiker' => array(
        
        'welkom' => 'home',
        'winkel' => 'shop',
        
    ),
  
    
);

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
echo '<div class="container">';
echo '<a class="navbar-brand" href="index.php?page=home">MJ games</a>';


foreach($menu[$user] as $label => $link ) {
    echo ' <li class="nav-item">
    <a class="nav-link" href="index.php?page=' . $link . '">' . $label . '</a>
        </li>';
}

echo '<li class="nav-item">
        <a class="nav-link" href="index.php?page=cart">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
            </svg>
        </a>
        
        
        
        </li>';

        if ($user != 'gast') {
            echo '<a href="php/logout.php"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>  
          </a>';
          
          }

         echo' <div class="dropdown">
                <span>Mouse over me</span>
                <div class="dropdown-content">
                <p>Hello World!</p>';
                ?>  
                
                

  </div>
</div>
          
echo '</nav>';
echo '</div>';
?>




<header class="hero bg-primary text-white text-center py-5">
    <div class="container">
        <h1>Beste games van MJ games</h1>
    </div>
</header>