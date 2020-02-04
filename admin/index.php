<?php
session_start();

require_once('../config.php');
require_once('../functions.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>

	<link rel="stylesheet" href="includes/styles/style.css">

</head>

<body>
	<div class="wrapper">
		<form id="signIn" method="POST">
			<div class="form-group">
				<label>Login* : </label>
				<input type="text" id="login" name="login" require />
				<span class="comment"></span>
			</div>
			<div class="form-group">
				<label>MDP* : </label>
				<input type="text" id="mdp" name="mdp" require />
				<span class="comment"></span>
			</div>
			<button type="submit" id="valider"> Envoyer </button>
			<button type="button" class="btn-reset"> Annuler </button>
		</form>
	</div>
</body>

<script src="includes/scripts/js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#signIn').submit(function(e) {
			e.preventDefault();
			$('.comment').empty();

			var postData = $('#signIn').serialize();
			$.ajax({
				type: 'POST',
				url: 'includes/scripts/ajax/signin.php',
				data: postData,
				dataType: 'json',
				success: function(result) {
					if (result.isValid) {
						document.location.href = 'message.php';
						resetForm();
					} else {
						if(result.signInErr) {
							alert ('Le login et le mdp ne correspondent pas ! ');
							resetForm();
						} else {
							$('#login + .comment').html(result.loginErr);
							$('#mdp + .comment').html(result.mdpErr);
							resetForm();
						}
					}
				}
			});
		});

		function resetForm() {
			$('#signIn')[0].reset();
		}
	});
</script>

</html>