<?php
$landname=$_GET['landname'];

$apiurl="https://restcountries.com/v3.1/name/".$landname."?fullText=true";
$landinfo = file_get_contents($apiurl);


$landjson=json_decode($landinfo);

foreach($landjson as $land){
//die Info
$bild= $land->flags->png;
$landname = $land->name->common;
$hauptstadt = $land->capital[0]; //$hauptstadt=implode($land['capital']);
$region =$land->region;
$bevolkerung = number_format($land->population);
$flaeche = number_format($land->population). "km²";
$karteadress = $land->maps->googleMaps;
}

/*
$bild= $landjson['flags']['png'];
$landname = $landjson['name']['common'] ;
$hauptstadt = $landjson['capital'][0]; //$hauptstadt=implode($land['capital']);
$region =$landjson['region'];
$bevolkerung = number_format($landjson['population'], 0, ',', '.');
$flaeche = number_format($landjson['area'], 0, ',', '.'). "km²";
$karteadress=$landjson['maps']['googleMaps'];
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $landname;?> Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <!-- Back button -->
    <a href="index.php" class="btn btn-secondary mb-4">&larr; Zurück zur erste Seite</a>

    <!-- Country Info Card -->
    <div class="card shadow-sm">
      <div class="row g-0">
        <!-- Flag -->
        <div class="col-md-4">
          <img src="<?php echo $bild;?>" class="img-fluid rounded-start" >
        </div>
        <!-- Info -->
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title"><?php echo $landname;?></h3>
            <p class="card-text"><strong>Region:</strong> <?php echo $region;?></p>
            <p class="card-text"><strong>Hauptstadt:</strong> <?php echo $hauptstadt;?></p>
            <p class="card-text"><strong>Bevolkerung:</strong> <?php echo $bevolkerung;?></p>
            <p class="card-text"><strong>Fläche:</strong> <?php echo $flaeche;?></p>
            <p class="card-text">
              <strong>Karte:</strong><br>
              <a href="<?php echo $karteadress;?>" target="_blank">Google Maps</a> |
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
