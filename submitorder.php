<?= template_header('') ?>
<?php
$totalPrice = $_SESSION['subtotal']; ;
$nameInput = "" ;
$addressInput = "";
$phoneInput = "";
$emailInput = "";
if (isset($_POST["Name"]))
    $nameInput = $_POST["Name"];
if (isset($_POST["Address"]))
    $addressInput = $_POST["Address"];
if (isset($_POST["Phone"]))
    $phoneInput = $_POST["Phone"];
if (isset($_POST["email"]))
    $emailInput = $_POST["email"];

if ($nameInput != "" && $addressInput != "" && $phoneInput != "" && $emailInput != "") {
    pdo_connect_mysql();
    $query = "INSERT INTO  `team5`.`orders`(total_price,shipping_name,shipping_address,shipping_phone,shipping_email) 
          VALUES(:total_price,:name,:address,:phone,:email)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":total_price", $totalPrice);
    $stmt->bindParam(":name", $nameInput);
    $stmt->bindParam(":address", $addressInput);
    $stmt->bindParam(":phone",  $phoneInput);
    $stmt->bindParam(":email",  $emailInput);
    if ($stmt->execute()) {
        //echo "Insert Success!";
    } else {
        echo $stmt->error;
    }
}
?>
<div class="placeorder content-wrapper">
    <form action="" method="post">
        <p>Thank you for your Patronage!</p>
        <p>Your order will be shipped immediately.</p>
    </form>
</div>

<?= template_footer() ?>