<?php 
add_shortcode( 'portfolio' ,'portfolio_function');
function portfolio_function(){
      wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/style.css', array(), '0.1.0', 'all');
      wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
     $terms = get_terms('categories');  
    $html='<div class="work_container">';
    $tabsContent='';
    $tabs='<ul class="tabs">';
    $i=0;
    foreach ( $terms as $term ) {
        if($i==0){
            $class="current";
        }else{ 
            $class=""; }
            $tabs.='<li class="tab-link '.$class.'" data-tab="tabs-'.$term->term_id.'">'.$term->name.'</li>';
            $i++;
    }
    $tabs.='</ul>';
    
    $tabsContent='<div class="wrape">';
    $i=0;
 
    foreach ( $terms as $term ) {   
         if($i==0){
                $class="current";
            }else{ 
                $class=""; 
            }
    $tabsContent.='<div id="tabs-'.$term->term_id.'" class="tab-content '.$class.'"><div class="row">';
    $portfolios = get_posts(array(
                'post_type' => 'portfolio',
                'tax_query' => array(
                    array(
                    'taxonomy' => 'categories',
                    'field' => 'term_id',
                    'terms' => $term->term_id
                    )
                )
            )
        );
    foreach ($portfolios as $portfolio) {
        $url = wp_get_attachment_url( get_post_thumbnail_id($portfolio->ID,'full', true) ); 
        $excerpt= get_the_excerpt($portfolio->ID);
        $tabsContent.='<div class=" card col-md-4 ">
          <figure><img src="'. $url.'"><figcaption>
            <a href="'.get_the_permalink($portfolio->ID).'">View More Detail</a></figcaption>
        </figure>       
       <div class="card-body">
         <div class="left_text">
         <h3>'.$portfolio->post_title.'</h3>
         <span>'.$excerpt.'</span>
         </div>
       </div>
    </div>';
}       
$tabsContent.='</div></div>';
$i++;
}
$tabsContent.='</div>';   
$htmlClosed='</div>';
return $html.$tabs.$tabsContent.$htmlClosed;
}
