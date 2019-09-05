<?php
session_start();
include("config.php");
require("functions.php");

if (checkCredentials($_POST["username"], $_POST["password"])) {
    $_SESSION["connected"] = true;
    echo "connected";
}

// Redirect to parent page if this validation page has been called directly.
if (!isConnected()) {
    header("Location: " . $originUrl);
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Rainbow Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/4373a42e72.js"></script>
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
 
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h2>Filtre</h2>
			<form method="POST" action="./filtre.php">
				<div class="form-group">

					<label for="pseudo">
						Pseudo
					</label>
					<input type="text" class="form-control" id="pseudo" name="pseudo">
				</div>
				<div class="form-group">

					<label for="langue">
						Langue
					</label>
					<input type="text" class="form-control" id="langue" name="langue">
				</div>
				<div class="form-group">

					<label for="status">
						Statut
					</label>
					<select class="form-control" id="status" name="status">
					  <option></option>
					  <option>Connecté</option>
					  <option>Hors ligne</option>
					  <option>Supprimé</option>
					</select>
					<p class="help-block">Penser à adapter le select à vos besoins</p>
				</div>
				<div class="form-group">
					<label for="combinaison">
						Comment combiner les filtres
					</label>
					<select class="form-control" id="combinaison" name="combinaison">
					  <option></option>
					  <option>ET</option>
					  <option>OU</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">
					Filtrer
				</button>
			</form>
		</div>
		<div class="col-md-8">
			<table class="table table-striped">


				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Nom
						</th>
						<th>
							Prénom
						</th>
						<th>
							Pseudo
						</th>
						<th>
							Langue
						</th>
						<th>
							Statut
						</th>
					</tr>
				</thead>
				<tbody>
<?php
    $users = getUsersByFilters($_POST["pseudo"], $_POST["langue"], $_POST["status"], $_POST["combinaison"]);
    foreach ($users as $user) {
        echo "<tr>";
            echo "<td>" . $user["id"] . "</td>" . PHP_EOL;
            echo "<td>" . $user["nom"] . "</td>" . PHP_EOL;
            echo "<td>" . $user["prenom"] . "</td>" . PHP_EOL;
            echo "<td>" . $user["pseudo"] . "</td>" . PHP_EOL;
            echo "<td>" . $user["langue"] . "</td>" . PHP_EOL;
            echo "<td>" . $user["status"] . "</td>" . PHP_EOL;
        echo "</tr>";

    }
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2018-2019 William Gathoye</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy/RGPD</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
</body>
</html>
