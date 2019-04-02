<?php
require("config.php");
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
 
<body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <h2>Rainbow table form!</h2>
    <p class="lead">Please fill in this beautiful form.</p>
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


      <form action="./validation.php" method="post" class="needs-validation" novalidate>
        <h4 class="mb-3">Signalétique</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="dateBirth">Date of birth<span class="text-muted">*</span></label>
            <div class="input-group">
            <input type="date" class="form-control" id="dateBirth" name="dateBirth" placeholder="Date of birth" min="1900-01-01" max="<?php echo $currentDate_iso8601 ?>" value="1992-12-17" required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                  </div>
                <div class="invalid-feedback" style="width: 100%;">
                  Your date of birth is required.
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="address">Street, number <span class="text-muted">(Optional)</span></label>
            <div class="input-group">
              <input type="text" class="form-control" id="address" name="address" placeholder="Rue Peetermans 80">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="postalCode">Code postal <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="" value="">
          </div>
          <div class="col-md-6 mb-3">
            <label for="location">Location <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="location" name="location" placeholder="" value="">
          </div>
        </div>

        <h4 class="mb-3">Rainbow Table</h4>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="lines">Lines</label>
            <div class="input-group">
            <input type="number" class="form-control" id="lines" name="lines" placeholder="25" min="0" max="<?php echo $MAX_RAINBOW_TABLE_SIZE ?>" value="10" required>
              <div class="invalid-feedback">
                Please enter a valid number of lines.
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="columns">Columns</label>
            <div class="input-group">
            <input type="number" class="form-control" id="columns" name="columns" placeholder="25" min="0" max="<?php echo $MAX_RAINBOW_TABLE_SIZE ?>" value="10" required>
              <div class="invalid-feedback">
                Please enter a valid number of columns.
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12 mb-3">
            <label for="pixelSize">Size in pixels of a cell <span class="text-muted">(Optional)</span></label>
            <select class="form-control" id="pixelSize" name="pixelSize">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option selected>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
            </select>
          </div>
        </div>

        <hr class="mb-4">
        <p class="text-muted">* You need to be at least 13 years old to register.</p>
        <button class="btn btn-primary btn-lg float-right col-md-3" type="submit">Register</button>
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
