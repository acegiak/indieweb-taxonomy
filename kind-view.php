<?php

// Functions Related to Display

   
   if(get_option('indieweb_taxonomy_content_filter')=="true"){
	add_filter( 'the_content', 'indieweb_taxonomy_content_filter', 20 );
}

function response_display() {
	$resp = "";
	$response_url = get_post_meta(get_the_ID(), 'response_url', true);
        $response_title = get_post_meta(get_the_ID(), 'response_title', true);
        $response_quote = get_post_meta(get_the_ID(), 'response_quote', true);
	// Don't generate the response if all the fields are empty as that means nothing is being responded to
	if ( (!empty ($response_url)) && (!empty ($response_title)) && (!empty ($response_quote)) ) 
	    {
 		if ( empty ($response_title) ) 
			// If there is no user entered title, use the post title field instead
		    {
			$response_title = get_the_title(); 
		    }
		if ( !empty($response_url) ) 
			// Means a response to an external source
	    	    {
			if ( !empty($response_quote) 
			// Format based on having a citation
			    {	
		            }
			else {	
			// An empty citation means use a reply-context or an embed
			     }
		    }
		else{  // No Response URL means use the quote/title to generate a response
	    	    }  
  		echo '<div class="response">' . $resp . '</div>';
	   }
}

function indieweb_taxonomy_content_filter( $content ) {
	$c = "";
	   if ( is_search() ) { 
	  $c .= '<div class="entry-summary p-summary entry-title p-name" itemprop="name description">';
	  $c .= get_the_excerpt();
	  $c .= '</div>';
	  } else {
		if(in_array("response_url",get_post_custom_keys(get_the_ID()))){ 
			$customfields = get_post_custom(get_the_ID());
			$c .= '<div class="'.implode(' ',get_kind_class('response','p')).'">';
			$contextbox = "";
			if(has_kind("repost")){
				$contextbox = '<blockquote class="p-content"><p>'.$contextbox . implode("</p><p>",$customfields["response_quote"]).'</p></blockquote>';
			}
			if(count(get_the_kinds('','',''))>0){
				$contextbox = '<p>'.$contextbox.' '.get_the_kinds_list('',' and ','').' <a class="u-url" href="'.$customfields['response_url'][0].'">@'.$customfields['response_title'][0].'</a></p>';
			}

		$c .= $contextbox.'</div>'; }
		$c .= '<div class="entry-content e-content p-summary" itemprop="name headline description articleBody">';
		$c .= $content;
		$c .= '</div>';
	  }
  return $c;
}

?>
