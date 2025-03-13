<?php

/**
 * Blue Bee FSE: Patterns
 * 
 * This file contains functions to do with with Block Patterns. 
 *
 * @since Blue Bee FSE 1.0
 */

/**
 * Register custom block pattern categories
 */
if (function_exists('register_block_pattern_category')) {

  $pattern_categories = array(
    array(
      'pattern_category_name' => 'headers',
      'args' => array(
        'label' => __('Headers', 'bluebeefse'),
        'description' => __('For use in the Header template part.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'galleries',
      'args' => array(
          'label' => __('Galleries', 'bluebeefse'),
          'description' => __('Show off gorgeous imagery with galleries.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'page-templates',
      'args' => array(
          'label' => __('Page Templates', 'bluebeefse'),
          'description' => __('Use these layouts to construct templates for posts - like the blog.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'team',
      'args' => array(
          'label' => __('Team', 'bluebeefse'),
          'description' => __('Display team information.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'ctas',
      'args' => array(
          'label' => __('Calls to Action', 'bluebeefse'),
          'description' => __('Inspire action in your users with these eye-catching layouts.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'usps',
      'args' => array(
          'label' => __('USPs', 'bluebeefse'),
          'description' => __('Highlight your business\'s strengths with USPs.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'footers',
      'args' => array(
          'label' => __('Footers', 'bluebeefse'),
          'description' => __('For use in the Footer template part.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'banners',
      'args' => array(
        'label' => __('Banners', 'bluebeefse'),
        'description' => __('Ideal for attention-grabbing content placed at the top of pages.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'text-image',
      'args' => array(
          'label' => __('Text/Image', 'bluebeefse'),
          'description' => __('Layouts that combine succinct copy with beautiful imagery.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'accordions',
      'args' => array(
          'label' => __('Accordions', 'bluebeefse'),
          'description' => __('Use accordions to gather complex information into easy to digest chunks.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'cards',
      'args' => array(
          'label' => __('Cards', 'bluebeefse'),
          'description' => __('Use cards to sign-post users to areas of the site, such as services pages.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'video',
      'args' => array(
          'label' => __('Video', 'bluebeefse'),
          'description' => __('Display eye-catching videos with a variaty of layouts.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'blog',
      'args' => array(
          'label' => __('Blog', 'bluebeefse'),
          'description' => __('Automatically showcase your latest posts with these dynamic layouts.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'testimonials',
      'args' => array(
          'label' => __('Testimonials', 'bluebeefse'),
          'description' => __('Provide social proof with these testimonial layouts. Perfect for use as Synced Patterns.', 'bluebeefse'),
      )
    ),
    array(
      'pattern_category_name' => 'logos',
      'args' => array(
          'label' => __('Logos', 'bluebeefse'),
          'description' => __('Show off accreditations, clients and more with these logo layouts.', 'bluebeefse'),
      )
    )
  );

  foreach ($pattern_categories as $pattern_category) {
    register_block_pattern_category($pattern_category['pattern_category_name'], $pattern_category['args']);
  }
}
