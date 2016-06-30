<h1>Register</h1>
<?= $info ?>
<form method="post">
	<input type="text" name="login" placeholder="Username" value="<?= htmlentities($_POST['login']) ?>" required><br />
	<input type="email" name="email" placeholder="Email" value="<?= htmlentities($_POST['email']) ?>" required><br />
	<input type="password" name="pass1" placeholder="Password" required><br />
	<input type="password" name="pass2" placeholder="Password again" required><br />
	<input type="submit" value="Create">
</form>