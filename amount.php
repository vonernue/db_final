<?php
//update amount to database
//wrong answer
if (isset($_POST['product_id'], $_POST['quantity']) ){
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    //database
    pdo_connect_mysql();
    $query = 'UPDATE item
    SET quantity= ?
    WHERE item_id= ?';
    $stmt = $pdo->prepare($query);
    if ($stmt->execute($quantity,$_product_id)) {
        echo "Insert Success!";
    } else {
        echo $stmt->error;
    }
}

?>
<?=template_manager('amount')?>
<div class="placeorder content-wrapper">
    <form action="" method="post">
        <p>Change successful!</p>
    </form>
</div> 

