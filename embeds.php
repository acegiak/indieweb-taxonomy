<?php 

// Embeds for specific websites not supported by Wordpress
// planning on using wp embed register handler to register these for embedding
// Then use wp_oembed_get to embed posts from any supported site, and if the site isn't supported, mark it up manually

function embed_facebook ($url)
   {
        if (strpos($url,'https://www.facebook.com/') !== false) {

       ?>
                <div id="fb-root"></div>
          <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-post" data-href="<?php echo esc_url($url);?> " data-width="466"><div class="fb-xfbml-parse-ignore"><a href="<?php echo esc_url($url) ;?> ">Post</a></div></div>
     <?php
      }
   }

function embed_gplus ($url)
   {
        if (strpos($url,'https://plus.google.com/') !== false) {
   ?>
                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                <div class="g-post" data-href="<?php echo esc_url($url); ?>"></div>
      <?php
     }
   }

function embed_instagram ($url)
   {
    if (strpos($lurl,'https://instagram.com/') !== false) {

   ?>
        <iframe src="<?php echo esc_url($url); ?>embed" width="612" height="710" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
    <?php
     }
   }

function embed_twitter ($url)
   {
         if (strpos($url,'https://twitter.com/') !== false) {
                        echo wp_oembed_get($url);
          }
   }

?>
