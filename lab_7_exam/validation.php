<?php
require("config.php");

// Redirect to parent page if this validation page has been called directly.
$scheme = $_SERVER['REQUEST_SCHEME'] . '://';
$originUrl = $scheme . "hepl.lan";
if ($_SERVER['HTTP_ORIGIN'] !== $originUrl) {
    header("Location: " . $originUrl);
    exit();
}

// Let's validate the form
$lastName = $_POST["lastName"];
$firstName = $_POST["firstName"];
$dateBirth = $_POST["dateBirth"];
$address = $_POST["address"];
$postalCode = $_POST["postalCode"];
$location = $_POST["location"];
$lines = $_POST["lines"];
$columns = $_POST["columns"];
$pixelSize = $_POST["pixelSize"];

$errors = array();

if (!preg_match('/^[A-Za-z]+$/i', $lastName)) {
    $errors[] = "lastName";
}

if (!preg_match('/^([A-Za-z]+|[A-Za-z]+-[A-Za-z]+)$/i', $firstName)) {
    $errors[] = "firstName";
}

$datetime1 = new DateTime($dateBirth);
$datetime2 = new DateTime("1900-01-01");
if ($datetime1 <= $datetime2) {
    $errors[] = "dateBirth";
}
$datetime2 = new DateTime(date("Y-m-d"));
if ($datetime1 >= $datetime2) {
    if (!in_array("dateBirth", $errors)) {
        $errors[] = "dateBirth";
    }
}

// Only check the regex if the address is present
// (using short circuit language method).
if (!empty($address) && !preg_match('/^[:print:]+$/i', $address)) {
    $errors[] = "address";
}

// Only check the postal code if it is defined
// (using short circuit language method).
if (!empty($postalCode) && !preg_match('/^([0-9]{4})|B[0-9]{4})$/', $postalCode)) {
    $errors[] = "postalCode";
}


if ($lines < 1 || $lines > $MAX_RAINBOW_TABLE_SIZE) {
    $errors[] = "lines";
}

if ($columns < 1 || $columns > $MAX_RAINBOW_TABLE_SIZE) {
    $errors[] = "columns";
}

if ($pixelSize < 1 || $pixelSize > 10) {
    $errors[] = "pixelSize";
}

if (!empty($errors)) {
    $queryString = "?invalid=";
    $queryString .= json_encode($errors);
    header("Location: " . $originUrl . $queryString);
    exit();
}

$age = $datetime2->diff($datetime1)->y;

$infoConcat = 
    $lastName .
    $firstName .
    $dateBirth .
    $address .
    $postalCode .
    $location .
    $lines .
    $columns .
    $pixelSize;

$hash = password_hash($infoConcat, PASSWORD_DEFAULT);

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
    <h2>Hello!</h2>
    <p class="lead">Bonjour, <?php echo $firstName . " " . $lastName . ", vous êtes âgé de " . $age . " ans." ?></p>
  </div>

  <div class="row">
    <div class="col-md-12">

    <p>Le hash généré à partir de vos informations est <?php echo $hash ?>.</p>
    <table>
<?php
for ($i = 0; $i < $lines; $i++) {

    echo "<tr>";
    for ($j = 0; $j < $columns; $j++) {
        echo "<td style=\"background-color: rgb(" . ceil(255 / $lines * $i) . ", " . ceil(255 / $columns * $j) . ", " . ceil(255 / $lines / $columns * $i * $j) . "); width: " . $pixelSize . "px; height: " . $pixelSize ."px\"></td>";

    }

    echo "</tr>";
}
?>
    </table>

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
