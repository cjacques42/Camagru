<h1>Log In</h1>
<?= $info ?>
<form method="post">
	<input type="text" name="login" placeholder="Username" value="<?= htmlentities($_POST['login']) ?>" required><br />
	<input type="password" name="pass1" placeholder="Password" value="<?= htmlentities($_POST['pass1']) ?>" required><br />
	<a href="validation.php?p=forget">Forgot your password ?</a><br />
	<input type="submit" value="Log In"><br />
</form>