<?php
/**
 * Title: Page 4 - Blog Post Featured Image above Article
 * Slug: bluebeefse/page4--blog-post-large-img
 * Inserter: true
 * Categories: page-templates
 */
?>

<!-- wp:group {"layout":{"type":"constrained"},"metadata":{"name":"Blog Post 2"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"28px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
    <div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"#ffffff"}}},"typography":{"textTransform":"uppercase"},"spacing":{"padding":{"top":"5px","bottom":"5px","left":"18px","right":"18px"}}},"backgroundColor":"secondary","textColor":"quinary","fontSize":"h6"} /-->

        <!-- wp:post-date {"style":{"elements":{"link":{"color":{"text":"#333333"}}}},"textColor":"secondary"} /--></div>
    <!-- /wp:group -->

    <!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column {"width":"66%"} -->
        <div class="wp-block-column" style="flex-basis:66%"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"level":1,"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"clamp(24px, 4vw, 40px)","bottom":"clamp(24px, 4vw, 40px)"}}}} /--></div>
            <!-- /wp:group --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"auto","height":"400px"} /--></div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"clamp(24px, 4vw, 48px)","left":"clamp(40px, 7.5vw, 82px)"},"margin":{"top":"clamp(24px, 4vw, 48px)"}}}} -->
    <div class="wp-block-columns" style="margin-top:clamp(24px, 4vw, 48px)"><!-- wp:column {"width":"55%"} -->
        <div class="wp-block-column" style="flex-basis:55%"><!-- wp:post-content /--></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"position":{"type":"sticky","top":"0px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":5,"fontSize":"p"} -->
                    <h5 class="wp-block-heading has-p-font-size">Share this post</h5>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:group --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"clamp(24px, 4vw, 48px)","bottom":"clamp(24px, 4vw, 35px)"}},"border":{"bottom":{"color":"#333333","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group" style="border-bottom-color:#333333;border-bottom-width:1px;padding-top:clamp(24px, 4vw, 48px);padding-bottom:clamp(24px, 4vw, 35px)"><!-- wp:post-navigation-link {"type":"previous","showTitle":true,"linkLabel":true,"arrow":"chevron","style":{"elements":{"link":{"color":{"text":"#E53FAB"}}}},"textColor":"primary"} /-->

        <!-- wp:post-navigation-link {"showTitle":true,"linkLabel":true,"arrow":"chevron","style":{"elements":{"link":{"color":{"text":"#E53FAB"}}}},"textColor":"primary"} /--></div>
    <!-- /wp:group --></div>
<!-- /wp:group -->