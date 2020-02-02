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
        <form method="post" id="contact" action="includes/scripts/ajax/newMessage.php">
            <div class="form-group">
                <label>Nom* : </label>
                <input type="text" id="nom" name="nom" value="" require/>
            </div>
            <div class="form-group">
                <label>Prénom* : </label>
                <input type="text" id="prenom" name="prenom" value="" require/>
            </div>
            <div class="form-group">
                <label>Email* : </label>
                <input type="email" id="email" name="email" value="" require/>
            </div>
            <div class="form-group">
                <label>Votre message* : </label>
                <textarea id="message" name="message" value="" require/></textarea>
            </div>
            <div class="form-group">
                <label>RGPD* : </label>
                <input type="checkbox" id="rgpd" name="rgpd" value="false" require/>
            </div>
    <p> Les champs marqués d'un * sont obligatoires </p>
            <button type="submit" id="valider" class="btn-valide"> Envoyer </button>
            <button type="button" class="btn-reset"> Annuler </button>
        </form>
    </div>
</body>

<script src="includes/scripts/js/jquery.js"></script>
<script src="includes/scripts/js/script.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /**
         * Si javascript est actif chez le client.
         */  
        $('#contact').removeAttr("action");
        $('#valider').removeAttr("type");

        var nom = "";
        var prenom = "";
        var email = "";
        var message = ""
        var rgpd = false;
        var ip = '192.168.1.250';

        function controlForm() {
            var isValid = true;

            nom = $('#nom').val();
            prenom = $('#prenom').val();
            email = $('#email').val();
            message = $('#message').val();

            error = "Merci de bien vouloir valider les éléments suivants : ";

            if (nom == "") {
                isValid = false;
                error += "Nom, ";
            }
            if (prenom == "") {
                isValid = false;
                error += "Prénom, ";
            }
            if (email == "") {
                isValid = false;
                error += "Email, ";
            }
            if (message == "") {
                isValid = false;
                error += "Message, ";
            }
            if (!$('input[name=rgpd]').is(':checked')) {
                isValid = false;
                error += "Condition ";
            }

            error += "!";

            if (isValid) {
                addNewMessage(nom, prenom, email, message);
            } else {
                alert(error);
            }
        }

        function addNewMessage(nom, prenom, email, message) {
            $.ajax({
                type: "POST",
                url: "includes/scripts/ajax/newMessage.php",
                data: {
                    nom: nom,
                    prenom: prenom,
                    email: email,
                    message: message,
                    ip: ip
                },
                success: function(data) {
                    if(data == "") {
                        resetForm();
                        alert('Votre message a bien été envoyé. Merci');
                    } else {
                        alert(data);
                    }
                }
            });
        }

        function resetForm() {
            $('#contact')[0].reset();
        }

        $('.btn-valide').click(function() {
            controlForm();
        });
        $('.btn-reset').click(function() {
            resetForm();
        });
    });
</script>

</html>