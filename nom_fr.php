<?php
include 'connexion_bdd.php';

// Nombre de pokémons à récupérer
$pokemonCount = 151;  // Mettez ici le nombre de pokémon que vous voulez récupérer

for ($i = 1; $i <= $pokemonCount; $i++) {
    $apiUrl = "https://pokeapi.co/api/v2/pokemon-species/$i/";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    foreach ($data['names'] as $name) {
        if ($name['language']['name'] == 'fr') {
            $frenchName = $name['name'];

            // Update the pokemon in the database
            $query = "UPDATE pokemon SET nom_fr = :nom_fr WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nom_fr', $frenchName);
            $stmt->bindParam(':id', $i);
            $stmt->execute();

            break;
        }
    }
}
?>