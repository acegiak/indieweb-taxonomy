<?php

// Functions Related to Display


   if(get_option('indieweb_taxonomy_content_filter')=="true"){
        if(get_option('indieweb_taxonomy_content-top')=="true"){
		add_filter( 'the_content', 'content_response_top', 20 );
	    }
	else {
		add_filter( 'the_content', 'content_response_bottom', 20 );
	     }
   }

function get_response_display() {
	$resp = "";
	$c = "";
	$response_url = get_post_meta(get_the_ID(), 'response_url', true);
        $response_title = get_post_meta(get_the_ID(), 'response_title', true);
        $response_quote = get_post_meta(get_the_ID(), 'response_quote', true);
 	if ( empty ($response_title) )
	    // If there is no user entered title, use the post title field instead
	   {
		$response_title = get_the_title();
	   }

	// Don't generate the response if all the fields are empty as that means nothing is being responded to
	if (! empty($response_url)  )
	    {
		// Means a response to an external source
		if ( !empty($response_quote) )
		    {
		   	// Format based on having a citation
			$resp .= '<div class="' . implode(' ',get_kind_class ( 'h-cite', 'p' )) . '">';
			$resp .= '<strong>' . implode(' and ', get_kind_verbs()) . '</strong>';
			$resp .= esc_attr($response_quote);
			$resp .= ' - ' . '<a href="' . $response_url . '">' . $response_title . '</a>';
			$resp .= '</div>';
			$c = '<div class="response">' . $resp . '</div>';
		    }
		else {
			$resp .= '<strong>' . implode(' and ', get_kind_verbs()) . '</strong>';
		    // An empty citation means use a reply-context or an embed
			 if(get_option('indieweb_taxonomy_rich_embeds')=="true"){
				$embed_code = new_embed_get($response_url);
				}
			 else {
				$embed_code = false;
			      }
			if ($embed_code == false)
				{
				   $resp .= '<a class="' . implode(' ',get_kind_class ( '', 'u' )) . '"href="' . $response_url . '">' . $response_title . '</a>';
				}
			else{
				$resp .= '<br />' . $embed_code;
				$resp .= '<br /><a class="' . implode(' ',get_kind_class ( 'h-cite empty', 'u' )) . '" href="' . $response_url . '"></a>';
			   }
		  	$c = '<div class="response">' . $resp . '</div>';
		     }
	   }
	elseif (! empty ($response_quote) )
	   {
		// No Response URL means use the quote/title to generate a response and mark up p-
		$resp .= '<strong>' . implode(' and ', get_kind_verbs()) . '</strong>';
		$resp .= '<div class="' . implode(' ',get_kind_class ( 'h-cite', 'p' )) . '"><blockquote>';
		$resp .= esc_attr($response_quote);
		$resp .= '</blockquote> - <em>' . $response_title . '</em></div>';
		$c = '<div class="response">' . $resp . '</div>';
	   }
	return apply_filters( 'response-display', $c);

}

function response_display() {
	return get_response_display();
}

function content_response_top ($content ) {
    $c = "";
    $c .= get_response_display();
    $c .= $content;
    return $c;
}

function content_response_bottom ($content ) {
    $c = "";
    $c .= $content;
    $c .= get_response_display();
    return $c;
}

?>
