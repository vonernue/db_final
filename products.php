<?php
if(isset($_GET['catagory'])){
    $catagory = $_GET['catagory'];
    // The amounts of products to show on each page
    $num_products_on_each_page = 4;
    // The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
    // Select products ordered by the date added
    $stmt = $pdo->prepare('SELECT * FROM item natural join item_category where category = ? ORDER BY date_added DESC LIMIT ?,?');
    // bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
    $stmt->bindValue(1, $catagory, PDO::PARAM_STR);
    $stmt->bindValue(2, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $stmt->bindValue(3, $num_products_on_each_page, PDO::PARAM_INT);
    $stmt->execute();
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the total number of products
    $stmt = $pdo->prepare('SELECT * FROM item natural join item_category where category = ?');
    $stmt->execute([$catagory]);
    $total_products = sizeof($stmt->fetchAll(PDO::FETCH_ASSOC));
}else{
    $catagory = 'Products';
    // The amounts of products to show on each page
    $num_products_on_each_page = 4;
    // The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
    // Select products ordered by the date added
    $stmt = $pdo->prepare('SELECT * FROM item ORDER BY date_added DESC LIMIT ?,?');
    // bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
    $stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $stmt->execute();
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the total number of products
    $total_products = $pdo->query('SELECT * FROM item')->rowCount();
}

?>

<?=template_header('Products')?>
<div class ="category">
    <a href="index.php?page=products" class="catagory_button">ALL</a>
    <a href="index.php?page=products&catagory=T-Shirt"class="catagory_button">T-Shirt</a> 
    <a href="index.php?page=products&catagory=men"class="catagory_button">Men</a> 
    <a href="index.php?page=products&catagory=Women"class="catagory_button">Women</a> <br>
    <a href="index.php?page=products&catagory=jacket"class="catagory_button">Jacket</a>
    <a href="index.php?page=products&catagory=jeans"class="catagory_button">Jeans</a>
    <a href="index.php?page=products&catagory=pants"class="catagory_button">Pants</a>
    <a href="index.php?page=products&catagory=underwear"class="catagory_button">Underwear</a>
</div>
<div class="products content-wrapper">
    <h1> <?=ucfirst($catagory)?> </h1>
    <p><?=$total_products?> Items </p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['item_id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['item_name']?>">
            <span class="name"><?=$product['item_name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>