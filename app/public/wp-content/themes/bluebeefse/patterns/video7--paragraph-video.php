<?php
/**
 * Title: Video 7 - Paragraph and Video
 * Slug: bluebeefse/video7--paragraph-video
 * Inserter: true
 * Categories: video
 */
?>

<!-- wp:group {"metadata":{"name":"Video 7"},"style":{"spacing":{"padding":{"top":"clamp(40px, 7.5vw, 82px)","bottom":"clamp(40px, 7.5vw, 82px)"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:clamp(40px, 7.5vw, 82px);padding-bottom:clamp(40px, 7.5vw, 82px)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Enter block title text here</h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minin.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Watch in full</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:cover {"url":"<?php bb_theme_asset("videos/blue-bee-example-video.mp4"); ?>","id":292,"dimRatio":0,"backgroundType":"video","minHeight":25,"minHeightUnit":"vw","layout":{"type":"constrained"}} -->
<div class="wp-block-cover" style="min-height:25vw"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="<?php bb_theme_asset("videos/blue-bee-example-video.mp4"); ?>" data-object-fit="cover"></video><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
<p class="has-text-align-center"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->