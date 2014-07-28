<?php
/*
Plugin Name: Delicious Shortcodes
Plugin URI: http://themeforest.net/user/DeliciousThemes
Description: Shortcodes for DeliciousThemes WordPress Themes - Patti Version
Version: 1.1
Author: DeliciousThemes
Author URI: http://themeforest.net/user/DeliciousThemes
*/

// version 1.1 of the plugin

/*-----------------------------------------------------------------------------------*/
/*	Shortcodes for Patti(many for Visual Composer)
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

function dt_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'color' => 'white',
      'style' => '',
      'text' => '',
	  'size' => '',
      'url' => '',
      'icon' => '',
      'target' => '',
      'icon_right' => ''
      ), $atts ) );
	
	$alt = ($style != '') ? 'alt' : '';
	$icon_i = ($icon != '') ? '<i class="fa '.$icon.'"></i>' : '';
	$icon_p = ($icon_right != '') ? 'icon-right' : '';
	$b_target = ($target != '') ? 'target="_blank"' : '';

	if($url) {
      return '<a '.$b_target.' class="button ' . $color .' '. $size . ' ' . $alt . ' ' . $icon_p . '" href="' . $url . '">'.$icon_i.'' . $text . $content . '</a>';
	} else {
		return '<a class="button ' . $color . '" href="">' . $text . $content . '</a>';
	}
}

add_shortcode('dt-button', 'dt_button_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Clear
/*-----------------------------------------------------------------------------------*/

function dt_clear_shortcode() {
   return '<div class="clear"></div>';
}

add_shortcode( 'dt-clear', 'dt_clear_shortcode' );



/*-----------------------------------------------------------------------------------*/
/*	Separator
/*-----------------------------------------------------------------------------------*/

function dt_separator_shortcode() {
   return '<div class="separator"></div>';
}

add_shortcode( 'dt-separator', 'dt_separator_shortcode' );



/*-----------------------------------------------------------------------------------*/
/*	Space
/*-----------------------------------------------------------------------------------*/

function dt_space_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'height' => '60'
    ), $atts ) );
   return '<div style="clear:both; width:100%; height:'.$height.'px"></div>';
}

add_shortcode( 'dt-space', 'dt_space_shortcode' );



/*-----------------------------------------------------------------------------------*/
/*	Line Break
/*-----------------------------------------------------------------------------------*/

function dt_line_break_shortcode() {
	return '<br />';
}
add_shortcode( 'dt-br', 'dt_line_break_shortcode' );



/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

function dt_list_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'icon' => 'ok'
    ), $atts ) );
	
	return '<div class="customlist list-icon-fa-'.$icon.'">'.do_shortcode($content).'</div>';
}

add_shortcode('dt-list', 'dt_list_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Dropcaps
/*-----------------------------------------------------------------------------------*/

function dt_dropcap_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => '1',
		'text' => ''
    ), $atts ) );
	  
	return '<span class="dropcap' . $style . '">' . $text . $content .'</span>';
}

add_shortcode('dt-dropcap', 'dt_dropcap_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Highlighted text
/*-----------------------------------------------------------------------------------*/

function dt_highlighted_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => 'dark',
		'text' => ''
    ), $atts ) );
	  
	return '<span class="highlight ' . $color . '">' . $text . $content .'</span>';
}

add_shortcode('dt-highlighted', 'dt_highlighted_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Quote Shortcode
/*-----------------------------------------------------------------------------------*/

function dt_quote_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'text' => '',
		'author' => ''
    ), $atts ) );
	
	$output = '';

	$output .= '<h2 class="parallax-quote">"' . $text.'"</h2>'; 
	$output .= '<span class="quote-author">' . $author.'</span>'; 

	return $output;
}

add_shortcode('dt-quote', 'dt_quote_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Fun Fact Shortcode
/*-----------------------------------------------------------------------------------*/

function dt_funfact_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'data_to' => '34',
		'data_speed' => '2000',
		'data_decimals' => 0,
		'funfact_text' => 'Winning Awards',
		'border_left' => 0
    ), $atts ) );
	
	wp_enqueue_script('dt-waypoints');
	wp_enqueue_script('dt-waypoints-custom');
	wp_enqueue_script('dt-count-to');

	$output = '';

	$border = '';
	if($border_left == 1) {
		$border = 'with-border';
	}
	else if ($border_left == 0) {
		$border = 'no-border';
	}

	$output .= '<div class="counter-wrapper">'; 
		$output .= '<div class="counter-item '.$border.'">'; 
			$output .= '<span class="counter-number" data-decimals="'.$data_decimals.'" data-from="1" data-to="'.$data_to.'" data-speed="'.$data_speed.'"></span>'; 
			$output .= '<span class="counter-text">'.$funfact_text.'</span>'; 
		$output .= '</div>'; 
		$output .= '<div class="clear"></div>'; 
	$output .= '</div>'; 


	return $output;
}

