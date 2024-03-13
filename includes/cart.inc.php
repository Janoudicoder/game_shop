<?php
require './private/conn.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $sql = "SELECT * FROM cart WHERE user_id = :userId";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($cartItems) > 0) {
        $totalPrice = 0;
        ?>
        <div class="container mt-5">
            <h1>Your Cart</h1>
            <form method="post" action="php/update_cart.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Game</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo $item['game_title']; ?></td>
                                <td>$<?php echo number_format($item['prijs'], 2); ?></td>
                                <td><?php echo $item['vooraad']; ?></td>
                                <td>$<?php echo number_format($item['prijs'] * $item['vooraad'], 2); ?></td>
                            </tr>
                            <?php $totalPrice += ($item['prijs'] * $item['vooraad']);
                     endforeach; ?>
                    </tbody>
                </table>
            </form>
            <div class="text-end">
                <h3>Total: $<?= number_format($totalPrice, 2) ?></h3>
                <button class="btn btn-primary">Checkout</button>
            </div>
        </div>
        <?php
    } else {
        echo "Winkelwagentje is leeg.";
    }
} else {
    $_SESSION['melding'] = 'eerste inloggen';
    header('location: ./index.php?page=login');
}
?>
