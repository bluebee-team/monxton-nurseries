<?php
/**
 * Title: Blog Cards 3 -- Masonry Layout
 * Slug: bluebeefse/blogcards3--masonry-layout
 * Inserter: true
 * Categories: blog
 */
?>

<!-- wp:group {"metadata":{"name":"Blog Cards 3"},"style":{"spacing":{"padding":{"top":"clamp(40px, 7.5vw, 82px)","bottom":"clamp(40px, 7.5vw, 82px)"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:clamp(40px, 7.5vw, 82px);padding-bottom:clamp(40px, 7.5vw, 82px)"><!-- wp:group {"layout":{"type":"constrained"}} -->
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

<!-- wp:query {"queryId":0,"query":{"perPage":"6","pages":"1","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[]}},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"is-style-masonry-layout","layout":{"type":"grid","columnCount":4}} -->
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":20,"isUserOverlayColor":true,"minHeight":20,"minHeightUnit":"vw","gradient":"primary","contentPosition":"bottom left","style":{"spacing":{"padding":{"top":"clamp(24px, 4vw, 40px)","bottom":"clamp(24px, 4vw, 40px)","left":"clamp(24px, 4vw, 40px)","right":"clamp(24px, 4vw, 40px)"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="padding-top:clamp(24px, 4vw, 40px);padding-right:clamp(24px, 4vw, 40px);padding-bottom:clamp(24px, 4vw, 40px);padding-left:clamp(24px, 4vw, 40px);min-height:20vw"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim has-background-gradient has-primary-gradient-background"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"elements":{"link":{"color":{"text":"#ffffff"}}}},"textColor":"white","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group has-white-color has-text-color has-link-color"><!-- wp:post-title {"style":{"typography":{"fontWeight":"500"}}} /-->

<!-- wp:read-more {"content":"Learn more","style":{"elements":{"link":{"color":{"text":"#ffffff"}}},"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"clamp(24px, 4vw, 40px)","right":"clamp(24px, 4vw, 40px)"}},"color":{"background":"#343536"}},"textColor":"white"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results.","style":{"color":{"background":"#343536"},"elements":{"link":{"color":{"text":"#ffffff"}}}},"textColor":"white"} -->
<p class="has-white-color has-text-color has-background has-link-color" style="background-color:#343536">We don't have any blog posts right now. Check back again soon!</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->