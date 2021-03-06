<?php
/*
Addon Name: Kanonischer Link im Header
Description: Fügt einen rel='kanonischen' Link in einen Beitragskopf ein, um auf den ursprünglichen Beitrag zu verweisen
Author: WMS N@W
Author URI: https://n3rds.work
*/

add_action( 'template_redirect', 'autoblog_disable_standard_canonical_rel', 1 );
function autoblog_disable_standard_canonical_rel() {
	if ( !is_single() ) {
		return;
	}

	add_action( 'wp_head', 'autoblog_output_canonical_rel', 9 );

	if ( has_action( 'wp_head', 'rel_canonical' ) ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}

function autoblog_output_canonical_rel() {
	$original_link = filter_var( get_post_meta( get_the_ID(), 'original_source', true ), FILTER_VALIDATE_URL );
	if ( $original_link ) {
		printf( '<link rel="canonical" href="%s">', esc_url( $original_link ) );
	}
}