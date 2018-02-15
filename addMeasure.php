<?php
use Dao\MeasureDao;
use Services\MeasureService;
use Domain\Measure;

include 'inc/autoload.inc';
?>

<?php
$config = include 'inc/config.inc';
$MeasureDao = new MeasureDao($config);
$MeasureService = new MeasureService();

$validationErrors = [];
$temperature = "";
$humidity = "";
$datetime = "";

if (!empty($_POST)) {
    
    $temperature = $_POST["temperature"];
    $humidity = $_POST["humidity"];
    $datetime = $_POST["datetime"];
    
    $test = new Measure(null, $temperature, $humidity, $datetime);
    
    $validationErrors = $MeasureService->isValid($test);
    
    if (empty($validationErrors)) {
        
        $MeasureDao->insert($test);
            
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Formulaire test envoi</title>
<link rel="stylesheet" href="main.css">
</head>
<body>

<h1>Simulation du NodeMCU</h1>
<p>Ce formulaire permet de tester l'envoi d'une température vers le serveur comme le ferait le NodeMCU.</p>

<form action="addMeasure.php" method="post">
Température : <input type="text" name="temperature" placeholder="valeur numérique" value="<?php echo $temperature;?>">
<br/>
Humidité: <input type="text" name="humidite" placeholder="valeur numérique" value="<?php echo $humidity;?>">
<br/>
Datetime: <input type="text" name="date" placeholder="valeur numérique" value="<?php echo $datetime;?>">
<input type="submit" value="Envoyer">
</form>

</body>
</html>