add_shortcode('dt-funfact', 'dt_funfact_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Section Title Shortcode
/*-----------------------------------------------------------------------------------*/

function dt_stitle_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
		'subtitle' => ''
    ), $atts ) );
	
	$output = '';

	$output .= '<h1 class="section-title">' . $title.'</h1>'; 
	if($subtitle != "") {
		$output .= '<h2 class="section-tagline">' . $subtitle.'</h2>'; 
	}

	return $output;
}

add_shortcode('dt-section-title', 'dt_stitle_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Skillbar Shortcode
/*-----------------------------------------------------------------------------------*/

function dt_skillbar_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'values' => '',
		'units' => '%'
    ), $atts ) );

	wp_enqueue_script('dt-waypoints');
	wp_enqueue_script('dt-custom-skills', get_template_directory_uri() . '/js/custom/custom-skills.js', array('jquery'), '1.0', false );


    $array_values = explode(",", $values);
	
	$output = '';

	foreach($array_values as $skill_value) {
		$data = explode("|", $skill_value);
		$output .= '<div class="skillbar clearfix" data-percent="'.$data['0'] . $units.'">';
			$output .= '<div class="skillbar-title"><span>'.$data['1'].'</span></div>';
			$output .= '<div class="skillbar-bar"></div>';
			$output .= '<div class="skill-bar-percent">'.$data['0'].$units .'</div>';
		$output .= '</div>';
	}


	return $output;
}

add_shortcode('dt-skillbar', 'dt_skillbar_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Social Share Blog
/*-----------------------------------------------------------------------------------*/

function delicious_social_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => ''
    ), $atts ) );

    wp_enqueue_script('dt-social');
	  
	$output = '';
	
	$output .= '<div class="share-options">';
		if(!empty($title)) { $output .= '<h6>'.$title.'</h6>'; }
		$output .= '<a href="" class="twitter-sharer" onClick="twitterSharer()"><i class="fa fa-twitter"></i></a>';
		$output .= '<a href="" class="facebook-sharer" onClick="facebookSharer()"><i class="fa fa-facebook"></i></a>';
		$output .= '<a href="" class="pinterest-sharer" onClick="pinterestSharer()"><i class="fa fa-pinterest"></i></a>';
		$output .= '<a href="" class="google-sharer" onClick="googleSharer()"><i class="fa fa-google-plus"></i></a>';
		$output .= '<a href="" class="delicious-sharer" onClick="deliciousSharer()"><i class="fa fa-share"></i></a>';
		$output .= '<a href="" class="linkedin-sharer" onClick="linkedinSharer()"><i class="fa fa-linkedin"></i></a>';
	$output .= '</div>';
	$output .= '<p></p>';
	
	return $output;
}

add_shortcode('dt-social-block', 'delicious_social_shortcode');



/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/

function delicious_column_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => 'one-half',
		'text' => '',
		'position' => ''
    ), $atts ) );

	if(!empty($position)) {
		return '<div class="percent-' . $size . ' column-' . $position . '"> '.do_shortcode($content).'</div>';
	} else {
		return '<div class="percent-' . $size . '"> ' .do_shortcode($content). '</div>';
	}
}

add_shortcode('dt-column', 'delicious_column_shortcode');




/*-----------------------------------------------------------------------------------*/
/*	Text with Icon
/*-----------------------------------------------------------------------------------*/

function delicious_text_with_icon( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => '',
		'media_type' => '',
		'dicon' 	=> '',
		'img'	=> '',
		'istyle' => '',
		'title' => '',
		'tbold' => ''
    ), $atts ) );

    $title_bold = ($tbold != '') ? 'bold-title' : '';

	$calign = '';
	if($align == 'left')   { $calign = 'content-left';}
	else if($align == 'center') { $calign = 'content-center';}
	else if($align == 'right')  { $calign = 'content-right';}

	$cstyle  = '';
	if($istyle == 'bold') { $cstyle = 'bold-fill';}	
	else if($istyle == 'thin')   { $cstyle = 'thin-fill';}
	else if($istyle == 'free')  { $cstyle = 'no-fill';}

	$output = '';
	$output .= '<div class="dt-service-elem '.$calign.' '. $cstyle.'">';
		$output .= '<div class="dt-service-icon">';
			if($media_type == 'icon-type') { $output .= '<i class="fa '.$dicon.'"></i>'; }
			else 
			if($media_type == 'img-type') { 
				$img_val = '';
				if (function_exists('wpb_getImageBySize')) {
					$img_val = wpb_getImageBySize(array('attach_id' => (int)$img, 'thumb_size' => 'full'));
				}				

				$output .= $img_val['thumbnail']; 
			}
		$output .= '</div>';
	
		$output .= '<div class="dt-service-content">';
			if($title != '') {
				$output .= '<h3 class="dt-service-title '.$title_bold.'">'.$title.'</h3>';
			}
			if(!empty($content)) {
				$output .= '<p>'.do_shortcode($content).'</p>';
			}
		$output .= '</div>';
	
	$output .= '</div>';
	return $output;

}

add_shortcode('dt-text-icon', 'delicious_text_with_icon');



/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/

