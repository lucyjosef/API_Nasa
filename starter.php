<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 17/01/18
 * Time: 10:30
 */

include_once 'NasaAdapter.php';
include_once 'NasaAPI.php';

$my_instance = new NasaAPI();

//Choose the API u want :
echo "Choisissez votre API !\n1 pour les astéroïdes\n";
NasaAPI::$choice_u_made = readline("2 pour l'article du jour !\n");
$my_instance->choose_API(NasaAPI::$choice_u_made);

if(NasaAPI::$choice_u_made === "1") {
    $asteroid_object = new NasaAdapter('NasaAPI', 'data');
    $asteroid_array = $asteroid_object->fromJson();
    $nasa_asteroid = $asteroid_object->get_asteroid_description($asteroid_array);
    print($nasa_asteroid);
}
elseif (NasaAPI::$choice_u_made === "2") {
    $nasa_adapter = new NasaAdapter('NasaAPI', 'data');
    $nasa_array = $nasa_adapter->fromJson();
    $nasa_content = NasaAPI::get_article($nasa_array);
    print($nasa_content);
}
else {
    echo "Saisissez 1 pour les astéroïde ou 2 pour l'article du jour\n";
}
?>