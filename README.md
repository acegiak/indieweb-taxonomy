indieweb-taxonomy
=================

Indieweb Taxonomy adds a Custom Taxonomy to the standard post type in Wordpress that allows posts to have a semantic componenent. This allows archives of replies, likes, reposts, etc. as well as theme support to add the appropriate classes to links within same.

Version 0.02 - Location meta box with HTML5 geolocation fill-in added. This allows posts to optionally have a location. This is as per the Wordpress Geodata specifications, so the Wordpress Android app will fill them in. There is no display functionality. Various functions that mimic the built-in functions for other taxonomies were added, including filters to add additional behaviors. Default terms now prepopulate if no terms exist.

Version 0.01 - Registers a custom taxonomy, adds in code snippets to turn the post meta box from checkboxes to radio buttons, adds code to allow a custom permalink tag if needed.

Roadmap - Register embeds for commonly linked sites(Facebook, Google Plus, Instagram, etc). For supported sites, display the embed and an empty link
for the microformat markup, for non-supported sites, use a generic handler to display the content. Fix geolocation public checkbox and write functions
 to display geographic data. Add option to disable automatic content injection as Acegiak did in his fork.  