//pricing table placebo

function delicious_pricing_table_placebo( $atts, $content = null ) {
	return do_shortcode($content);
}
add_shortcode( 'dt-table_placebo', 'delicious_pricing_table_placebo' );


// body
function delicious_pricing_table( $atts, $content = null ) {
	global $dt_table;
	extract(shortcode_atts(array(
		'columns' => '4'
    ), $atts));
	
	$columnsNr = '';
	$finished_table = '';

	switch ($columns) {
		case '2':
			$columnsNr .= 'cols-2';
			break;
		case '3':
			$columnsNr .= 'cols-3';
			break;
		case '4':
			$columnsNr .= 'cols-4';
			break;
		case '5':
			$columnsNr .= 'cols-5';
			break;
		case '6':
			$columnsNr .= 'cols-6';
			break;
	}

	do_shortcode($content);

	$columnContent = '';
	if (is_array($dt_table)) {

		for ($i = 0; $i < count($dt_table); $i++) {
			$columnClass = 'pricing-column'; $n = $i + 1;
			$columnClass .= ( $n % 2 ) ?  '' : ' even-column';
			$columnClass .= ( $dt_table[$i]['featured'] ) ?  ' featured-column' : '';
			$columnClass .= ( $n == count($dt_table) ) ?  ' last-column' : '';
			$columnClass .= ( $n == 1 ) ?  ' first-column' : '';
			$columnContent .= '<div class="'.$columnClass.' '.$columnsNr.'">'; 
			$columnContent .= '<div class="pricing-header">';
			if (( $dt_table[$i]['featured'] ) == '1' ) {
				$columnContent .= '<div class="column-shadow"></div>';
			}			
			$columnContent .='<div class="package-title">'.$dt_table[$i]['title'].'</div><div class="package-value"><span class="package-currency">'.$dt_table[$i]['currency'].'</span><span class="package-price">'.$dt_table[$i]['price'].'</span><span class="package-time">'.$dt_table[$i]['interval'].'</span></div></div>';
			$columnContent .= '<div class="package-features">'.str_replace(array("\r\n", "\n", "\r", "<p></p>"), array("", "", "", ""), $dt_table[$i]['content']).'</div>';
			$columnContent .= '</div>'; 
		}
		$finished_table = '<div class="pricing-table">'.$columnContent.'</div>';
	}
	
	$dt_table = '';
	
	return $finished_table;
	
}

add_shortcode('dt-pricing-table', 'delicious_pricing_table');


// Single Column
function delicious_shortcode_pricing_column( $atts, $content = null ) {
	global $dt_table;
	extract(shortcode_atts(array(
		'title' => '',
		'price' => '',
		'currency' => '',
		'interval' => '',
		'featured' => 'false'
    ), $atts));
	
	$featured = strtolower($featured);
	
	$column['title'] = $title;
	$column['price'] = $price;
	$column['currency'] = $currency;
	$column['interval'] = $interval;
	$column['featured'] = ( $featured == 'true' || $featured == 'yes' || $featured == '1' ) ? true : false;
	$column['content'] = do_shortcode($content);
	
	$dt_table[] = $column;
	
}

add_shortcode('dt-pricing-column', 'delicious_shortcode_pricing_column');


// signup area
function shortcode_signup( $atts, $content = null )
{	  
	return '<div class="signup">'. do_shortcode($content) .'</div>';
}

add_shortcode('dt-signup', 'shortcode_signup');



/*-----------------------------------------------------------------------------------*/
/*	Clients Shortcode
/*-----------------------------------------------------------------------------------*/

function delicious_clients( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'images' => '',
		'title' => '',
		'links' => ''
    ), $atts ) );
		$array_images = explode(",", $images);
		$array_links = explode(",", $links);
		$clientItem = '';

		$clientItem .= '<div class="clients-carousel">';
		if(!empty($title)) { 
			$clientItem .= '<h2>'.$title.'</h2>';
		}
		$clientItem .= '<div id="owl-clients" class="owl-carousel">';
		
			$image_markup = ''; 
			$i = 0;
			foreach($array_images as $single_image) {
				
				$image_attributes = wp_get_attachment_image_src( $single_image );
				$image_markup = '<img src="'.$image_attributes[0].'" width="'. $image_attributes[1].'" height="'. $image_attributes[2].'" />';

				$client_link = ($array_links['0'] != '') ? $array_links[$i] : '#' ;

				$clientItem .='<div class="client-item">';
							$clientItem .='<a href="'.$client_link.'">';
							$clientItem .= $image_markup;
							$clientItem .='</a>';
				$clientItem .='</div>';

				$i++;
			}
		$clientItem .= '</div>'; 
		$clientItem .= '</div>'; 
	
	return $clientItem;
	
}

add_shortcode('dt-clients', 'delicious_clients');



/*-----------------------------------------------------------------------------------*/
/*	Blog Grid Shortcode
/*-----------------------------------------------------------------------------------*/

