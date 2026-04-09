<?php
$BASE_URL = 'https://fakestoreapi.com/';

function getAll(): array {
    global $BASE_URL;
    $api_response = file_get_contents($BASE_URL . 'products');
    
    return json_decode($api_response, true) ?? [];
}

function getProductFromId($id_prod) {
    global $BASE_URL;
    $api_response = file_get_contents($BASE_URL . 'products/' . $id_prod);
    
    // Retornem l'array ja processat
    return json_decode($api_response, true);
}