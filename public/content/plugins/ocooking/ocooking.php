<?php
/**
 * Plugin Name: O'cooking
 */

// On précise qu'on l'on va utiliser la classe plugin
use Ocooking\Plugin;

// On charge le système de chargement automatique de classes de Composer
require __DIR__ . '/vendor-ocooking/autoload.php';

// On instancie notre plugin !
$ocooking = new Plugin();