function delicious_blog_grid($atts, $content = null) {
	extract(shortcode_atts(array(
		"number" => "6", 
		"columns" => "3",
		"categories" => ""
		
	), $atts));
	
	global $post;
	
	wp_enqueue_script('dt-isotope');	
	wp_enqueue_script('dt-custom-isotope-blog');

	$blog_id = 'blog-masonry';
	$blog_class = 'on-three-columns';	
	
	if($columns == '2') {
		$blog_class = 'on-two-columns';
	}
	if($columns == '3') {
		$blog_class = 'on-three-columns';
	}

	if($columns == '1') {
		$blog_class = 'on-one-column';
	}	
	
	$output = '';
		$blog_array_cats = get_terms('category', array('hide_empty' => false));
		if(empty($categories)) {
			foreach($blog_array_cats as $blog__array_cat) {
				$categories .= $blog__array_cat->slug .', ';
			}
		}
		
		$args = array(
			'orderby'=> 'post_date',
			'order' => 'date',
			'post_type' => 'post',
			'category_name' => $categories,
			'posts_per_page' => $number
		);
		
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
		
			$output .= '<div class="blog-page">';
				$output .= '<section class="'. $blog_id .' vc_blog_shortcode '. $blog_class.' isotope">';	
		
				while ($my_query->have_posts()) : $my_query->the_post();
			
					ob_start();  
					get_template_part('format', get_post_format());  
					$result = ob_get_contents();  
					ob_end_clean();
					$output .= $result;
			
				endwhile; 
			
				$output .= '</section>';
			$output .= '</div>';	
			}
		wp_reset_query();
	return $output;
}

add_shortcode("dt-blog-grid", "delicious_blog_grid");	



/*-----------------------------------------------------------------------------------*/
/*	Portfolio Grid Shortcode
/*-----------------------------------------------------------------------------------*/

