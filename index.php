<?php
include 'connexion_bdd.php';
include 'translations.php';

$lang = $_GET['lang'] ?? 'en';

$query = "SELECT * FROM pokemon";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " WHERE nom LIKE '%$search%' OR nom_fr LIKE '%$search%'";
}
$result = $conn->query($query);
$pokemons = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $translations[$lang]['title'] ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="language-selector">
            <a href="?lang=fr">FR</a> | <a href="?lang=en">EN</a>
        </div>
        <h1><?= $translations[$lang]['title'] ?></h1>
        <div class="search-container">
            <form action="index.php" method="get">
                <input type="text" name="search" placeholder="<?= $translations[$lang]['search_placeholder'] ?>" class="search-input">
                <button type="submit" class="search-button"><?= $translations[$lang]['search'] ?></button>
            </form>
        </div>
        <section class="pokemon-grid">
            <?php foreach ($pokemons as $pokemon) : ?>
                <article class="pokemon-card type-<?= $pokemon['type1'] ?>" onmouseover="changeBackground('<?= $pokemon['type1'] ?>')" onmouseout="changeBackground('default')">
                    <a href="pokemon.php?id=<?= $pokemon['id'] ?>&lang=<?= $lang ?>">
                        <img src="<?= $pokemon['image_url'] ?>" alt="<?= $pokemon['nom'] ?>">
                        <h2><?= ucfirst($translations[$lang]['pokemon_names'][$pokemon['nom']] ?? $pokemon['nom']) ?></h2>
                    </a>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
    <script>
        const typeColors = {
    'default': '#F2F2F2',
    'normal': '#A8A77A',
    'fire': '#EE8130',
    'water': '#6390F0',
    'electric': '#F7D02C',
    'grass': '#7AC74C',
    'ice': '#96D9D6',
    'fighting': '#C22E28',
    'poison': '#A33EA1',
    'ground': '#E2BF65',
    'flying': '#A98FF3',
    'psychic': '#F95587',
    'bug': '#A6B91A',
    'rock': '#B6A136',
    'ghost': '#735797',
    'dragon': '#6F35FC',
    'dark': '#705746',
    'steel': '#B7B7CE',
    'fairy': '#D685AD'
};

function changeBackground(type) {
    document.body.style.backgroundColor = typeColors[type];
}
    </script>
</body>
</html>
