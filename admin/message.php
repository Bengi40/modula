<?php
session_start();
require_once('../config.php');
require_once('../functions.php');

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
if($_SESSION['role'] == 'admin') {
	
?>
	<div class="wrapper">
		<h2>Administration</h2>

		<table id="contacts">
			<tr>
				<th>Date</th>
				<th>Heure</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			<?php
			while ($contacts = $statement->fetchObject()) {
				$lignes = "";
				$lignes .= "<tr>";
				$lignes .= '<td class="id" hidden>' . $contacts->id . '</td>';
				$lignes .= '<td>' . $contacts->date . '</td>';
				$lignes .= '<td>' . $contacts->heure . '</td>';
				$lignes .= '<td>' . $contacts->email . '</td>';
				$lignes .= '<td> <button type="button" class="info">Info</button> </td>';
				$lignes .= '</tr>';
				print $lignes;
			}
			?>
		</table>

		<div id="modale">
			<div class="modale">
				<span>Bonjour </span><span id="close">close</span>
				<div>
					<ul class="infoContact">
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php	
	} else{
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
			$("#modale").css("display", "block");
			idLigne = $(this).parent().parent().index();
			colonneTab = infoColonneId();
			idContact = colonneTab[idLigne];
			getMessage();
		});
		$('#close').click(function() {
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
								'<li>Nom : ' + result.nom + ' </li>'	
								+ '<li>Prénom : ' + result.prenom + ' </li>'
								+ '<li>email : ' + result.email + ' </li>'
								+ '<li>date : ' + result.date + ' </li>'
								+ '<li>heure : ' + result.heure + ' </li>'
								+ '<li>message : ' + result.message + ' </li>'
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