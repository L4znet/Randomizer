<?php
	require 'cnx.php';

	$prenoms = array('Arthur', 'Arnaud','Aubin', 'Ariel', 'Charly', 'Eve', 'Estelle', 'Mathieu', 'Titouan');
	$already_choose = array();
	$choix = rand(0, count($prenoms));

    $q = array('name' => $prenoms[$choix]);
    $req = $cnx->prepare("INSERT INTO already_choose (name) VALUES (:name)");
    $req->execute($q);

    $rand = $cnx->query("SELECT * FROM already_choose ORDER BY id DESC LIMIT 2")->fetchAll();   
?>

<html>
<head>
	<title>Randomizer</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<meta charset="UTF-8">
</head>
	<body>
		<header>
			<span>C'est au tour de...</span>
			<span>
				<?php
					if($rand[0]['name'] == $rand[1]['name']){
						if($rand[0]['name'] == "Estelle" || $rand[0]['name'] == "Eve"){
							$pronom = "elle";
						} else {
							$pronom = "il";
						}
						echo $rand[0]['name'] . ' mais ' . $pronom .' a déjà été sélectionné lors du dernier tirage au sort.';
					} else {
						echo $rand[0]['name'];
					}
				?>
			</span>
		</header>
		<section>
			<button id="reload">
				<i class="fas fa-sync-alt"></i>
			</button>
		</section>
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>
