<?php
include 'connexion_bdd.php';
include 'translations.php';

$id = $_GET['id'] ?? 1;
$lang = $_GET['lang'] ?? 'en';

$next_id = $id + 1;
$prev_id = $id - 1;

$query = "SELECT * FROM pokemon WHERE id=$id";
$result = $conn->query($query);
$pokemon = $result->fetch(PDO::FETCH_ASSOC);

$query = "SELECT * FROM pokemon WHERE id=$next_id";
$result = $conn->query($query);
$next_pokemon = $result->fetch(PDO::FETCH_ASSOC);

$query = "SELECT * FROM pokemon WHERE id=$prev_id";
$result = $conn->query($query);
$prev_pokemon = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $translations[$lang]['pokemon'] ?>: <?= ucfirst($pokemon['nom']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="language-selector">
            <a href="?id=<?= $id ?>&lang=fr">FR</a> | <a href="?id=<?= $id ?>&lang=en">EN</a>
        </div>
        <a href="index.php?lang=<?= $lang ?>" class="back-btn"><?= $translations[$lang]['back'] ?></a>
        <div class="pokemon-details  <?= $pokemon['type1'] ?>">
            <img src="<?= $pokemon['image_url'] ?>" alt="<?= $pokemon['nom'] ?>">
            <h1><?= ucfirst( $translations[$lang]['pokemon_names'][$pokemon['nom']] ?? $pokemon['nom']) ?></h1>
            <ul>
                <li><strong><?= $translations[$lang]['type'] ?>:</strong> <?= ucfirst($translations[$lang]['type_names'][$pokemon['type1']]) . ($pokemon['type2'] ? ' / '.ucfirst($translations[$lang]['type_names'][$pokemon['type2']]) : '') ?></li>
                <li><strong><?= $translations[$lang]['total'] ?>:</strong> <?= $pokemon['total'] ?></li>
                <li><strong><?= $translations[$lang]['hp'] ?>:</strong> <?= $pokemon['hp'] ?></li>
                <li><strong><?= $translations[$lang]['attack'] ?>:</strong> <?= $pokemon['attack'] ?></li>
                <li><strong><?= $translations[$lang]['defense'] ?>:</strong> <?= $pokemon['defense'] ?></li>
                <li><strong><?= $translations[$lang]['sp_atk'] ?>:</strong> <?= $pokemon['sp_atk'] ?></li>
                <li><strong><?= $translations[$lang]['sp_def'] ?>:</strong> <?= $pokemon['sp_def'] ?></li>
                <li><strong><?= $translations[$lang]['speed'] ?>:</strong> <?= $pokemon['speed'] ?></li>
                <li><strong><?= $translations[$lang]['generation'] ?>:</strong> <?= $pokemon['generation'] ?></li>
                <li><strong><?= $translations[$lang]['legendary'] ?>:</strong> <?= $pokemon['legendary'] ? $translations[$lang]['yes'] : $translations[$lang]['no'] ?></li>
            </ul>
        </div>
        
    </div>
    <div class="navigation-buttons">
    <?php if ($prev_pokemon): ?>
        <a href="pokemon.php?id=<?= $prev_id ?>&lang=<?= $lang ?>" class="navigation-card <?= $prev_pokemon['type1'] ?>">
            <img src="<?= $prev_pokemon['image_url'] ?>" alt="<?= $prev_pokemon['nom'] ?>" width="50">
            <?= $translations[$lang]['prev_pokemon'] ?>
        </a>
    <?php endif; ?>

    <?php if (!$prev_pokemon): ?>
        <a>
        </a>
    <?php endif; ?>

    <?php if ($next_pokemon): ?>
        <a href="pokemon.php?id=<?= $next_id ?>&lang=<?= $lang ?>" class="navigation-card <?= $next_pokemon['type1'] ?>">
            <img src="<?= $next_pokemon['image_url'] ?>" alt="<?= $next_pokemon['nom'] ?>" width="50">
            <?= $translations[$lang]['next_pokemon'] ?>
        </a>
    <?php endif; ?>
</div>
</body>
</html>
