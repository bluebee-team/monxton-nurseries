<?php
/**
 * Title: Blog Cards 5 -- Three Columns with Small Cards
 * Slug: bluebeefse/blogcards5--three-columns-small
 * Inserter: true
 * Categories: blog
 */
?>

<!-- wp:group {"metadata":{"name":"Blog Cards 6"},"style":{"spacing":{"padding":{"top":"clamp(40px, 7.5vw, 82px)","bottom":"clamp(40px, 7.5vw, 82px)"},"blockGap":"clamp(24px, 4vw, 35px)"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:clamp(40px, 7.5vw, 82px);padding-bottom:clamp(40px, 7.5vw, 82px)"><!-- wp:group {"style":{"spacing":{"blockGap":"15px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading -->
<h2 class="wp-block-heading">Enter title here</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:50%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View all</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":0,"query":{"perPage":"3","pages":"1","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[]}},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"},"elements":{"link":{"color":{"text":"#454545"}}}},"textColor":"quaternary","className":"is-style-default","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"1","width":"45%"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"15px"},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"elements":{"link":{"color":{"text":"#454545"}}}},"textColor":"quaternary","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group has-quaternary-color has-text-color has-link-color" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-title {"style":{"typography":{"fontWeight":"500"}}} /-->

<!-- wp:post-excerpt {"excerptLength":10} /-->

<!-- wp:read-more {"content":"Learn more","style":{"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"clamp(24px, 4vw, 40px)","right":"clamp(24px, 4vw, 40px)"}},"elements":{"link":{"color":{"text":"#ffffff"}}},"color":{"background":"#343536"}},"textColor":"white"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results.","style":{"color":{"background":"#343536"}},"textColor":"white"} -->
<p class="has-white-color has-text-color has-background" style="background-color:#343536">We don't have any blog posts right now. Check back again soon!</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->