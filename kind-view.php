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

add_filter( 'the_content', 'test_the_content' );

function test_the_content ($content)
   {
      return return_response() . $content;
   }


?>
