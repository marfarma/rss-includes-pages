<?php
/*
Plugin Name: RSS Includes Pages
Version: 1.0
Plugin URI: http://www.mariosalexandrou.com/blog/rss-includes-pages.asp
Description: Include pages (not just posts) in RSS feeds. Particularly useful to those that use WordPress as a CMS. 
Author: Marios Alexandrou
Author URI: http://www.mariosalexandrou.com/
*/
add_filter('posts_where', 'ma_posts_where');

function ma_posts_where($var){
	if (!is_feed()){ // check if this is a feed
		return $var; // if not, return an unmodified variable
	} else {
		global $table_prefix; // get the table prefix
		$find = $table_prefix . 'posts.post_type = \'post\''; // find where the query filters by post_type
		$replace = '(' . $find . ' OR ' . $table_prefix . 'posts.post_type = \'page\')'; // add OR post_type 'page' to the query
		$var = str_replace($find, $replace, $var); // change the query
	}
	return $var; // return the variable
}
?>