function delicious_portfolio_grid($atts, $content = null) {
	extract(shortcode_atts(array(
		"number" => "-1",
		"categories" => ""
	), $atts));
	
	global $post;
	
	//setting a random id
	$rnd_id = dt_random_id(3);   

	$token = wp_generate_password(5, false, false);
	
	wp_enqueue_script('dt-isotope');	
	wp_enqueue_script('dt-custom-isotope-portfolio');
	
	wp_localize_script( 'dt-custom-isotope-portfolio', 'dt_grid_' .$token, array( 'id' => $rnd_id));	
	
		$layout = get_post_meta($post->ID,'dt_portfolio_columns',true);
		$navig = get_post_meta($post->ID,'dt_portfolio_navigation',true);
		$nav_number = get_post_meta($post->ID,'dt_nav_number',true);	
		
		$cats = explode(",", $categories);
		
		$portfolio_categs = get_terms('portfolio_cats', array('hide_empty' => false));
		$categ_list = '';
		
		foreach ($cats as $categ) {
			foreach($portfolio_categs as $portfolio_categ) {
				if($categ === $portfolio_categ->name) {
					$categ_list .= $portfolio_categ->slug . ', ';
				}
			}
		}
			
		//fallback categories
			$args = array(
				'post_type'=>'portfolio',
				'taxonomy' => 'portfolio_cats'
			);		
			$categ_fall = get_categories( $args );
			$categ_use = array();
			$i = 0;
			foreach($categ_fall as $cate) {
				$categ_use[$i] = $cate->name; 
				$i++;
			}
			$cats = array_filter($cats);
			if(empty($cats)) {
				$cats = array_merge($cats, $categ_use);
			}			
			
			
			$term_list = '';
			$list = '';
			
			foreach ($cats as $cat) {
				$to_replace = array(' ', '/', '&');
				$intermediate_replace = strtolower(str_replace($to_replace, '-', $cat));
				$str = preg_replace('/--+/', '-', $intermediate_replace);
				if (function_exists('icl_t')) { 
				$term_list .= '<li><a href="#filter" data-option-value=".'. get_taxonomy_cat_ID($cat) .'">' . icl_t('Portfolio Category', 'Term '.get_taxonomy_cat_ID( $cat ).'', $cat) . '</a></li>';
				}
				else 
				$term_list .= '<li><a href="#filter" data-option-value=".'. get_taxonomy_cat_ID($cat) .'">' . $cat . '</a></li>';
				$list .= $cat . ', ';
			}		
			
		
	$output = '';
		$output .= '<section class="patti-grid" id="gridwrapper_'.$rnd_id.'" data-token="' . $token .'">';
				$output .= '<section id="options">';
					$output .= '<ul id="filters" class="option-set clearfix" data-option-key="filter">';
						$output .= '<li><a href="#filter" data-option-value="*" class="selected active">'.__('All', 'delicious').'</a></li>';
						$output .= $term_list;
					$output .= '</ul>';
				$output .= '</section>';
				$output .= '<div class="space"></div>';
				
			$output .= '<section id="portfolio-wrapper">';
				$output .= '<ul class="portfolio grid isotope grid_'.$rnd_id.'">';

				$args = array(
					'post_type'=>'portfolio',
					'posts_per_page' => $number,
					'term' => 'portfolio_cats',
					'portfolio_cats' => $categ_list
				);
				
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post();

					$terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
					$term_val = '';
					if($terms) { foreach ($terms as $term) { $term_val .=get_taxonomy_cat_ID($term->name) .' '; } }
					
					$portf_icon = get_post_meta($post->ID,'dt_portf_icon',true);						
					$portf_thumbnail = get_post_meta($post->ID,'dt_portf_thumbnail',true);	
					$portf_link = get_post_meta($post->ID,'dt_portf_link',true);
					$portf_video = get_post_meta($post->ID,'dt_portf_video',true);

					$lgal = get_post_meta($post->ID,'dt_portf_gallery', true);	

					$gal_output = '';
					if(!empty($lgal)) {
						foreach($lgal as $gal_item) {
							$gal_item_url = $gal_item['dt_gl_url']['url'];
							$gal_item_title = get_post($gal_item['dt_gl_url']['id'])->post_excerpt;
							
							$gal_output .= '<a class="hidden_image" href="'.$gal_item_url.'" rel="prettyPhoto[gallery_'.$post->ID.']" title="'.$gal_item_title.'"></a>';

						}
					}

					$thumb_id = get_post_thumbnail_id($post->ID);
					
					$image_url = wp_get_attachment_url($thumb_id);
					
					$grid_thumbnail = $image_url;
					$item_class = 'item-small';
					
					switch ($portf_thumbnail) {
						case 'portfolio-big':
							$grid_thumbnail = aq_resize($image_url, 566, 440, true);
							$item_class = 'item-wide';
							break;
						case 'portfolio-small':
							$grid_thumbnail = aq_resize($image_url, 281, 219, true);
							$item_class = 'item-small';
							break;
						case 'half-horizontal':
							$grid_thumbnail = aq_resize($image_url, 566, 219, true);
							$item_class = 'item-long';
							break;
						case 'half-vertical':
							$grid_thumbnail = aq_resize($image_url, 281, 440, true);
							$item_class = 'item-high';
							break;							
					}		

					$copy = $terms;
					$res = '';
					if($terms) {
						foreach ( $terms as $term ) {
							if (function_exists('icl_t')) { 
								$res .= icl_t('Portfolio Category', 'Term '.get_taxonomy_cat_ID( $term->name ).'', $term->name);
							}
							else $res .= $term->name;
							if (next($copy )) {
								$res .=  ', ';
							}
						}
					}					

					$output .= '<li class="grid-item '.$term_val.' '.$item_class.'">';

					$inner_output = '';
					$inner_output .= '<div class="grid-item-on-hover">';
						$inner_output .= '<div class="grid-text">';
							$inner_output .= '<h1>'.get_the_title().'</h1>';
						$inner_output .= '</div>';
						$inner_output .= '<div><span>';	
							$inner_output .= $res;
						$inner_output	.='</span></div>';
					$inner_output .= '</div>';
					$inner_output .= '<img src="'. $grid_thumbnail.'" alt="" />';				
					
					$test_link = '';
					if($portf_icon == 'link_to_page') {
							$test_link = '<a href="'.get_permalink($post->ID).'">'.$inner_output.'</a>';
					} else if($portf_icon == 'link_to_link') {
						$test_link = '<a href="'.$portf_link.'">'.$inner_output.'</a>';
					}
					else if($portf_icon == 'lightbox_to_image') {
						$test_link = '<a href="'. wp_get_attachment_url($thumb_id) .'" rel="prettyPhoto[portf_gal]" title="'. get_the_title() .'">'.$inner_output.'</a>';
					}
					else if($portf_icon == 'lightbox_to_video') {
						$test_link = '<a href="'. $portf_video .'" rel="prettyPhoto[portf_gal]" title="'. get_the_title() .'">'.$inner_output.'</a>';
					} 	
					else if ($portf_icon == 'lightbox_to_gallery') {  $test_link = '<a href="'. wp_get_attachment_url($thumb_id) .'" rel="prettyPhoto[gallery_'.$post->ID.']" title="'. get_the_title().'" >'.$inner_output.'</a>' . $gal_output; }														
					
					$output .= $test_link;
		
					$output .= '</li>';
				endwhile; 
				}
				wp_reset_query(); 
				$output .= '</ul>';
			$output .= '</section>';
	$output .= '</section>';
	$output .= '<div class="space"></div>';	

	return $output;
}

add_shortcode("dt-portfolio-grid", "delicious_portfolio_grid");	



/*-----------------------------------------------------------------------------------*/
/*	Services Item
/*-----------------------------------------------------------------------------------*/

