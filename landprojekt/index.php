<?php
// Header einbinden
include('includes/header.php');
$landapiurl="https://restcountries.com/v3.1/region/europe";

$result=file_get_contents($landapiurl);
$laender=json_decode($result);

?>

<div class="container mt-5">
    <h2 class="text-center">Länderübersicht</h2>

    <!-- Suchformular -->
    <form action="search.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Nach Ländern suchen" required>
            <button class="btn btn-primary" type="submit">Suchen</button>
        </div>
    </form>

    <!-- Länderauflistung -->
    <div class="row">
      <?php
		foreach($laender as $land){
			$bild= $land->flags->png;
			$landname = $land->name->common;
			$hauptstadt = $land->capital[0]; //$hauptstadt=implode($land['capital']);
			$region =$land->region;
			$bevolkerung = number_format($land->population);
			
	  ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="<?= $bild;?>" class="card-img-top" alt="Flagge von ">
                    <div class="card-body">
                        <h5 class="card-title"><?= $landname;?></h5>
                        <p class="card-text">
                            <strong>Hauptstadt:</strong> <?= $hauptstadt;?><br>
                            <strong>Region:</strong><?= $region;?><br>
                            <strong>Bevölkerung:</strong><?= $bevolkerung;?>
                        </p>
                        <a href="land.php?landname=<?php echo $landname;?>" class="btn btn-primary">Mehr Information</a>
                    </div>
                </div>
            </div>
	<?php
		}
	?>
	


	
	
       
    </div>
</div>

<?php
// Footer einbinden
include('includes/footer.php');
?>
