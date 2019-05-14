<?php
session_start();

include("config.php");
require("functions.php");
if (isConnected()) {
    header("Location: " . $filterUrl);
    exit();
}
// var_dump($_SESSION["connected"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Connect form</title>
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
 
<body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <h2>Restricted area</h2>
    <p class="lead">Please connect.</p>
  </div>

  <div class="row">
    <div class="col-md-12">
<?php

if (!empty($_GET["invalid"])) {
?>
<div class="alert alert-danger">
<strong>Warning!</strong>
<?php
    $errors = json_decode($_GET["invalid"]);
    if (count($errors) > 1) {
        echo "Les champs ";
    } else {
        echo "Le champ ";
    }
    echo implode(", ", $errors);
    if (count($errors) > 1) {
        echo " sont invalides.";
    } else {
        echo " est invalide.";
    }
?>
</div>
<?php
}
?>



      <form action="./filtre.php" method="post" class="needs-validation" novalidate>
        <h4 class="mb-3">Login area</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="lastName">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="firstName">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>

        <hr class="mb-4">
        <p class="text-muted">* You need to be a site admin to connect.</p>
        <button class="btn btn-primary btn-lg float-right col-md-3" type="submit">Connect</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </form>
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
