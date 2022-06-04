<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM item ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="featured">
    <h2>Gadgets</h2>
    <p>Essential gadgets for everyday use</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['item_id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['item_name']?>">
            <span class="name"><?=$product['item_name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['discount_price'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['discount_price']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>