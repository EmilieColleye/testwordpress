<?php

require_once(__DIR__.'./menus/PrimaryMenuWalker.php');
require_once(__DIR__.'./menus/PrimaryMenuItem.php');

// Désactiver l'éditeur "Gutenberg" de Wordpress
add_filter('use_block_editor_for_post', '__return_false');

// Activer les images sur les articles
add_theme_support('post-thumbnails');

// Enregistrer un seul custom post-type pour "nos voyages"
register_post_type('trip', [
    'label' => 'Voyages',
    'labels' => [ 'name' => 'Voyages', 'singular_name' => 'Voyage',
    ],
    'description' => 'Tous les articles qui décrivent un voyage',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-palmtree',
    'supports' => ['title','editor','thumbnail'],
    'rewrite' => ['slug' => 'voyages'],
]);

// Récupérer les trips via une requête Wordpress
function dw_get_trips($count = 20)
{
    // 1. on instancie l'objet WP_Query
    $trips = new WP_Query([
        'post_type' => 'trip',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $count,
    ]);

    // 2. on retourne l'objet WP_Query
    return $trips;
}

//enregistrer les menus de navigation
register_nav_menu('primary', 'emplacement de la navigation principale de haut de page');
register_nav_menu('footer', 'emplacement de la navigation en pied de page');

//définition de la fonction retournant un menu de navigation sous forme d'un tableau de lien de niveau 0
function dw_get_menu_items($location){
    $items = [];
    // récupérer le menu qui correspond à l'emplacement souhaité
    $locations = get_nav_menu_locations();

    // permet de dire est-ce que ce qui précède existe et n'est pas null alors on utilise la 1ere valeur sinon (si la clé n'existe pas) c'est null qui est utilisé

    if($locations[$location] ?? null){
        $menu = $locations[$location];

        // récupérer tous les éléments du menu en question
        $posts = wp_get_nav_menu_items($menu);

        // traiter chaque élément de menu pour le transformer en objet
        foreach ($posts as $post){
            //Créer une instance d'unobjet personnalisé à partir de $post
            $item = new PrimaryMenuItem($post);
            //Ajoute rune instance soit à $items (s'il s'agit d'un élément de niveau 0), soit en tant que sous élément d'un item déjà existant
            if($item->isSubItem()){
                //ajouter l'instance
            } else {
                $items[]=$item;
            }
        }
    }

    // retourner les éléments de menu de niveau 0
    return $items;
}