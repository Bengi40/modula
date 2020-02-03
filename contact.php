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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="wrapper">
        <form method="post" id="contact" action="">
            <div class="form-group">
                <label>Nom* : </label>
                <input type="text" id="nom" name="nom" require />
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Prénom* : </label>
                <input type="text" id="prenom" name="prenom" require />
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Email* : </label>
                <input type="email" id="email" name="email" require />
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Votre message* : </label>
                <textarea id="message" name="message" require /></textarea>
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label for="rgpd">RGPD* : </label>
                <input type="checkbox" id="rgpd" name="rgpd" require />
                <span class="comment"></span>
            </div>

            <div class="form-group">
                <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfBTNUUAAAAANyDYeLK6McFxHpgtTg_jC02vabY"></div>
                <span class="comment"></span>
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
    $(function() {

        $('#contact').submit(function(e) {
            e.preventDefault();
            $('.comment').empty();

            if ($('#rgpd').is(':checked')) {
                var postData = $('#contact').serialize();
        
                $.ajax({
                    type: 'POST',
                    url: 'includes/scripts/ajax/newMessage.php',
                    data: postData,
                    dataType: 'json',
                    success: function(result) {
                        if (result.isValid) {
                            alert('Votre message a bien été envoyé. Merci');
                            resetForm();
                        } else {
                            $('#nom + .comment').html(result.nomErr);
                            $('#prenom + .comment').html(result.prenomErr);
                            $('#email + .comment').html(result.emailErr);
                            $('#message + .comment').html(result.messageErr);
                            $('#recaptcha + .comment').html(result.recaptchaErr);
                        }
                    }             
                });
            } else {
                $('#rgpd + .comment').html("Merci de valider les conditions");
            }
        });
    });

    function resetForm() {
        $('#contact')[0].reset();
    }
</script>

</html>