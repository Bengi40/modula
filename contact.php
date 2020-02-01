<?php
	require_once('config.php');
	require_once('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Contact</title>

    <link rel="stylesheet" href="includes/styles/style.css">

</head>
<body>
	<div class="wrapper">
        <form method="post" >
            <div class="form-group">
                <label>Nom : </label>
                <input type="text" id="nom" name="nom" value=""/>
            </div>
            <div class="form-group">
                <label>Prénom : </label>
                <input type="text" id="prenom" name="prenom" value=""/>
            </div>
            <div class="form-group">
                <label>Email : </label>
                <input type="email" id="email" name="email" value=""/>
            </div>
            <div class="form-group">
                <label>Votre message : </label>
                <textarea id="message" name="message" value=""/></textarea>
            </div>
            <div class="form-group">
                <label>RGPD: </label>
                <input type="checkbox" id="rgpd" name="rgpd" value=""/>
            </div>

            <button type="submit" class="btn-valide"> Envoyer </button>
            <button type="submit"> Annuler </button>
        </form>
	</div>
</body>

	<script src="includes/scripts/js/jquery.js"></script>
    <script src="includes/scripts/js/script.js"></script>

    <script type="text/javascript">
        var nom = "";
        var prenom = "";
        var email = "";
        var message = ""
        var rgpd = false;

        function info() {
            nom = $('#nom').val();
            prenom = $('#prenom').val();
            email = $('#email').val();
            message = $('#message').val();
            rgpd = $('#rgpd').val();

            $.ajax({
                type: "POST",
                url: "newMessage.php",
                data: {
                    nom: nom,
                    prenom: prenom,
                    email: email,
                    message: message,
                    rgpd: rgpd
                }
            });

            console.log(nom)
        }

        $('.btn-valide').click(function(){
			info();
		});

    </script>
</html> 
