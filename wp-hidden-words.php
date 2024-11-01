<?php
/*
Plugin Name: WordPress Hidden Words
Plugin URI: http://luckyfield.cn/?p=976
Description: This plugin helps to hide the specified words in your content.
Author: 貓小豆
Version: 1.0
Author URI: http://luckyfield.cn/
*/

function wp_hidden_words($content){
	global $post;
	$hidden_words = false;
	if ( $post->post_type == 'page' ) {
		if ( !current_user_can( 'edit_page', $post->ID ) )
			$hidden_words = true;	
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ) )
			$hidden_words = true;	
	}

	if ($hidden_words) {
		$content = preg_replace('/<hide>.*?<\/hide>/is', '<span style="background-color: #E1FFFF; font-style: italic; font-weight: bold;">**** Hidden Words ****</span>', $content);
 } else {
  	$content = preg_replace('/<hide>(.*?)<\/hide>/is', '<span style="background-color: #E1FFFF; font-style: italic; font-weight: bold;">$1</span>', $content);
  }

	return $content;	
} 

add_filter('the_content', 'wp_hidden_words');
?>