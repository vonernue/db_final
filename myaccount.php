<?php
    if(isset($_post['cpassword'])) {
        if($_post['cpassword'] == $_post['password']) {
            $stmt = $pdo->prepare('SELECT account FROM customer ');
            $stmt->execute();
            $accounts = $stmt->fetchall(PDO::FETCH_ASSOC);
            if(in_array($_post['account'], $accounts)) {
                echo '<script>alert("Account already exists!")</script>';
            } else {
                $stmt = $pdo->prepare('INSERT INTO customer (account, password) VALUES (?, ?)');
                $stmt->execute($_post['account'], $_post['password']);
                echo '<script>alert("Register successfully!")</script>';
            }
        } else {
            echo '<p>Passwords do not match!</p>';
        }
    }


?>

<?=template_header('My Account')?>

<div class="myaccount content-wrapper">
    <div class="login-register">
        <div class="login">
            <h1>Login</h1>
            <p>
                <u>Admin Credentials</u><br>
                Email: admin@website.com<br>
                Password: admin
            </p>

            <form action="" method="post">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="john@example.com" value="admin@website.com" required="" class="form-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" value="admin" required="" class="form-field">
                <input name="login" type="submit" value="Login" class="btn">
            </form>
        </div>

        <div class="register">
            <h1>Register</h1>
            <form action="" method="post">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="john@example.com" required="" class="form-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required="" class="form-field">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required="" class="form-field">
                <input name="register" type="submit" value="Register" class="btn">
            </form>
        </div>
    </div>
</div>

<?=template_footer()?>