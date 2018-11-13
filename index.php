<?php
	require 'cnx.php';
	$prenoms = array('Arthur', 'Arnaud', 'Aubin', 'Ariel', 'Charly', 'Eve', 'Estelle', 'Mathieu');
	$datas = $cnx->query("SELECT * FROM choice ORDER by id DESC")->fetchAll(); 
	if(empty($datas)){
		for ($i = 0; $i < count($prenoms); $i++) { 
			$q = array('id' => $i + 1, 'name' => $prenoms[$i]);
			$sql = "INSERT INTO choice (id, name) VALUES (:id, :name)";
			$req_1 = $cnx->prepare($sql);
			$req_1->execute($q);	
		}
	} else {
		$id_array = array();
		for ($i= 0 ; $i < count($datas); $i++) { 
			array_push($id_array, intval($datas[$i]['id']));
		}
		$id = array_rand($id_array, 1);

		$q = array('id' => $id_array[$id]);
		$sql = "SELECT name FROM choice WHERE id = :id";
		$req_2 = $cnx->prepare($sql);
		$req_2->execute($q);
		$data = $req_2->fetch();

		$q = array('id' => $id_array[$id]);
		$sql = "DELETE FROM choice WHERE id = :id";
		$req_3 = $cnx->prepare($sql); 
		$req_3->execute($q);	
	}
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
					if(is_null($data['name'])){
						echo "Vous êtes arrivé à la fin de la liste, rechargez la page pour en générer une nouvelle.";
					} else {
						echo $data['name'];
					}
				?>
			</span>
			<button id="reload">
				<i class="fas fa-sync-alt"></i>
			</button>
		</header>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>
