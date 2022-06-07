<?= template_header('Place Order') ?>

<div class="placeorder content-wrapper">
    <form action="" method="post">
        <label for="Name"   class="form-label">Name</label>
        <input type="text"  name="Name"             placeholder="Your Name" value="" required="" class="form-field">
        <label for="credit card ID" class="form-label">Credit Card ID</label>
        <input type="text"  name="credit card ID"   placeholder="XXXX-XXXX-XXXX-XXXX" value="" required="" class="form-field">
        <label for="Address" class="form-label">Address</label>
        <input type="text"  name="Address"  placeholder= "format address" value="" required="" class="form-field">
        <br>
        <input name="submit" type="submit" value="submit">
    </form>
</div>

<?= template_footer() ?>