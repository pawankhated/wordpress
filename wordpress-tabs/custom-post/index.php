function work_post_type() {
    $labels = array(
        'name'                => _x( 'Portfolio', 'Post Type General Name', 'gitlocalization' ),
        'singular_name'       => _x( 'portfolio', 'Post Type Singular Name', 'gitlocalization' ),
        'menu_name'           => __( 'portfolio', 'gitlocalization' ),
        'parent_item_colon'   => __( 'Parent portfolio', 'gitlocalization' ),
        'all_items'           => __( 'All portfolio', 'gitlocalization' ),
        'view_item'           => __( 'View portfolio', 'gitlocalization' ),
        'add_new_item'        => __( 'Add New portfolio', 'gitlocalization' ),
        'add_new'             => __( 'Add New', 'gitlocalization' ),
        'edit_item'           => __( 'Edit portfolio', 'gitlocalization' ),
        'update_item'         => __( 'Update portfolio', 'gitlocalization' ),
        'search_items'        => __( 'Search portfolio', 'gitlocalization' ),
        'not_found'           => __( 'Not Found', 'gitlocalization' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'gitlocalization' ),
    );
     
    $args = array(
        'label'               => __( 'portfolio', 'gitlocalization' ),
        'description'         => __( 'Portfolio', 'gitlocalization' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest'        => true,
        'taxonomies'  => array( 'categories' ),
    );
    register_post_type( 'portfolio', $args );
 
}
add_action( 'init', 'portfolio_post_type', 0 );
function portfolio_register() {   
$labels = array( 
    'name' => _x('Portfolio', 'post type general name'), 
    'singular_name' => _x('Portfolio Item', 'post type singular name'), 
    'add_new' => _x('Add New', 'portfolio item'), 
    'add_new_item' => __('Add New Portfolio Item'), 
    'edit_item' => __('Edit Portfolio Item'), 
    'new_item' => __('New Portfolio Item'), 
    'view_item' => __('View Portfolio Item'), 
    'search_items' => __('Search Portfolio'), 
    'not_found' => __('Nothing found'), 
    'not_found_in_trash' => __('Nothing found in Trash'), 
    'parent_item_colon' => '' 
);   
$args = array( 
    'labels' => $labels, 
    'public' => true, 
    'publicly_queryable' => true, 
    'show_ui' => true, 
    'query_var' => true, 
    'rewrite' => array( 'slug' => 'portfolio', 'with_front'=> false ), 'capability_type' => 'post', 
    'hierarchical' => true, 
    'menu_position' => null, 
    'supports' => array('title','editor','thumbnail') 
);   
register_post_type( 'portfolio' , $args ); 
register_taxonomy("categories", array("portfolio"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => array( 'slug' => 'portfolio', 'with_front'=> false )));
}
add_action('init', 'portfolio_register');
