/**
 * sidebarOpacity.js - allow for a base Opacity style attribute on any block.
 */
const { __ } = wp.i18n;

/**
 * Conditionally, you can enable this control for certain blocks if you need. Use the array to set the machine name of every block you want to enable this for.
 * If you aren't sure what the machine name is, go into the wp-includes/blocks folder, find the block.json file corresponding to the block you want to include, and copy the 'name' value.
 * 
 * const blockWhitelist = [
 *  'core/image',
 *  'core/paragraph'
 * ];
 * 
 * Within the custom attribute setup below (setOpacityAttribute), right before the object is assigned, you can pull the name from each block and then prevent it from appearing in the sidebar.
 * 
 * if (!blockWhitelist.includes( name ) ) {
 *  return settings;
 * }
 * 
 * Then within the BlockListBlock function below, set a conditional around the <BlockListBlock> declaration and return the replacement props. This will ignore any custom props you set for that block.
 * Of course, this logic can be reversed completely and used to set up a blacklist.
 * 
 * if (!blockWhitelist.includes( props.name ) ) {
 *  return (
 *      <BlockListBlock { ...props } />
 *  );
 * }
 */

const { createHigherOrderComponent } = wp.compose;
const { Fragment, useState } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl, RangeControl } = wp.components;

const blockOpacityAttribute = ( settings, name ) => {
    if (!name.startsWith('core/')) {
        return settings;
    }

    return Object.assign( {}, settings, {
        attributes: Object.assign( {}, settings.attributes, {
            blockOpacity: { type: 'number', default: 100 }, // Default to 100 (full opacity)
        } ),
    } );
};

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'bluebeefse-custom/block-opacity-attribute',
    blockOpacityAttribute
);

const blockOpacityControl = createHigherOrderComponent( ( BlockEdit ) => {
    return ( props ) => {
        
        // If current block is not allowed
    	if (!props.name.startsWith('core/')) {
            return (
                <BlockEdit { ...props } />
            );
        }

        const { attributes, setAttributes } = props;
        const { blockOpacity = 100 } = attributes; // Default to 100

        return (
            <Fragment>
                <BlockEdit { ...props } />
                <InspectorControls group="styles">
                    <PanelBody>
                        <RangeControl
                            help="Select the opacity level for this block."
                            label="Opacity"
                            max={ 100 }
                            min={ 0 }
                            value={ blockOpacity }
                            onChange={ ( newBlockOpacity = 100 ) => { // Default to 100 if no value
                                setAttributes({ blockOpacity: newBlockOpacity });
                            } }
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'blockOpacityControl' );

wp.hooks.addFilter(
    'editor.BlockEdit',
    'bluebeefse-custom/block-opacity-control',
    blockOpacityControl
);

const blockOpacityListBlock = createHigherOrderComponent( ( BlockListBlock ) => {
    return ( props ) => {
        const { attributes } = props;
        const { blockOpacity = 100 } = attributes; // Default to 100 if not set
        
        // Apply the opacity to the block wrapper for editor display
        const updatedWrapperProps = {
            ...props.wrapperProps,
            style: {
                ...props.wrapperProps?.style,
                opacity: blockOpacity !== 100 ? blockOpacity / 100 : undefined, // Only apply if not 100
            },
        };

        return <BlockListBlock { ...props } wrapperProps={ updatedWrapperProps } />;
    };
}, 'blockOpacityListBlock' );

wp.hooks.addFilter(
    'editor.BlockListBlock',
    'bluebeefse-custom/block-opacity-list-block',
    blockOpacityListBlock
);

const blockOpacitySave = ( extraProps, blockType, attributes ) => {
    const { blockOpacity } = attributes;

    // Only apply opacity style if blockOpacity is explicitly set and different from default (100)
    if ( blockOpacity !== undefined && blockOpacity !== 100 ) {
        extraProps.style = {
            ...extraProps.style, // Preserve other styles
            opacity: blockOpacity / 100, // Apply opacity if not default
        };
    }

    return extraProps;
};

wp.hooks.addFilter(
    'blocks.getSaveContent.extraProps',
    'bluebeefse-custom/block-opacity-save',
    blockOpacitySave
);