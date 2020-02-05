<?php
session_start();
require_once('../config.php');
require_once('../functions.php');

$_SESSION['role'] = "admin";

$db = Database::connect();
$statement = $db->query('
			SELECT 	id,date,heure,email
			FROM contacts
			ORDER BY date DESC,heure DESC
		');
$statement->execute();
Database::disconnect();

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>

	<link rel="stylesheet" href="includes/styles/style.css">

</head>

<body>
	<?php
	if ($_SESSION['role'] == 'admin') {

	?>
		<div class="wrapper">
			<div class="container">
				<header>
					<h2>Vos Messages</h2>
				</header>
				<div class="granit-divider "></div>
				<section>
					<table id="contacts">
						<tr>
							<th class="date">Date</th>
							<th class="heure">Heure</th>
							<th class="email">Email</th>
							<th class="action">Action</th>
						</tr>
						<?php
						while ($contacts = $statement->fetchObject()) {

							$lignes = '';
							$lignes .= '<tr class="contact">';
							$lignes .= '<td class="id" hidden>' . $contacts->id . '</td>';
							$lignes .= '<td class="date">' . $contacts->date . '</td>';
							$lignes .= '<td class="heure">' . $contacts->heure . '</td>';
							$lignes .= '<td class="email">' . $contacts->email . '</td>';
							$lignes .= '<td class="action"> <button type="button" class="info btn-view">Détail</button> </td>';
							$lignes .= '</tr>';
							print $lignes;
						}
						?>
					</table>
				</section>

			</div>
			<div id="modale">
				<div class="modale">
					<div id="modale-header">
						<h2>Détail contact</h2>
						<span class="btn-reset close">Close</span>
					</div>
					<div class="granit-divider "></div>
					<div class="infoContact">
						
					</div>
				</div>
			</div>
		</div>

	<?php
	} else {
		print('vous n\'avez pas le droit d\'être ici');
	}
	?>
</body>

<script src="includes/scripts/js/jquery.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var idContact = 0;
		var idLigne = 0;
		var colonneTab = [];

		$('.info').click(function() {
			$('.infoContact').empty();
			$("#modale").css("display", "flex");
			idLigne = $(this).parent().parent().index();
			colonneTab = infoColonneId();
			idContact = colonneTab[idLigne];
			getMessage();
		});
		$('.close').click(function() {
			$("#modale").css("display", "none");
		});

		function infoColonneId() {
			var tab = [];
			$('#contacts tr').each(function() {
				var id = $(this).find('td').eq(0).html();
				tab.push(id);
			});
			return tab;
		}

		function getMessage() {
			if (idContact != 0) {
				$.ajax({
					type: 'POST',
					url: 'includes/scripts/ajax/viewMessage.php',
					data: {
						id: idContact
					},
					dataType: 'json',
					success: function(result) {
						if (result) {
							$('#modale .infoContact').append(

								'<div id="detail">' +
									'<div class="detail-nom">Mr ou Mme ' + result.nom + ' ' + result.prenom + '</div>' +
									'<div class="detail-date">Le ' + result.date + ' à '  + result.heure + '</div>' +
								'</div>' +
								'<div class="detail-email">'+ result.email +'</div>' +
								'<div class="detail-message">'+
								'	<div>Message :</div>' +
								'	<div> ' + result.message + '</div>' +
								'</div>'
							)
						}
					},
					error: function(err) {
						alert(err.responseText);
					}
				});
			}
		}
	});
</script>

</html>