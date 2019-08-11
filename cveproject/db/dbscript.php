<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//var_dump($_POST);
//INITIATE SESSION
session_start();
require('streetcreds.php');
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$res= pg_get_result($db);


 $OrgName = filter_input(INPUT_POST, 'OrgName', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $descr = filter_input(INPUT_POST, 'descr', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $prov = filter_input(INPUT_POST, 'prov', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 $postal = filter_input(INPUT_POST, 'postal', FILTER_SANITIZE_STRING);
 $lats = filter_input(INPUT_POST, 'lat', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $longs = filter_input(INPUT_POST, 'long', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
 $website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
 //Removes special characters
 $tel = preg_replace('/[^0-9+-]/', '', $_POST['tel']);

//Convert multiselect to a string
 $serv = implode("; ", $_POST['sel2']);


//CHECK for DUPLICATE LAT/longs
$checkDups = "SELECT *  FROM cvetable WHERE latitude = $lats AND longitude =$longs";
$result = pg_query($db, $checkDups);

//CHECK if point is within Europe
$euroquery = "SELECT mergeval FROM wish_europe_bouds WHERE ST_Contains(geom,ST_SetSRID(ST_MakePoint($longs,$lats),4326))";
$euroresult = pg_query($db, $euroquery);
$containResult = pg_fetch_all($euroresult);

//Validate not a duplicate in database then insert form
if (pg_affected_rows($result) == 0) {
  //Validate within Europe
  if($containResult[0]['mergeval'] == 1){
    ///INSERT FORM
    $params = array($OrgName, $descr, $country, $city, $prov, $address, $postal, $lats, $longs, $email, $tel, $serv, $website);
    print_r($params);
    $query = "INSERT INTO cvetable (orgname, description, country, city, province, address, postal_code, latitude, longitude, email, phone, service_category, geom, website) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,ST_SetSrid(ST_MakePoint($9, $8),4326),$13)";

    $result= pg_query_params($db, $query, $params);
    $affected_rows = pg_affected_rows($result);


    if($affected_rows===0)
    {
      echo "There was an error saving to the database.";
    }
    else
    {
      $_SESSION["dupcheck"]='success';
      header('Location: ../index.php');
    }
  }
  else{
    $_SESSION["euroCheck"]='notContained';
    header('Location: ../index.php');
  }
//Else provide error notice to user
}else {
    $_SESSION["dupcheck"]='duplicate';
    header('Location: ../index.php');
  }

?>
