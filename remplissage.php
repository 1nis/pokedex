<?php

$host = 'localhost';
$db = 'db';
$username = 'username';
$password = 'password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $url = 'https://pokeapi.co/api/v2/pokemon?limit=151';
    $response = file_get_contents($url);
    $data = json_decode($response);

    $stmt = $conn->prepare('INSERT INTO pokemon (id, nom, type1, type2, total, hp, attack, defense, sp_atk, sp_def, speed, generation, image_url) 
    VALUES (:id, :nom, :type1, :type2, :total, :hp, :attack, :defense, :sp_atk, :sp_def, :speed, :generation, :image_url)');

    foreach ($data->results as $pokemon) {
        $pokeUrl = $pokemon->url;
        $pokeResponse = file_get_contents($pokeUrl);
        $pokeData = json_decode($pokeResponse);

        $id = $pokeData->id;
        $nom = $pokeData->name;
        $type1 = $pokeData->types[0]->type->name;
        $type2 = isset($pokeData->types[1]) ? $pokeData->types[1]->type->name : null;
        $total = array_sum(array_column($pokeData->stats, 'base_stat'));
        $hp = $pokeData->stats[0]->base_stat;
        $attack = $pokeData->stats[1]->base_stat;
        $defense = $pokeData->stats[2]->base_stat;
        $sp_atk = $pokeData->stats[3]->base_stat;
        $sp_def = $pokeData->stats[4]->base_stat;
        $speed = $pokeData->stats[5]->base_stat;
        $generation = substr($pokeData->species->url, -2, 1); // This might need adjustment depending on API response
        $image_url = $pokeData->sprites->front_default;

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':type1', $type1);
        $stmt->bindParam(':type2', $type2);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':hp', $hp);
        $stmt->bindParam(':attack', $attack);
        $stmt->bindParam(':defense', $defense);
        $stmt->bindParam(':sp_atk', $sp_atk);
        $stmt->bindParam(':sp_def', $sp_def);
        $stmt->bindParam(':speed', $speed);
        $stmt->bindParam(':generation', $generation);
        $stmt->bindParam(':image_url', $image_url);

        $stmt->execute();
    }

    echo "Les données Pokémon ont été insérées avec succès.";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;

?>
