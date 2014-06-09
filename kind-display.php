<?php

add_filter( 'the_content', 'indieweb_taxonomy_content_filter', 20 );

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
		$c .= '<div class="';

		if(array_key_exists("contextLike",$customfields) && $customfields['contextLike'][0] == true){ 
			$c .= "p-like p-like-of ";
			$verbs[] = "liked";
		}


		if(strlen(get_the_content()) < 1){
			if(array_key_exists("response_quote",$customfields) && strlen(implode($customfields["response_quote"],"")) > 0){
				$verbs[] = "reposted";
				$c .= "p-repost p-repost-of";
			}
		}else{
			$verbs[] = "commented";
			$c .= "p-in-reply-to";
			if(array_key_exists("response_quote",$customfields) && strlen(implode($customfields["response_quote"],"")) > 0){
				$c .=  " h-cite";
				$verbs[] = "reposted";
			}
		}
		$c .= '">';
		$contextbox = "";
		if(array_key_exists("response_quote"$customfields) && strlen(implode($customfields["response_quote"],"")) > 0){
			$contextbox = '<blockquote class="p-content"><p>'.$contextbox . implode("</p><p>",$customfields["response_quote"]).'</p></blockquote>';
		}
		if(array_key_exists("response_title",$customfields)){
			$contextbox = '<p>'.$contextbox.' '.implode($verbs," and ").' <a class="u-url" href="'.$customfields['response_url'][0].'">@'.$customfields['response_title'][0].'</a></p>';
		}

	$c .= $contextbox.'</div>'; }
    $c .= '<div class="entry-content e-content p-summary" itemprop="name headline description articleBody">';
	$c .= $content;
	$c .= '</div>';
  }
  return $c;
}