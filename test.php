<?php
use Dao\MeasureDao;

include 'inc/autoload.inc';
?>
<?php
$config = include 'inc/config.inc';
$MeasureDao = new MeasureDao($config);
$test = $MeasureDao->insert('11', '40', '06/02/18');



?>