function delicious_services($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));

	global $post;
	
	$args = array(
		'post_type' => 'services',
		'posts_per_page' => 1,
		'p' => $id
	);
	
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();


	$service_icon = get_post_meta($post->ID, 'dt_service_icon', true);
	$service_text = get_post_meta($post->ID, 'dt_service_text', true);
	
	$service_class ='';
	
	$retour = '';
	$retour .= '<div class="dt-service-wrapper">';
		$retour .='<div class="dt-service-item">';
			$retour .= '<i class="fa '.$service_icon.'"></i>';
			$retour .='<h3 class="service-title">'.get_the_title().'</h3>';
		$retour .='</div>';

		$retour .='<div class="dt-service-hover">';
			$retour .= '<i class="fa '.$service_icon.'"></i><h3>'.get_the_title().'</h3>';	
			$retour .='<p>'.wp_kses_post($service_text).'</p>';			
		$retour .= '</div>';	
	$retour .='</div>';

	endwhile; else:
	$retour ='';
	$retour .= "nothing found.";
	endif;

	//Reset Query
    wp_reset_query();
	
	return $retour;
}

add_shortcode("dt-service", "delicious_services");



/*-----------------------------------------------------------------------------------*/
/*	Service List for Visual Composer
/*-----------------------------------------------------------------------------------*/

function delicious_vc_services($atts, $content = null) {
	extract(shortcode_atts(array(
		"ids" => ''
	), $atts));

	$service_ids = explode(",", $ids);

	$output = '';
	$output .= '<div class="homepage-services">';

	foreach ($service_ids as $sid) {
		$output .= do_shortcode("[dt-service id=".$sid."]");
	}

	$output .= '</div>';
	return $output;
}

add_shortcode("dt-services", "delicious_vc_services");



/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

function delicious_member($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));

	global $post;

	$args = array(
		'post_type' => 'team',
		'posts_per_page' => 1,
		'p' => $id
	);
	
	$team_query = new WP_Query($args);
	if( $team_query->have_posts() ) :
	while ($team_query->have_posts()) : $team_query->the_post();
	
	$member_text = get_post_meta($post->ID, 'dt_member_text', true);
	$position = get_post_meta($post->ID, 'dt_member_position', true);
	$twitter = get_post_meta($post->ID, 'dt_member_twitter', true);
	$facebook = get_post_meta($post->ID, 'dt_member_facebook', true);
	$email = get_post_meta($post->ID, 'dt_member_mail', true);
	$linkedin = get_post_meta($post->ID, 'dt_member_linkedin', true);
	$google = get_post_meta($post->ID, 'dt_member_google', true);

	$team_thumb_icon = get_post_meta($post->ID, 'dt_team_thumb_icon', true);
	
	$mail = is_email($email);
	
	$image = get_the_post_thumbnail( $id, 'member-thumb', array('class' => 'team-avatar') );
	$url_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	
	$retour ='';
	$retour .='<div class="team-member">';
			if($team_thumb_icon != 'flat_image') {
				$retour .= '<a href="'.$url_image.'" rel="prettyPhoto" title="'.get_the_title().'">';						
					$retour .= '<span class="item-on-hover"><span class="hover-image"><i class="fa fa-search"></i></span></span>';						
					$retour .= $image;
				$retour .= '</a>';
			}
			else {
				$retour .= $image;
			}
			$retour .='<div class="team-text">';
				$retour .='<h3><span>';
				$retour .= get_the_title();
				$retour .='</span></h3>';
				if(!empty($position)) {
				$retour .='<h6>'.$position.'</h6>'; }
				$retour .='<p>'.wp_kses_post($member_text).'</p>';
			$retour .='</div>';
		
			$retour .='<div class="team-social">';
				if(!empty($mail)) {
				$retour .='<a href="mailto:'.$mail.'"><i class="fa fa-envelope"></i></a>';  }	
				if(!empty($facebook)) {
				$retour .='<a href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a>'; }				
				if(!empty($twitter)) {
				$retour .='<a href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a>'; }
				if(!empty($google)) {
				$retour .='<a href="'.esc_url($google).'"><i class="fa fa-google-plus"></i></a>'; }						
				if(!empty($linkedin)) {
				$retour .='<a href="'.esc_url($linkedin).'"><i class="fa fa-linkedin"></i></a>'; }			
			$retour .='</div>';
	$retour .='</div>';

	 endwhile; else:
	 $retour ='';
	 $retour .= "nothing found.";
	 endif;

    //Reset Query
    wp_reset_query();
	
	return $retour;
}
add_shortcode("dt-team-member", "delicious_member");



/*-----------------------------------------------------------------------------------*/
/*	Testimonial Item
/*-----------------------------------------------------------------------------------*/

function delicious_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));

	global $post;
	
	$args = array(
		'post_type' => 'testimonials',
		'posts_per_page' => 1,
		'p' => $id
	);
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();
	
	$testimonial_desc = get_post_meta($post->ID, 'dt_testimonial_desc', true);	
	$testimonial_name = get_post_meta($post->ID, 'dt_testimonial_name', true);	
	$testimonial_details = get_post_meta($post->ID, 'dt_testimonial_details', true);	
	
	$retour ='';
	
	$retour .='<div class="testimonial-item">';
	$retour .='<p>'.wp_kses_post($testimonial_desc).'</p>';
	$retour .='<p>';
	$retour .='<span class="testimonial-name">'.esc_html($testimonial_name).'</span>, <span class="testimonial-position">'.esc_html($testimonial_details).'</span>';
	$retour .='</p>';
	$retour .='</div>';

	endwhile; else:
	$retour ='';
	$retour .= "nothing found.";
	endif;

	//Reset Query
    wp_reset_query();
	
	return $retour;
}

