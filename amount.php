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
    SET quantity= :tmpquantity
    WHERE item_id= :tmpid';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":total_price", $totalPrice);
    $stmt->bindParam(":name", $nameInput);
    if ($stmt->execute()) {
        echo "Insert Success!";
    } else {
        echo $stmt->error;
    }
}

?>

<div class="placeorder content-wrapper">
    <form action="" method="post">
        <p>Change successful!</p>
    </form>
</div>

