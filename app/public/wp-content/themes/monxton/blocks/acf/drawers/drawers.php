<?php
/**
 * Drawers Block.
 */
$drawers_template = array(
    array(
        'acf/drawer-item',
        array(
            'name' => 'acf/drawer-item',
            'data' => array(),
            'mode' => 'preview'
        ),
        array(
            array(
                'core/group',
                array(
                    'style' => array(
                        'spacing' => array(
                            'blockGap' => 'var:preset|spacing|small-secondary',
                        )
                    ),
                    'layout' => array(
                        'type' => 'constrained',
                        'justifyContent' => 'left'
                    )
                ),
                array(
                    array(
                        'core/group',
                        array(
                            'layout' => array(
                                'type' => 'constrained',
                                'justifyContent' => 'left'
                            )
                        ),
                        array(
                            array(
                                'core/image',
                                array(
                                    'id' => 688,
                                    'width' => 'auto',
                                    'height' => '40px',
                                    'sizeSlug' => 'full',
                                    'linkDestination' => 'none'
                                ),
                                array()
                            ),

                        )
                    ),
                    array(
                        'core/heading',
                        array(
                            'level' => 3,
                            'fontSize' => 'h-4'
                        ),
                        array()
                    ),

                )
            ),
            array(
                'core/group',
                array(
                    'layout' => array(
                        'type' => 'constrained'
                    )
                ),
                array(
                    array(
                        'core/heading',
                        array(
                            'level' => 4
                        ),
                        array()
                    ),
                    array(
                        'core/paragraph',
                        array(),
                        array()
                    ),

                )
            ),

        )
    ),
);

$max_columns = get_field('max_columns');
?>
<InnerBlocks class="wp-block-drawers max-drawers-<?php echo $max_columns; ?>" template="<?php echo esc_attr( wp_json_encode( $drawers_template ) ); ?>" />
