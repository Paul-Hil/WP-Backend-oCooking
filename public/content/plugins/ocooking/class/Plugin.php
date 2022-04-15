<?php
namespace Ocooking;

class Plugin {

    /**
     * Constructeur de la classe Plugin.
     * rajoute les hooks pour créer les taxo et CPT.
     */
    public function __construct() {

        // appeler la fonction qui créé le CPT "recipe"
        add_action('init', [$this, 'createRecipeCustomPostType']);

        // appeler la fonction qui créé la taxonomie "ingredient"
        add_action('init', [$this, 'createIngredientTaxonomy']);

        // appeler la fonction qui créé la taxonomie "recipe-type"
        add_action('init', [$this, 'createRecipeTypeTaxonomy']);

    }

    /**
     * Rajoute un nouveau post type à WP.
     * Cette fonction doit être appelée par un hook, si possible lors de l'action 'init'
     */
    public function createRecipeCustomPostType() {

        // J'ajoute le type 'recipe' à Wordpress.
        register_post_type('recipe', 
        [
            'labels' => [
                'name'          => 'Recettes',
                'singular_name' => 'Recette',
                'add_new'       => 'Ajouter une recette',
                'not_found'     => 'Aucune recette trouvée',
                'edit_item'     => 'Modifier la recette'
            ],

            // On veut qu'il apparaissent dans le BO
            'public' => true,
            // Je veux que mes recettes apparaissent dans l'API fournie par WP
            'show_in_rest' => true,
            // Je personalise l'icone du CPT dans l'admin
            'menu_icon' => 'dashicons-carrot',

            // On demande à WP d'activer des fonctionnalités pour notre CPT
            'supports' => [
                'title',
                'thumbnail',
                'editor',
                'author',
            ],
        ]);

    }

    /**
     * Créé la taxonomie "Ingrédient" liée au CPT 'recipe'
     */
    public function createIngredientTaxonomy() {
        
        register_taxonomy(
            // identifiant de la taxonomy
            'ingredient',
            // la taxonomy 'ingredient" est utilisable avec le CPT 'recipe'
            ['recipe'],
            // tableau d'options
            [
                'label'         => 'Ingrédient',
                'hierarchical'  => false,
                'public'        => true,
                'show_in_rest'  => true,
            ]
        );

    }

    /**
     * Créé la taxonomie "recipe-type" liée au CPT 'recipe'
     */
    public function createRecipeTypeTaxonomy() {
        
        register_taxonomy(
            // identifiant de la taxonomy
            'recipe-type',
            // la taxonomy 'recipe-type" est utilisable avec le CPT 'recipe'
            ['recipe'],
            // tableau d'options
            [
                'label'         => 'Type de recette',
                'hierarchical'  => true,
                'public'        => true,
                'show_in_rest'  => true,
            ]
        );

    }

}