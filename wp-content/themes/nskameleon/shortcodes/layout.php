<?php

//[box_a link="" img_url="" img_title=""]
function ns_box_a_shortcode( $atts ) {
	extract( $atts ); 
	debug_var($atts);
	$href = vc_build_link($href);
	
	return '<a href="'.$link.'" class="box_a" rel="subsection"><img src="'.$img_url.'" alt="'.$img_title.'" title="'.$img_title.'"/></a>';
}
add_shortcode( 'box_a', 'ns_box_a_shortcode' );

register_vc_shortcode(array(
	"name" => __("NSK Box A", 'nskameleon'),
	"base" => "box_a",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
	"params" => array(
					array(
						"type" => "textfield ",
						"holder" => "div",
						"class" => "",
						"heading" => __("Link", 'nskameleon'),
						"param_name" => "link",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image", 'nskameleon'),
						"param_name" => "img_url",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Title", 'nskameleon'),
						"param_name" => "img_title",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
				)
));


