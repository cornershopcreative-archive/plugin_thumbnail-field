<?php
/*
Plugin Name: Thumbnail Field
Plugin URI: http://cornershopcreative.com/code/thumbnail-field
Description: Exposes two new functions theme developers can use to retrieve information about a post's featured image, such as the caption or description.
Version: 1.0.3
Author: Cornershop Creative
Author URI: http://cornershopcreative.com
License: GPLv2 or later
*/

/**
 * Retrieve and return a field about a post's featured image
 *
 * @since 1.0.0
 *
 * @param string $field The name of the field to return. Optional, defaults to 'caption'
 * @param int $post_id The ID of the post that the featured image in question is assigned to. Optional, defaults to the current post.
 * @param bool $suppress_filters Suppress execution of any 'get_thumbnail_field' filters that may be present. Optional defaults to false.
 *
 * @return string|null Returns the value of the requested field, or null if the field/attachment couldn't be found
 *
 * @since 1.0.0
 */
function get_thumbnail_field( $field = 'caption', $post_id = NULL, $suppress_filters = FALSE ) {

	if ( $post_id === NULL ) {
		global $post;
		$post_id = $post->ID;
	}

	$attachment_id = get_post_thumbnail_id( $post_id );

	if ( $attachment_id ) {

		$data = wp_prepare_attachment_for_js( $attachment_id );

		// We're getting a non-standard field
		if ( !array_key_exists($field, $data) ) {
			$meta = get_post_meta( $data['id'], $field );
			if ( !count($meta) ) return NULL; // field wasn't found
			$field = ( count($meta) == 1 ) ? maybe_unserialize( $meta ) : $meta ;
		}

		$field = $data[$field];

		if ( $suppress_filters || !is_string($field) ) return $field;

		return apply_filters('get_thumbnail_field', $field);
	}

	return NULL;
}


/**
 * Echoes the value of a post thumbnail field. May not produce expected output if field value isn't a string.
 *
 * @see get_thumbnail_field() for parameters. Only difference is that this echoes the result.
 *
 * @since 1.0.0
 */
function the_thumbnail_field( $field = 'caption', $post_id = NULL, $suppress_filters = FALSE ) {
	echo get_post_thumbnail_field( $field, $post_id, $suppress_filters );
}