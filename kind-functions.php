<?php 

// Functions for Kind Taxonomies

function get_the_kinds( $id = false ) {
/**
         * Filter the array of kinds to return for a post.
         *
         *
         */

	        $kinds = get_the_terms( $id, 'kind' );
	        if ( ! $kinds || is_wp_error( $kinds ) )
	                $kinds = array();
	
	        $kinds = array_values( $kinds );
	
	        foreach ( array_keys( $kinds ) as $key ) {
	                _make_cat_compat( $kinds[$key] );
	        }
	
	        return apply_filters( 'get_the_kind', $kinds );
	}

function get_the_kinds_list( $before = '', $sep = '', $after = '', $id = 0 ) {
        /**
         * Filter the kinds list for a given post.
         *
         * @param string $kind_list List of kinds.
         * @param string $before   String to use before kinds.
         * @param string $sep      String to use between the kinds.
         * @param string $after    String to use after kinds.
         * @param int    $id       Post ID.
         */
        return apply_filters( 'the_kinds', get_the_term_list( $id, 'kind', $before, $sep, $after ), $before, $sep, $after, $id );
}

function the_kinds( $before = null, $sep = ', ', $after = '' ) {
        if ( null === $before )
                $before = __('Kinds: ');
        echo get_the_kinds_list($before, $sep, $after);
}

function has_kind( $kind = '', $post = null ) {
        return has_term( $kind, 'kind', $post );
}

?>
