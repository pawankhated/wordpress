<?php
add_shortcode( 'update-products-info', 'wp_product_func' );
function wp_product_func( $atts ) {
$row = 0;
$dir = get_home_path()."/update-stock-export.csv";
//echo $dir = plugin_dir_path( __FILE__ )."/Brennans-Stock-Export.csv";die;



global $wpdb;
$arrayCount=array();
if (file_exists($dir)) {

if (($handle = fopen($dir, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  
  	if($row>0){
  		$sku=$data[0];
  		$qty=$data[1];
  		$price=$data[2];
  		if($sku){
			$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );  		
			if($product_id){
				update_post_meta($product_id, '_regular_price', $price);	
				update_post_meta($product_id, '_stock', $qty);	
				$arrayCount[]=$product_id;	
			}
  		}
  }
  	$row++;  	
}
	  fclose($handle);
	  unlink($dir);
	  echo count($arrayCount).":- Product Updated Successfully"; 
  	  die;

}else{
			$content = "No CSV Found to update product";
			//$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText.txt","wb");
			//fwrite($fp,$content);
			//fclose($fp);
 			echo "No CSV Found to update product1";die;
   }
 }else{

	$content = "No CSV Found to update product";
	//$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText.txt","wb");
	//fwrite($fp,$content);
	//fclose($fp);
	echo "No CSV Found to update product2";die;
   }
}
?>