add_shortcode("dt-testimonial", "delicious_testimonials");



/*-----------------------------------------------------------------------------------*/
/*	Testimonial Carousel for Visual Composer
/*-----------------------------------------------------------------------------------*/

function delicious_dt_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
		"ids" => ''
	), $atts));

	$testimonial_ids = explode(",", $ids);

	$rnd_id = dt_random_id(3);
	$token = wp_generate_password(5, false, false);

	wp_enqueue_script('custom-testimonials', get_template_directory_uri() . '/js/custom/custom-testimonials.js', array('jquery'), '1.0', false );	
	wp_localize_script( 'custom-testimonials', 'dt_testimonials_' . $token, array( 'id' => $rnd_id) );		

	$output = '';
	$output .= '<div class="testimonials-carousel">';
		$output .= '<div id="owl-testimonials-'.$rnd_id.'" class="owl-carousel testimonials-slider" data-token="' . $token .'">';

	foreach ($testimonial_ids as $tid) {
		$output .= do_shortcode("[dt-testimonial id=".$tid."]");
	}

		$output .= '</div>';
	$output .= '</div>';
	return $output;
}

add_shortcode("dt-testimonials", "delicious_dt_testimonials");



/*-----------------------------------------------------------------------------------*/
/*	Portfolio Slider for Visual Composer
/*-----------------------------------------------------------------------------------*/

function delicious_portfolio_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		"images" => '',
		'thumb_size' => 'gallery-thumb'
	), $atts));

	$portfolio_images = explode(",", $images);

	$rnd_id = dt_random_id(3);
	$token = wp_generate_password(5, false, false);

	wp_enqueue_script('custom-portfolio-slider', get_template_directory_uri() . '/js/custom/custom-slider.js', array('jquery'), '1.0', false );	
	wp_localize_script( 'custom-portfolio-slider', 'dt_slider_' . $token, array( 'id' => $rnd_id) );		

	$output = '';
	$output .= '<div class="portfolio-slider-wrapper">';
		$output .= '<div id="owl-slider-'.$rnd_id.'" class="owl-carousel portfolio-slider" data-token="' . $token .'">';

		foreach($portfolio_images as $single_image) {
			
			$img_size = '';
			$alt = trim(strip_tags( get_post_meta($single_image, '_wp_attachment_image_alt', true) ));
			if (function_exists('wpb_getImageBySize')) {
				$img_size = wpb_getImageBySize(array('attach_id' => (int)$single_image, 'thumb_size' => $thumb_size));
			}
			$output .='<div class="slider-item">';
			$output .='<a title="'.$alt.'" href="'.$img_size['p_img_large']['0'].'" rel="prettyPhoto[project_gal]">';
			$output .= $img_size['thumbnail'];
			$output .='</a>';
			$output .='</div>';
		}

		$output .= '</div>';
		$output .= '<div class="slider-nav"></div>';
	$output .= '</div>';
	return $output;
}

add_shortcode("dt-portfolio-slider", "delicious_portfolio_slider");




/*-----------------------------------------------------------------------------------*/
/*	Google Map Shortcode
/*-----------------------------------------------------------------------------------*/
function delicious_map_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"button_text" => '',
		"latitude" => '37.422117',
		"longitude" => '-122.084053',
		'pin_title' => 'Company Headquarters',
		'pin_desc' => 'Now that you visited our website, how about <br/> checking out our office too?'
	), $atts));


	$rnd_id = dt_random_id(3);
	
	$token = wp_generate_password(5, false, false);

	$site_url = get_stylesheet_directory_uri();

	wp_enqueue_script('dt-api-map', 'http://maps.google.com/maps/api/js?sensor=false', false );	
	wp_enqueue_script('dt-custom-map', get_template_directory_uri() . '/js/custom/custom-map.js', array('dt-api-map'), '1.0', false );	
	wp_localize_script( 'dt-custom-map', 'dt_map_'. $token, array( 'id' => $rnd_id, 'site_url' => $site_url, 'latitude' => $latitude, 'longitude' => $longitude, 'pin_title' => $pin_title, 'pin_desc' => $pin_desc) );		

	$output = '';
	$output .= '<div class="map-wrapper" id="delicious_map_'.$rnd_id.'" data-token="' . $token .'">';
		$output .='<a class="button-map close-map"><span>'.$button_text.'</span></a>';
		$output .='<div id="google_map_'.$rnd_id.'"></div>';
	$output .='</div>';

	return $output;
}

add_shortcode("dt-google-map", "delicious_map_shortcode");



/*-----------------------------------------------------------------------------------*/
/*	CF7 Shortcode Hack
/*-----------------------------------------------------------------------------------*/

add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

function mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

return $form;
}



