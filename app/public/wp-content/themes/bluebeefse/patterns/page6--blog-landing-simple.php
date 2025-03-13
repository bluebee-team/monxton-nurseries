<?php
/**
 * Title: Page 6 - Blog Landing Page (Simple)
 * Slug: bluebeefse/page6--blog-landing-simple
 * Inserter: true
 * Categories: page-templates
 */
?>

<!-- wp:group {"metadata":{"name":"Blog Landing Page 1"},"style":{"spacing":{"padding":{"top":"clamp(40px, 7.5vw, 82px)","bottom":"clamp(40px, 7.5vw, 82px)"},"blockGap":"clamp(24px, 4vw, 35px)"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:clamp(40px, 7.5vw, 82px);padding-bottom:clamp(40px, 7.5vw, 82px)"><!-- wp:group {"style":{"spacing":{"blockGap":"15px"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:columns -->
        <div class="wp-block-columns"><!-- wp:column {"width":"50%"} -->
            <div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading -->
                <h2 class="wp-block-heading">Enter blog landing page title here</h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
    <!-- /wp:group -->

    <!-- wp:categories {"showOnlyTopLevel":true,"showEmpty":true,"fontSize":"h6"} /-->

    <!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":"1","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
    <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"}},"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"customOverlayColor":"#FFF","minHeight":280,"gradient":"blue-gradient","contentPosition":"top left","isDark":false,"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"28px","right":"28px"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-cover is-light has-custom-content-position is-position-top-left" style="padding-top:10px;padding-right:28px;padding-bottom:10px;padding-left:28px;min-height:280px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-gradient has-blue-gradient-gradient-background" style="background-color:#FFF"></span><div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"#ffffff"}}},"typography":{"textTransform":"uppercase"},"spacing":{"padding":{"top":"5px","bottom":"5px","left":"18px","right":"18px"}}},"backgroundColor":"secondary","textColor":"quinary","fontSize":"h6"} /--></div></div>
        <!-- /wp:cover -->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"margin":{"top":"0","bottom":"0"},"blockGap":"10px"},"elements":{"link":{"color":{"text":"#ffffff"}}}},"backgroundColor":"black","textColor":"white","layout":{"type":"constrained","justifyContent":"left"}} -->
        <div class="wp-block-group has-white-color has-black-background-color has-text-color has-background has-link-color" style="margin-top:0;margin-bottom:0;padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:post-title {"style":{"typography":{"fontWeight":"500"}},"fontSize":"h4"} /-->

            <!-- wp:post-excerpt {"moreText":"","excerptLength":10,"style":{"elements":{"link":{"color":{"text":"#E53FAB"},":hover":{"color":{"text":"#CEFF00"}}}}},"fontSize":"h6"} /-->

            <!-- wp:read-more {"content":"Learn more","style":{"elements":{"link":{"color":{"text":"#ffffff"}}},"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"32px","right":"32px"},"margin":{"top":"22px"}}},"backgroundColor":"primary","textColor":"quinary","fontSize":"h6"} /--></div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->

        <!-- wp:query-no-results -->
        <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
        <p>We don't have any blog posts right now. Check back again soon!</p>
        <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->

        <!-- wp:group {"style":{"spacing":{"margin":{"top":"clamp(24px, 4vw, 48px)"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="margin-top:clamp(24px, 4vw, 48px)"><!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false,"layout":{"type":"flex","justifyContent":"center"}} -->
            <!-- wp:query-pagination-previous /-->

            <!-- wp:query-pagination-numbers /-->

            <!-- wp:query-pagination-next /-->
            <!-- /wp:query-pagination --></div>
        <!-- /wp:group --></div>
    <!-- /wp:query --></div>
<!-- /wp:group -->