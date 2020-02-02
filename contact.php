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
        <form method="post" id="contact" action="">
            <div class="form-group">
                <label>Nom* : </label>
                <input type="text" id="nom" name="nom" value="" require/>
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Prénom* : </label>
                <input type="text" id="prenom" name="prenom" value="" require/>
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Email* : </label>
                <input type="email" id="email" name="email" value="" require/>
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>Votre message* : </label>
                <textarea id="message" name="message" value="" require/></textarea>
                <span class="comment"></span>
            </div>
            <div class="form-group">
                <label>RGPD* : </label>
                <input type="checkbox" id="rgpd" name="rgpd" value="false" require/>
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

            var postData =  $("#contact").serialize();
            $.ajax({
                type: 'POST',
                url: 'includes/scripts/ajax/newMessage.php',
                data: postData,
                dataType: 'json',
                success: function(result) {
                    if(result.isValid) {
                        alert('Votre message a bien été envoyé. Merci');
                        resetForm();
                    } else {
                       $('#nom + .comment').html(result.nomErr);
                       $('#prenom + .comment').html(result.prenomErr);
                       $('#email + .comment').html(result.emailErr);
                       $('#message + .comment').html(result.messageErr);
                       $('#messrgpdage + .comment').html(result.rgpdErr);
                    }
                }
            });
        });
    });
 
    function resetForm() {
        $('#contact')[0].reset();
    }

</script>

</html>