/*-----------------------------------------------------------------------------------*/
/*	Twitter Carousel Shortcode
/*-----------------------------------------------------------------------------------*/

function delicious_twitter_carousel($atts, $content = null) {
	extract(shortcode_atts(array(
		"twitter_username" => '',
		"twitter_postcount" => '',
		"twitter_consumer_key" => '',
		"twitter_consumer_secret" => '',
		"twitter_access_token" => '',
		"twitter_access_token_secret" => ''
	), $atts));

	$transName = 'list_tweets';
    $cacheTime = 20;

    if(false === ($twitterData = get_transient($transName) ) ){
    	require_once ('includes/twitteroauth.php');
		$twitterConnection = new TwitterOAuth(
							$twitter_consumer_key,			// Consumer Key
							$twitter_consumer_secret,   		// Consumer secret
							$twitter_access_token,       		// Access token
							$twitter_access_token_secret    	// Access token secret
							);

		$twitterData = $twitterConnection->get(
				  'statuses/user_timeline',
				  array(
				    'screen_name'     => $twitter_username,
				    'count'           => $twitter_postcount,
				    'exclude_replies' => false
				  )
				);

		if($twitterConnection->http_code != 200)
		{
			$twitterData = get_transient($transName);
		}

        // Save our new transient.
        set_transient($transName, $twitterData, 60 * $cacheTime);
    }

  	if(!empty($twitterData) || !isset($twitterData['error'])) {
		$i=0;
		$hyperlinks = true;
		$encode_utf8 = false;
		$twitter_users = true;
		$update = true;
		
		echo '<div class="twitter-carousel">';
		echo '<ul class="tweet_list owl-carousel" id="owl-twitter">';

        foreach($twitterData as $item){

            $msg = $item->text;
            $permalink = 'http://twitter.com/#!/'. $twitter_username .'/status/'. $item->id_str;
			$retweet = 'http://twitter.com/intent/retweet?tweet_id='. $item->id_str;
			$tweet_reply = 'http://twitter.com/intent/tweet?in_reply_to='. $item->id_str;
			$tweet_favorite = 'http://twitter.com/intent/favorite?tweet_id='. $item->id_str;
            if($encode_utf8) $msg = utf8_encode($msg);
                $msg = encode_tweet($msg);
            $link = $permalink;
            	echo '<li>';

            if ($hyperlinks) {    $msg = hyperlinks($msg); }
            if ($twitter_users)  { $msg = twitter_users($msg); }

            if($update) {
				$time = strtotime($item->created_at);

				if ( ( abs( time() - $time) ) < 86400 )
					$h_time = sprintf( __('%s ago', 'delicious'), human_time_diff( $time ) );
				else
					$h_time = time_elapsed_string($time);

				echo '<span class="tweet_time">'.$h_time.'</span>';
				echo '<span class="tweet_text">'.$msg.'</span>';		          
				echo '<a class="tweet_action tweet_reply" href="'.$tweet_reply.'"><i class="fa fa-reply"></i> '.__('Reply', 'delicious').'</a>';
				echo '<a class="tweet_action tweet_retweet" href="'.$retweet.'"><i class="fa fa-retweet"></i> '.__('Retweet', 'delicious').'</a>';
				echo '<a class="tweet_action tweet_favorite" href="'.$tweet_favorite.'"><i class="fa fa-retweet"></i> '.__('Favorite', 'delicious').'</a>';

            }

            echo '</li>';

            $i++;
            if ( $i >= $twitter_postcount ) break;
        }

		echo '</ul>';
		echo '</div>';

    	}
}

add_shortcode("dt-twitter-carousel", "delicious_twitter_carousel");



/*-----------------------------------------------------------------------------------*/
/*	Shortcodes Filter
/*-----------------------------------------------------------------------------------*/
add_filter("the_content", "dt_the_content_filter");
 
function dt_the_content_filter($content) {
 
	// array of custom shortcodes
	$block = join("|",array("dt-portfolio-grid","dt-blog-grid", "dt-signup", "dt-pricing-column", "dt-button", "dt-funfact", "dt-skillbar", "dt-column"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;

}

// enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Functions for Twitter Shortcode
/*-----------------------------------------------------------------------------------*/

	// Beautify time
	function time_elapsed_string($ptime) {
	    $etime = time() - $ptime;
	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }
	    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
	                30 * 24 * 60 * 60       =>  'month',
	                24 * 60 * 60            =>  'day',
	                60 * 60                 =>  'hour',
	                60                      =>  'minute',
	                1                       =>  'second'
	                );
	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
	        }
	    }
	}


    // Find links and create the hyperlinks
	function hyperlinks($text) {
	    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&#038;%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&#038;%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);

	    // match name@address
	    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	        //mach #trendingtopics. Props to Michael Voigt
	    $text = preg_replace('/([\.|\,|\:|\|\|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	    return $text;
	}


	// Find twitter usernames and link to them
	function twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\|\|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}

    // Encode single quotes in your tweets
    function encode_tweet($text) {
            $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
            return $text;
    }
?>