<?php

// Functions Related to Display

function return_response () {
   $response_url = get_post_meta(get_the_ID(), 'response_url', true);
   $response_title = get_post_meta(get_the_ID(), 'response_title', true);
   if ( ! empty($response_url))
      {
   return '<div class="response">' . '<h2>In response to: <a href="' . $response_url . '" class="' . implode(" ", get_kind_class()) . '">' . $response_title . '</a></h2>' . ' </div>';
      }
 }

//add_filter( 'the_content', 'test_the_content' );

function test_the_content ($content)
   {
      return return_response() . $content;
   }

   
   if(get_option('indieweb_taxonomy_content_filter')=="true"){
	add_filter( 'the_content', 'indieweb_taxonomy_content_filter', 20 );
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
			$verbs = array();
			$c .= '<div class="'.implode(' ',get_kind_class('','p')).'">';
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
