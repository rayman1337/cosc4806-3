<?php require_once 'app/views/templates/headerPublic.php' ?>
<style>
	body {
		font-family: sans-serif;
		background-color: #f0f0f0;
		padding-top: 60px;
	}

	.container {
		max-width: 400px;
		margin: auto;
		background-color: white;
		padding: 25px 30px;
		border-radius: 8px;
		border: 1px solid #ccc;
	}

	h1 {
		text-align: center;
		margin-bottom: 20px;
	}

	.form-group {
		margin-bottom: 15px;
	}

	label {
		display: block;
		margin-bottom: 5px;
		font-weight: bold;
	}

	.form-control {
		width: 100%;
		padding: 8px;
		border: 1px solid #aaa;
		border-radius: 4px;
	}

	.btn {
		width: 100%;
		padding: 10px;
		background-color: #007bff;
		color: white;
		border: none;
		border-radius: 4px;
		font-weight: bold;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		display: inline-block;
	}

	.btn:hover {
		background-color: #0069d9;
	}

	.message {
		text-align: center;
		margin-bottom: 15px;
		color: red;
	}

	.signup-link {
		text-align: center;
		margin-top: 15px;
	}

	.signup-link a {
		color: #007bff;
		text-decoration: none;
	}

	.signup-link a:hover {
		text-decoration: underline;
	}
</style>

<main role="main" class="container">
	<h2>Assignment 3 – Login</h2>

	<?php if (!empty($data['error'])): ?>
		<div class="message"><?= $data['error'] ?></div>
	<?php endif; ?>

	<form action="/login/verify" method="post">
		<div class="form-group">
			<label for="username">Username</label>
			<input required type="text" class="form-control" name="username">
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input required type="password" class="form-control" name="password">
		</div>

		<button type="submit" class="btn">Login</button>
	</form>

	<div class="signup-link">
		No account? <a href="/create">Create one here</a>
	</div>
</main>

<?php require_once 'app/views/templates/footer.php' ?>
