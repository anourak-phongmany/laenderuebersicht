<?php
// Wenn eine Suche durchgeführt wurde, holen wir die Daten
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $apiUrl = "https://restcountries.com/v3.1/name/$searchTerm";
} elseif (isset($_GET['country'])) {
    $countryName = $_GET['country'];
    $apiUrl = "https://restcountries.com/v3.1/name/$countryName";
} else {
    // Default: Alle Länder anzeigen
    $apiUrl = "https://restcountries.com/v3.1/all";
}

$response = file_get_contents($apiUrl);
$countries = json_decode($response);

// Header einbinden
include('includes/header.php');
?>

<div class="container mt-5">
    <h2 class="text-center">Suchergebnisse</h2>

    <div class="row">
        <?php if (!empty($countries)): ?>
            <?php foreach ($countries as $country): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?= $country->flags->png; ?>" class="card-img-top" alt="Flagge von <?= $country->name->common; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $country->name->common; ?></h5>
                            <p class="card-text">
                                <strong>Hauptstadt:</strong> <?= $country->capital[0] ?? 'Nicht verfügbar'; ?><br>
                                <strong>Region:</strong> <?= $country->region; ?><br>
                                <strong>Bevölkerung:</strong> <?= number_format($country->population); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Keine Länder gefunden, die deinen Kriterien entsprechen.</p>
        <?php endif; ?>
    </div>
</div>

<?php
// Footer einbinden
include('includes/footer.php');
?>
