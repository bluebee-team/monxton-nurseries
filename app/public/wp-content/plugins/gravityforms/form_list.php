<?php

if ( ! class_exists( 'GFForms' ) ) {
	die();
}

class GFFormList {

	public static function form_list_page() {
		global $wpdb;

		if ( ! GFCommon::ensure_wp_version() ) {
			return;
		}

		wp_print_styles( array( 'thickbox' ) );

		add_action( 'admin_print_footer_scripts', array( __class__, 'output_form_list_script_block' ), 20 );

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

		?>

		<script type="text/javascript">
			// checked by the ToggleActive method to prevent errors when form status icon is clicked before page has fully loaded
			var gfPageLoaded = false;
		</script>

		<style type="text/css">



		</style>

		<?php if ( GFCommon::current_user_can_any( 'gravityforms_create_form' ) ) { ?>
		<div id="gf_new_form_modal" style="display:none;">
				<div class="gform-settings__wrapper ">
					<div class="gform-settings-panel__content">
						<form class="gform_new_form_modal_container" onsubmit="saveNewForm();return false;">
                            <div id="gf_new_form_error_message" ></div>
							<div class="setting-row gform-settings-field gform-settings-field__text">
								<label class="gform-settings-label" for="new_form_title"><?php esc_html_e( 'Form Title', 'gravityforms' ); ?>
									<span class="gfield_required">*</span></label>
                                <div class="gform-settings-input__container">
                                    <input type="text" class="regular-text" value="" id="new_form_title" tabindex="9000">                                         </div>
							</div>

							<div class="setting-row">
								<label class="gform-settings-label" for="new_form_description"><?php esc_html_e( 'Form Description', 'gravityforms' ); ?></label>
								<textarea class="regular-text" id="new_form_description" tabindex="9001"></textarea>
							</div>

							<div class="submit-row">
								<?php
								/**
								 * Allows for modification of the "New Form" button HTML
								 *
								 * @param string The HTML rendered for the "New Form" button.
								 */
								echo apply_filters( 'gform_new_form_button', '<button type="submit" value="save" id="save_new_form" class="button large primary" tabindex="9002">' . esc_html__( 'Create Form', 'gravityforms' ) . '</button>' ); ?>
							</div>
						</form>
					</div>
				</div>
		</div>

		<?php } // - end of new form modal - // ?>

		<script text="text/javascript">
			function TrashForm(form_id) {
				jQuery("#single_action_argument").val(form_id);
				jQuery("#single_action").val("trash");
				jQuery("#form_list_form")[0].submit();
			}

			function RestoreForm(form_id) {
				jQuery("#single_action_argument").val(form_id);
				jQuery("#single_action").val("restore");
				jQuery("#form_list_form")[0].submit();
			}

			function DeleteForm(form_id) {
				jQuery("#single_action_argument").val(form_id);
				jQuery("#single_action").val("delete");
				jQuery("#form_list_form")[0].submit();
			}

			function ConfirmDeleteForm(form_id){
				if( confirm(<?php echo json_encode( __( 'WARNING: You are about to delete this form and ALL entries associated with it. ', 'gravityforms' ) . esc_html__( 'Cancel to stop, OK to delete.', 'gravityforms' ) ); ?>) ){
					DeleteForm(form_id);
				}
			}

			function DuplicateForm(form_id) {
				jQuery("#single_action_argument").val(form_id);
				jQuery("#single_action").val("duplicate");
				jQuery("#form_list_form")[0].submit();
			}

			function ToggleActive( btn, form_id ) {

				if ( ! gfPageLoaded ) {
					return;
				}

				var is_active = jQuery( btn ).hasClass( 'gform-status--active' );

				jQuery.ajax(
					{
						url:      '<?php echo admin_url( 'admin-ajax.php' ); ?>',
						method:   'POST',
						dataType: 'json',
						data: {
							action: 'rg_update_form_active',
							rg_update_form_active: '<?php echo wp_create_nonce( 'rg_update_form_active' ); ?>',
							form_id: form_id,
							is_active: is_active ? 0 : 1,
						},
						success:  function() {
							UpdateCount( 'active_count', is_active ? -1 : 1 );
							UpdateCount( 'inactive_count', is_active ? 1 : -1 );

							if ( is_active ) {
								setToggleInactive();
							} else {
								setToggleActive();
							}
						},
						error:    function() {
							if ( ! is_active ) {
								setToggleInactive();
							} else {
								setToggleActive();
							}

							alert( '<?php echo esc_js( __( 'Ajax error while updating form', 'gravityforms' ) ); ?>' );
						}
					}
				);

				function setToggleInactive() {
					jQuery( btn ).removeClass( 'gform-status--active' ).addClass( 'gform-status--inactive' ).find( '.gform-status-indicator-status' ).html( <?php echo wp_json_encode( esc_attr__( 'Inactive', 'gravityforms' ) ); ?> );
				}

				function setToggleActive() {
					jQuery( btn ).removeClass( 'gform-status--inactive' ).addClass( 'gform-status--active' ).find( '.gform-status-indicator-status' ).html( <?php echo wp_json_encode( esc_attr__( 'Active', 'gravityforms' ) ); ?> );
				}

			}
			function UpdateCount(element_id, change) {
				var element = jQuery("#" + element_id);
				var count = parseInt(element.html(),10) + change;
				if( count < 0 ) {
					return;
				}
				element.html(count + "");
			}

			function gfConfirmBulkAction(element_id) {
				var element = "#" + element_id;
				if (jQuery(element).val() == 'delete')
					return confirm(<?php echo json_encode( __( 'WARNING: You are about to delete these forms and ALL entries associated with them. ', 'gravityforms' ) . __( "'Cancel' to stop, 'OK' to delete.", 'gravityforms' ) ); ?>);
				else if (jQuery(element).val() == 'reset_views')
					return confirm(<?php echo json_encode( __( 'Are you sure you would like to reset the Views for the selected forms? ', 'gravityforms' ) . __( "'Cancel' to stop, 'OK' to reset.", 'gravityforms' ) ); ?>);
				else if (jQuery(element).val() == 'delete_entries')
					return confirm(<?php echo json_encode( __( 'WARNING: You are about to delete ALL entries associated with the selected forms. ', 'gravityforms' ) . __( "'Cancel' to stop, 'OK' to delete.", 'gravityforms' ) ); ?>);

				return true;
			}
		</script>
        <?php
                GFForms::admin_header( array(), false );
                $table = new GF_Form_List_Table();
                $table->process_action();
		?>

                <div class="gform-settings-panel__content form-list">
                    <div class="form-list-head">
                    <h2> <?php esc_html_e( 'Forms', 'gravityforms' ); ?> </h2>
                        <?php if ( GFCommon::current_user_can_any( 'gravityforms_create_form' ) ) {
                            echo '<button class="button gform-add-new-form primary add-new-h2" data-js="gform-add-new-form">' . esc_html__( 'Add New', 'gravityforms' ) . '</button>';
                        } ?>
                    </div>
                    <div class="form-list-nav">
                        <?php
                        $table->views();
                        $table->prepare_items();
                        ?>
                        <form id="form_list_search" method="get">
                    <input type="hidden" value="gf_edit_forms" name="page" />
                    <?php
                        if ( rgget( 'filter' ) ) {
                            echo '<input type="hidden" value="' . esc_attr( rgget( 'filter' ) ) . '" name="filter" />';
                        }

                        $table->search_box( esc_html__( 'Search Forms', 'gravityforms' ), 'form' );
                    ?>
                    </form>
                    </div>
                    <form id="form_list_form" method="post">
                    <?php $table->display(); ?>
                    </form>
                </div>
	<?php
		GFForms::admin_footer();
	}

	public static function save_new_form() {

		if ( ! check_admin_referer( 'gf_save_new_form', 'gf_save_new_form' ) ) {
			die( json_encode( array( 'error' => __( 'There was an issue creating your form.', 'gravityforms' ) ) ) );
		}

		GFFormsModel::ensure_tables_exist();

		require_once( GFCommon::get_base_path() . '/form_detail.php' );

		$form_json = rgpost( 'form', false );

		$form = json_decode( stripslashes( $form_json ), true );

		if ( empty( $form['title'] ) ) {
			$result = array( 'error' => __( 'Please enter a form title.', 'gravityforms' ) );
			die( json_encode( $result ) );
		}

		$result = GFFormDetail::save_form_info( 0, $form_json );

		switch ( rgar( $result, 'status' ) ) {
			case 'invalid_json':
				$result['error'] = __( 'There was an issue creating your form.', 'gravityforms' );
				die( json_encode( $result ) );

			case 'duplicate_title':
				$result['error'] = __( 'Please enter a unique form title.', 'gravityforms' );
				die( json_encode( $result ) );

			default:
				$form_id = absint( $result['status'] );
				die( json_encode( array( 'redirect' => admin_url( "admin.php?page=gf_edit_forms&id={$form_id}&isnew=1" ) ) ) );
		}
	}

	public static function output_form_list_script_block() {
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				$( 'body' ).addClass( 'gform_new_form' );
				// load new form modal on New Form page
				<?php if ( GFForms::get_page_query_arg() == 'gf_new_form' && ! rgget( 'paged' ) ) :    ?>
					loadNewFormModal();
				<?php endif; ?>

				// form settings submenu support
				$( '.gf_form_action_has_submenu' ).hover( function() {
					var $this = $( this );
					var offset = $this.offset();
					var docHeight = $( document ).height();
					var $subMenu = $this.find( '.gform-form-toolbar__submenu' );
					var menuHeight = $subMenu.height();
					var spaceAvailable = docHeight - offset.top;

					// If less space available below submenu than height of it, set height explicitly
					// If not height is handled by a max height directive in toolbar.pcss component.
					if ( spaceAvailable < menuHeight ) {
						$subMenu.height( spaceAvailable - 50 );
					}

					$subMenu
						.toggle()
						.offset( { left: offset.left } );
				}, function() {
					$( this ).find( '.gform-form-toolbar__submenu' )
						.css( 'height', '' )
						.hide();
				} );

				// enable form status icons
				gfPageLoaded = true;
				$( '.gform_active_icon' ).removeClass( 'gf_not_ready' );

				$( '#current-page-selector' ).keyup( function( event ) {
					if ( event.keyCode == 13 ) {
						var url = <?php echo json_encode( esc_url_raw( remove_query_arg( 'paged' ) ) ); ?>;
						var page = parseInt( this.value );
						document.location = url + '&paged=' + page;
						event.preventDefault();
					}
				} );

			} );

			function loadNewFormModal() {
				return;
				resetNewFormModal();
				tb_show(<?php echo json_encode( '<div class="tb-title"><div class="tb-title__logo"></div><div class="tb-title__text"><div class="tb-title__main">'.esc_html__( 'Create a New Form', 'gravityforms' ).'</div><div class="tb-title__sub">'.esc_html__('Provide a title and a description for this form', 'gravityforms').'</div></div></div>' ); ?>, '#TB_inline?width=490&amp;height=auto&amp;inlineId=gf_new_form_modal');
				jQuery('#new_form_title').focus();

				return false;
			}

			function saveNewForm() {

				var createButton = jQuery('#save_new_form');
				var spinner = new gfAjaxSpinner(createButton, gf_vars.baseUrl + '/images/spinner.svg');

				// clear error message
				jQuery('#gf_new_form_error_message').html('');
				jQuery('#gf_new_form_error_message').removeClass( 'alert error' );

				var origVal = createButton.val();
				createButton.val(<?php echo json_encode( esc_html__( 'Creating Form...', 'gravityforms' ) ); ?>);

				var form = {
					title: jQuery('#new_form_title').val(),
					description: jQuery('#new_form_description').val(),
					labelPlacement:'top_label',
					descriptionPlacement:'below',
					validationPlacement:'below',
					button: {
						type: 'text',
						text: <?php echo json_encode( esc_html__( 'Submit', 'gravityforms' ) ); ?>,
						imageUrl : ''
					},
					fields:[]
				}

				jQuery.post(ajaxurl, {
					form: jQuery.toJSON(form),
					action: 'gf_save_new_form',
					gf_save_new_form: <?php echo json_encode( wp_create_nonce( 'gf_save_new_form' ) ); ?>
				}, function(response){

					spinner.destroy();

					var respData = jQuery.parseJSON(response);

					if(respData['error']) {
						// adding class later otherwise WP moves box up to the top of the page
						jQuery('#gf_new_form_error_message').addClass( 'alert error' );
						jQuery('#gf_new_form_error_message').html( respData.error );

						addInputErrorIcon( '#new_form_title' );
						createButton.val(origVal);
					} else {
						location.href = respData.redirect;
						createButton.val(<?php echo json_encode( esc_html__( 'Saved! Redirecting...', 'gravityforms' ) ); ?>);
					}

				});

			}

			function resetNewFormModal() {
				jQuery('#new_form_title').val('');
				jQuery('#new_form_description').val('');
				jQuery('#gf_new_form_error_message').html('');
				jQuery('#gf_new_form_error_message').html('');
				jQuery('#gf_new_form_error_message').removeClass( 'error alert' );
				removeInputErrorIcons( '.gform_new_form_modal_container' );
			}

			function addInputErrorIcon( elem ) {
				var elem = jQuery(elem);
				elem.after( '<span class="gform-settings-field__feedback gform-settings-field__feedback--invalid" aria-hidden="true"></span>' );
			}

			function removeInputErrorIcons( elem ) {
				var elem = jQuery(elem);
				elem.find('span.gform-settings-field__feedback--invalid').remove();
			}

		</script>

	<?php
	}

	/**
	 * Returns the markup for the screen options.
	 *
	 * @since 2.9.2
	 *
	 * @param $status
	 * @param $args
	 *
	 * @return string
	 */
	public static function get_screen_options_markup( $status, $args ) {

		$return = $status;
		if ( ! GFForms::get_page() == 'form_list' ) {
			return $return;
		}

		$screen_options = self::get_screen_options_values();

		$per_page    = rgar( $screen_options, 'per_page' );
		$sort_order  = rgar( $screen_options, 'sort_order' );
		$sort_column = rgar( $screen_options, 'sort_column' );

		$pagination_title     = esc_html__( 'Pagination', 'gravityforms' );
		$per_page_label       = esc_html__( 'Forms per page:', 'gravityforms' );
		$sort_options_title   = esc_html__( 'Sorting Options', 'gravityforms' );
		$sort_column_dropdown = self::get_screen_option_dropdown( 'order_by', $sort_column );
		$sort_order_dropdown  = self::get_screen_option_dropdown( 'sort_order', $sort_order );
		$button               = get_submit_button( esc_html__( 'Apply', 'gravityforms' ), 'button button-primary', 'screen-options-apply', false );


		$return .= "
			<fieldset class='screen-options'>
			<legend>{$pagination_title}</legend>
				<label for='gform_per_page'>{$per_page_label}</label>
				<input type='number' step='1' min='1' class='screen-per-page' name='gform_per_page' id='gform_per_page' value='{$per_page}' />
				<input type='hidden' name='wp_screen_options[option]' value='gform_forms_screen_options' />
				<input type='hidden' name='wp_screen_options[value]' value='yes' />
			</fieldset>
			<fieldset class='screen-options'>
				<legend>{$sort_options_title}</legend>
				{$sort_column_dropdown}
				{$sort_order_dropdown}
			</fieldset>
			<p class='submit'>$button</p>";

		return $return;
	}

	/**
	 * Returns the attributes for the user-specific screen options.
	 *
	 * @since 2.9.2
	 *
	 * @return array Label and choices for the screen options settings.
	 */
	public static function get_screen_options_attributes() {
		return array(
			'order_by' => array(
				'label'   => __( 'Default Sort Column', 'gravityforms' ),
				'choices' => array(
					'is_active'   => __( 'Status', 'gravityforms' ),
					'title'       => __( 'Title', 'gravityforms' ),
					'id'          => __( 'ID', 'gravityforms' ),
					'entry_count' => __( 'Entries', 'gravityforms' ),
					'view_count'  => __( 'Views', 'gravityforms' ),
					'conversion'  => __( 'Conversion', 'gravityforms' ),
				),
			),
			'sort_order' => array(
				'label'   => __( 'Default Sort Order', 'gravityforms' ),
				'choices' => array(
					'ASC'  => __( 'Ascending', 'gravityforms' ),
					'DESC' => __( 'Descending', 'gravityforms' ),
				),
			),
		);
	}

	/*
	 * Returns the dropdown markup for a screen option setting.
	 *
	 * @since 2.9.2
	 *
	 * @param string $name The name of the screen option setting.
	 *
	 * @return string HTML markup for the dropdown.
	 */
	public static function get_screen_option_dropdown( $name ) {
		$attributes = rgar( self::get_screen_options_attributes(), $name );

		if( ! $attributes ) {
			return '';
		}

		$dropdown = '<label for="' . esc_attr( $name ) . '">' . esc_html( $attributes['label'] ) . ':&nbsp;</label>';
		$dropdown .= '<select name="' . esc_attr( $name ) . '" style="margin-inline-end: 15px">';
		foreach( $attributes['choices'] as $value => $label ) {
			$saved_value = self::get_screen_options_values();
			$dropdown .= '<option value="' . esc_attr( $value ) . '"' . selected( $value, $saved_value[$name], false ) . '>' . esc_html( $label ) . '</option>';
		}
		$dropdown .= '</select>';

		return $dropdown;
	}

	/**
	 * Returns the values for the user-specific screen options. If not saved by the current user, the default values are returned.
	 *
	 * @since 2.9.2
	 * @return array
	 */
	public static function get_screen_options_values() {
		$default_values = array(
			'per_page'   => 20,
			'order_by'   => 'title',
			'sort_order' => 'ASC',
		);

		$option_values = get_user_option( 'gform_forms_screen_options' );

		// Prior to 2.9.2, the per_page value was stored in a separate option.
		$old_per_page = get_user_option( 'gform_forms_per_page' );
		if( $old_per_page && ! is_array( $option_values ) ) {
			$option_values = array( 'per_page' => $old_per_page );
		} elseif( $old_per_page && is_array( $option_values ) && ! rgar( $option_values, 'per_page' ) ) {
			$option_values['per_page'] = $old_per_page;
		}


 		if ( empty( $option_values ) || ! is_array( $option_values ) ) {
			$option_values = array();
		}

		return array_merge( $default_values, $option_values );
	}
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class GF_Form_List_Table extends WP_List_Table {

	public $filter = '';

	public $locking_info;

	public function __construct( $args = array() ) {
		parent::__construct( $args );
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable, 'title' );
		$this->locking_info    = new GFFormLocking();
		$this->filter          = rgget( 'filter' );
	}

	function get_sortable_columns() {
		return array(
			'is_active'   => array( 'is_active', false ),
			'title'       => array( 'title', false ),
			'id'          => array( 'id', false ),
			'entry_count' => array( 'entry_count', false ),
			'view_count'  => array( 'view_count', false ),
			'conversion'  => array( 'conversion', false ),
		);
	}

	function get_views() {
		$form_count = RGFormsModel::get_form_count();

		/**
		 * Allow for form count filtering.
		 * Useful when form list is being filtered.
		 *
		 * @since 2.3-beta-3
		 *
		 * @param array $form_count The form count by filter name.
		 */
		$form_count = apply_filters( 'gform_form_list_count', $form_count );
  
		$imported_forms = rgget( 'id' ) ? array_map( 'intval' ,explode( ',', rgget( 'id' )) ) : [];

		$all_class = $imported_forms ? '' : ( $this->filter == '' ? 'current' : '' );

		$active_class = ( $this->filter == 'active' ) ? 'current' : '';

		$inactive_class = ( $this->filter == 'inactive' ) ? 'current' : '';

		$trash_class = ( $this->filter == 'trash' ) ? 'current' : '' ;

		$views = array(
			'all' => '<a class="' . $all_class . '" href="?page=gf_edit_forms">' . esc_html( _x( 'All', 'Form List', 'gravityforms' ) ) . ' <span class="count">(<span id="all_count">' . $form_count['total'] . '</span>)</span></a>',
			'active' => '<a class="' . $active_class . '" href="?page=gf_edit_forms&filter=active">' . esc_html( _x( 'Active', 'Form List', 'gravityforms' ) ) . ' <span class="count">(<span id="active_count">' . $form_count['active'] . '</span>)</span></a>',
			'inactive' => '<a class="' . $inactive_class . '" href="?page=gf_edit_forms&filter=inactive">' . esc_html( _x( 'Inactive', 'Form List', 'gravityforms' ) ) . ' <span class="count">(<span id="inactive_count">' . $form_count['inactive'] . '</span>)</span></a>',
			'trash' => '<a class="' . $trash_class . '" href="?page=gf_edit_forms&filter=trash">' . esc_html( _x( 'Trash', 'Form List', 'gravityforms' ) ) . ' <span class="count">(<span id="trash_count">' . $form_count['trash'] . '</span>)</span></a>',
		);
  
		return $views;
	}

	function prepare_items() {

		$sort_options = GFFormList::get_screen_options_values();

		$sort_column  = empty( $_GET['orderby'] ) ? $sort_options['order_by'] : $_GET['orderby'];
		$sort_columns = array_keys( $this->get_sortable_columns() );

		if ( ! in_array( strtolower( $sort_column ), $sort_columns ) ) {
			$sort_column = 'title';
		}

		$sort_direction = empty( $_GET['order'] ) ? $sort_options['sort_order'] : strtoupper( $_GET['order'] );
		$sort_direction = $sort_direction == 'ASC' ? 'ASC' : 'DESC';
		// Retrieve IDs from Query Parameters
		$imported_forms = rgget( 'id' ) ? explode( ',', rgget( 'id' ) ) : [];
		$ids            = array_map( 'intval', $imported_forms );

		$search_query   = rgget( 's' );
		$trash = false;
		switch ( $this->filter ) {

			case '':
				$active = null;
			break;
			case 'active' :
				$active = true;
				break;
			case 'inactive' :
				$active = false;
				break;
			case 'trash' :
				$active = null;
				$trash = true;
		}

		if ( rgblank( $search_query ) ) {
			$forms = GFFormsModel::get_forms( $active, $sort_column, $sort_direction, $trash );
		} else {
			$forms = GFFormsModel::search_forms( $search_query, $active, $sort_column, $sort_direction, $trash );
		}

		// Filter imported forms by IDs if there is any.
		if ( ! rgempty( $ids ) ) {
			$forms = array_filter( $forms, function ($form) use ($ids) {
				return in_array( $form->id, $ids );
			});
		}

		/**
		 * Allow form list filtering.
		 *
		 * @since 2.3-beta-3
		 *
		 * @param array  $forms          The complete list of forms.
		 * @param string $search_query   The search query string if set.
		 * @param bool   $active         If inactive forms should be displayed.
		 * @param string $sort_column    List column being sorted.
		 * @param string $sort_direction Direction of column sorting.
		 * @param bool   $trash          If trash items should be displayed.
		 */
		$forms = apply_filters( 'gform_form_list_forms', $forms, $search_query, $active, $sort_column, $sort_direction, $trash );

		$per_page = $sort_options['per_page'];

		$per_page = apply_filters( 'gform_page_size_form_list', $per_page );

		$this->set_pagination_args( array(
			'total_items' => count( $forms ),
			'per_page'    => $per_page,
		) );


		if ( in_array( $sort_column, array( 'view_count', 'entry_count', 'conversion' ) ) ) {
			usort( $forms, array( $this, 'compare_' . $sort_column . '_' . $sort_direction ) );
		}

		$offset = ( $this->get_pagenum() - 1 ) * $per_page;

		$this->items = array_slice( $forms, $offset, $per_page );
	}

	function get_bulk_actions() {
		if ( $this->filter == 'trash' ) {
			$actions = array(
				'restore' => esc_html__( 'Restore', 'gravityforms' ),
				'delete' => esc_html__( 'Delete permanently', 'gravityforms' ),
			);
		} else {
			$actions = array(
				'activate' => esc_html__( 'Mark as Active', 'gravityforms' ),
				'deactivate' => esc_html__( 'Mark as Inactive', 'gravityforms' ),
				'reset_views' => esc_html__( 'Reset Views', 'gravityforms' ),
				'delete_entries' => esc_html__( 'Permanently Delete Entries', 'gravityforms' ),
				'trash' => esc_html__( 'Move to trash', 'gravityforms' ),
			);
		}
		return $actions;
	}

	function get_columns() {

		$columns = array(
			'cb'          => '<input type="checkbox" />',
			'is_active'   => esc_html__( 'Status', 'gravityforms' ),
			'title'       => esc_html__( 'Title', 'gravityforms' ),
			'id'          => esc_html__( 'ID', 'gravityforms' ),
			'entry_count' => esc_html__( 'Entries', 'gravityforms' ),
			'view_count'  => esc_html__( 'Views', 'gravityforms' ),
			'conversion'  => esc_html__( 'Conversion', 'gravityforms' ),
		);

		$columns = apply_filters( 'gform_form_list_columns', $columns );

		return $columns;
	}

	function single_row_columns( $item ) {
		list( $columns, $hidden, $sortable, $primary ) = $this->get_column_info();

		foreach ( $columns as $column_name => $column_display_name ) {
			$classes = "$column_name column-$column_name";
			if ( $primary === $column_name ) {
				$classes .= ' has-row-actions column-primary';
			}

			if ( in_array( $column_name, $hidden ) ) {
				$classes .= ' hidden';
			}

			// Comments column uses HTML in the display name with screen reader text.
			// Instead of using esc_attr(), we strip tags to get closer to a user-friendly string.
			$data = 'data-colname="' . wp_strip_all_tags( $column_display_name ) . '"';

			$attributes = "class='$classes' $data";

			if ( 'cb' === $column_name ) {
				echo '<th class="check-column">';
				echo $this->column_cb( $item );
				echo '</th>';
			} elseif ( has_action( 'gform_form_list_column_' . $column_name ) ) {
				echo "<td $attributes>";
				do_action( 'gform_form_list_column_' . $column_name, $item );
				echo $this->handle_row_actions( $item, $column_name, $primary );
				echo '</td>';
			} elseif ( method_exists( $this, '_column_' . $column_name ) ) {
				echo call_user_func(
					array( $this, '_column_' . $column_name ),
					$item,
					$classes,
					$data,
					$primary
				);
			} elseif ( method_exists( $this, 'column_' . $column_name ) ) {
				echo "<td $attributes>";
				echo call_user_func( array( $this, 'column_' . $column_name ), $item );
				echo $this->handle_row_actions( $item, $column_name, $primary );
				echo "</td>";
			} else {
				echo "<td $attributes>";
				echo $this->column_default( $item, $column_name );
				echo $this->handle_row_actions( $item, $column_name, $primary );
				echo "</td>";
			}
		}
	}


	function get_primary_column_name() {
		return 'title';
	}

	function _column_is_active( $form, $classes, $data, $primary ) {
		echo '<td class="manage-column column-is_active">';
		if ( $this->filter !== 'trash' ) {
			if ( $form->is_active ) {
				$class = 'gform-status--active';
				$text  = esc_html__( 'Active', 'gravityforms' );
			} else {
				$class = 'gform-status--inactive';
				$text  = esc_html__( 'Inactive', 'gravityforms' );
			}
			?>
			<button
				type="button"
				class="gform-status-indicator gform-status-indicator--size-sm gform-status-indicator--theme-cosmos <?php echo esc_attr( $class ); ?>"
				onclick="ToggleActive( this, <?php echo absint( $form->id ); ?> );"
				onkeypress="ToggleActive( this, <?php echo absint( $form->id ); ?> );"
			>
				<span class="gform-status-indicator-status gform-typography--weight-medium gform-typography--size-text-xs">
					<?php echo esc_html( $text ); ?>
				</span>
			</button>
			<?php
		}
		echo '</td>';
	}

	function column_title( $form ) {
		echo '<strong><a href="?page=gf_edit_forms&id='. absint( $form->id ) .'" aria-label="' . esc_attr( $form->title ) . ' ' . esc_attr( '(Edit)', 'gravityforms' ) . '">' . esc_html( $form->title ) . '</a></strong>';
	}

	function column_id( $form ) {
		echo '<a href="?page=gf_edit_forms&id='. absint( $form->id ) .'">' .absint( $form->id ) . '</a>';
	}

	function column_view_count( $form ) {
		echo absint( $form->view_count );
	}

	function column_entry_count( $form ) {
		echo '<a href="?page=gf_entries&id='. absint( $form->id ) .'">' . absint( $form->entry_count ) . '</a>';
	}

	function column_conversion( $form ) {
		$conversion = '0%';
		if ( $form->view_count > 0 ) {
			$conversion = ( (float) number_format( $form->entry_count / $form->view_count, 3 ) * 100 ) . '%';
		}
		echo $conversion;
	}

	function column_cb( $form ) {
		$form_id = $form->id;
		?>
		<label class="screen-reader-text" for="cb-select-<?php echo esc_attr( $form_id ); ?>"><?php _e( 'Select form' ); ?></label>
		<input type="checkbox" class="gform_list_checkbox" name="form[]" value="<?php echo esc_attr( $form_id ); ?>" />
		<?php
		$this->locking_info->lock_indicator();
	}

	protected function handle_row_actions( $form, $column_name, $primary ) {

		if ( $primary !== $column_name ) {
			return '';
		}

		?>
		<div class="row-actions">
			<?php

			if ( $this->filter == 'trash' ) {
				$form_actions['restore'] = array(
					'label'        => __( 'Restore', 'gravityforms' ),
					'url'          => '#',
					'onclick'      => 'RestoreForm(' . absint( $form->id ) . ');',
					'onkeypress'   => 'RestoreForm(' . absint( $form->id ) . ');',
					'capabilities' => 'gravityforms_delete_forms',
					'priority'     => 600,
				);
				$form_actions['delete']  = array(
					'label'        => __( 'Delete permanently', 'gravityforms' ),
					'menu_class'   => 'delete',
					'url'          => '#',
					'onclick'      => 'ConfirmDeleteForm(' . absint( $form->id ) . ');',
					'onkeypress'   => 'ConfirmDeleteForm(' . absint( $form->id ) . ');',
					'capabilities' => 'gravityforms_delete_forms',
					'priority'     => 500,
				);

			} else {

				$this->locking_info->lock_info( $form->id );

				require_once( GFCommon::get_base_path() . '/form_settings.php' );

				$form_actions = GFForms::get_toolbar_menu_items( $form->id, true );

				$form_actions['duplicate'] = array(
					'label'        => __( 'Duplicate', 'gravityforms' ),
					'url'          => '#',
					'onclick'      => 'DuplicateForm(' . absint( $form->id ) . ');return false;',
					'onkeypress'   => 'DuplicateForm(' . absint( $form->id ) . ');return false;',
					'capabilities' => 'gravityforms_create_form',
					'priority'     => 600,
				);

				$form_actions['trash'] = array(
					'label'        => __( 'Trash', 'gravityforms' ),
					'aria-label'        => __( 'Move this form to the trash', 'gravityforms' ),
					'url'          => '#',
					'onclick'      => 'TrashForm(' . absint( $form->id ) . ');return false;',
					'onkeypress'   => 'TrashForm(' . absint( $form->id ) . ');return false;',
					'capabilities' => 'gravityforms_delete_forms',
					'menu_class'   => 'trash',
					'priority'     => 500,
				);

			}

			$form_actions = apply_filters( 'gform_form_actions', $form_actions, $form->id );

			echo GFForms::format_toolbar_menu_items( $form_actions, true );

			?>

		</div>
		<?php
		return $column_name === $primary ? '<button type="button" class="toggle-row"><span class="screen-reader-text">' . __( 'Show more details' ) . '</span></button>' : '';
	}

	function no_items() {
		if ( rgget( 's' ) ) {
			printf(
				esc_html__( "No forms were found for your search query. %sView all forms%s.", 'gravityforms' ),
				'<a href="' . esc_url( remove_query_arg( 's' ) ) . '">',
				'</a>'
			);
		} else if ( $this->filter == 'trash' ) {
			esc_html_e( 'There are no forms in the trash.', 'gravityforms' );
		} else {
			printf( esc_html__( "You don't have any forms. Let's go %screate one%s!", 'gravityforms' ), '<a href="admin.php?page=gf_new_form">', '</a>' );
		}
	}

	function process_action() {

		$single_action = rgpost( 'single_action' );
		$remote_action = rgget( 'action' ); //action initiated at other pages (i.e. trash command from form menu)

		$bulk_action = $this->current_action();

		if ( ! ( $single_action || $bulk_action || $remote_action ) ) {
			return;
		}

		if ( $single_action ) {

			check_admin_referer( 'gforms_update_forms', 'gforms_update_forms' );

			$form_id = rgpost( 'single_action_argument' );
			switch ( $single_action ) {
				case 'trash' :
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						$trashed       = RGFormsModel::trash_form( $form_id );
						$message       = is_wp_error( $trashed ) ? $trashed->get_error_message() : __( 'Form moved to the trash.', 'gravityforms' );
						$message_class = is_wp_error( $trashed ) ? 'error' : 'success';
					} else {
						$message       = __( "You don't have adequate permission to trash forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;
				case 'restore' :
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						$restored      = RGFormsModel::restore_form( $form_id );
						$message       = is_wp_error( $restored ) ? $restored->get_error_message() : __( 'Form restored.', 'gravityforms' );
						$message_class = is_wp_error( $restored ) ? 'error' : 'success';
					} else {
						$message       = __( "You don't have adequate permission to restore forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;
				case 'delete' :
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						$deleted = RGFormsModel::delete_form( $form_id );
					    $message = is_wp_error( $deleted ) ? $deleted->get_error_message() : __( 'Form deleted.', 'gravityforms' );
					    $message_class = is_wp_error( $deleted ) ? 'error' : 'success';
					} else {
						$message = __( "You don't have adequate permission to delete forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;
				case 'duplicate' :
					if ( GFCommon::current_user_can_any( 'gravityforms_create_form' ) ) {
						$duplicated    = RGFormsModel::duplicate_form( $form_id );
						$message       = is_wp_error( $duplicated ) ? $duplicated->get_error_message() : __( 'Form duplicated.', 'gravityforms' );
						$message_class = is_wp_error( $duplicated ) ? 'error' : 'success';
					} else {
						$message       = __( "You don't have adequate permission to duplicate forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;

			}
		} elseif ( $remote_action ){

			$form_id = rgget( 'arg' );
			switch ( $remote_action ) {
				case 'trash' :

					check_admin_referer( "gf_delete_form_{$form_id}" );

					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						$trashed       = RGFormsModel::trash_form( $form_id );
						$message       = is_wp_error( $trashed ) ? $trashed->get_error_message() : __( 'Form moved to the trash.', 'gravityforms' );
						$message_class = is_wp_error( $trashed ) ? 'error' : 'success';
					} else {
						$message       = __( "You don't have adequate permission to trash forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;
				case 'duplicate' :
					check_ajax_referer( "gf_duplicate_form_{$form_id}" );

					if ( GFCommon::current_user_can_any( 'gravityforms_create_form' ) ) {
						$duplicated    = RGFormsModel::duplicate_form( $form_id );
						$message       = is_wp_error( $duplicated ) ? $duplicated->get_error_message() : __( 'Form duplicated.', 'gravityforms' );
						$message_class = is_wp_error( $duplicated ) ? 'error' : 'success';
					} else {
						$message       = __( "You don't have adequate permission to duplicate forms.", 'gravityforms' );
						$message_class = 'error';
					}
					break;

			}

		} elseif ( $bulk_action ) {

			check_admin_referer( 'gforms_update_forms', 'gforms_update_forms' );

			$form_ids   = is_array( rgpost( 'form' ) ) ? rgpost( 'form' ) : array();
			$form_count = count( $form_ids );
			$message = '';

			switch ( $bulk_action ) {
				case 'trash':
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						GFFormsModel::trash_forms( $form_ids );
						$message = _n( '%s form moved to the trash.', '%s forms moved to the trash.', $form_count, 'gravityforms' );
					} else {
						$message = __( "You don't have adequate permissions to trash forms.", 'gravityforms' );
					}
					break;
				case 'restore':
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						GFFormsModel::restore_forms( $form_ids );
						$message = _n( '%s form restored.', '%s forms restored.', $form_count, 'gravityforms' );
					} else {
						$message = __( "You don't have adequate permissions to restore forms.", 'gravityforms' );
					}
					break;
				case 'delete':
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_forms' ) ) {
						GFFormsModel::delete_forms( $form_ids );
						$message = _n( '%s form deleted.', '%s forms deleted.', $form_count, 'gravityforms' );
					} else {
						$message = __( "You don't have adequate permissions to delete forms.", 'gravityforms' );
					}
					break;
				case 'reset_views':
					foreach ( $form_ids as $form_id ) {
						GFFormsModel::delete_views( $form_id );
					}
					GFCache::delete( 'get_view_count_per_form' );
					$message = _n( 'Views for %s form have been reset.', 'Views for %s forms have been reset.', $form_count, 'gravityforms' );
					break;
				case 'delete_entries':
					if ( GFCommon::current_user_can_any( 'gravityforms_delete_entries' ) ) {
						foreach ( $form_ids as $form_id ) {
							GFFormsModel::delete_leads_by_form( $form_id );
						}
						$message = _n( 'Entries for %s form have been deleted.', 'Entries for %s forms have been deleted.', $form_count, 'gravityforms' );
					} else {
						$message = __( "You don't have adequate permission to delete entries.", 'gravityforms' );
					}

					break;
				case 'activate':
					foreach ( $form_ids as $form_id ) {
						GFFormsModel::update_form_active( $form_id, 1 );
					}
					$message = _n( '%s form has been marked as active.', '%s forms have been marked as active.', $form_count, 'gravityforms' );
					break;
				case 'deactivate':
					foreach ( $form_ids as $form_id ) {
						GFFormsModel::update_form_active( $form_id, 0 );
					}
					$message = _n( '%s form has been marked as inactive.', '%s forms have been marked as inactive.', $form_count, 'gravityforms' );
					break;
			}

			if ( ! empty( $message ) ) {

				$message = sprintf( $message, $form_count );
			}
		}

		if ( ! empty( $message ) ) {

			echo '<div id="message" class="alert ' . ( isset( $message_class ) ? $message_class : 'success' ) . '  "><p>' . $message . '</p></div>';
		};
	}

	function extra_tablenav( $which ) {
		if ( $which !== 'top' ) {
			return;
		}
		wp_nonce_field( 'gforms_update_forms', 'gforms_update_forms' );
		?>
		<input type="hidden" id="single_action" name="single_action" />
		<input type="hidden" id="single_action_argument" name="single_action_argument" />
		<?php
	}

	public function single_row( $form ) {
		echo '<tr class="' . $this->locking_info->list_row_class( $form->id, false ) . '">';
		$this->single_row_columns( $form );
		echo '</tr>';
	}

	public static function compare_view_count_asc( $a, $b ) {
		if ( $a->view_count === $b->view_count ) {
			return 0;
		} else {
			return $a->view_count > $b->view_count ? 1 : -1;
		}
	}

	public static function compare_view_count_desc( $a, $b ) {
		if ( $a->view_count === $b->view_count ) {
			return 0;
		} else {
			return $b->view_count > $a->view_count ? 1 : -1;
		}
	}

	public static function compare_entry_count_asc( $a, $b ) {
		if ( $a->entry_count === $b->entry_count ) {
			return 0;
		} else {
			return $a->entry_count > $b->entry_count ? 1 : -1;
		}
	}

	public static function compare_entry_count_desc( $a, $b ) {
		if ( $a->entry_count === $b->entry_count ) {
			return 0;
		} else {
			return $b->entry_count > $a->entry_count ? 1 : -1;
		}
	}

	public static function compare_conversion_asc( $a, $b ) {
		$a_conversion = $a->view_count > 0 ? $a->entry_count / $a->view_count : 0;
		$b_conversion = $b->view_count > 0 ? $b->entry_count / $b->view_count : 0;
		if ( $a_conversion === $b_conversion ) {
			return 0;
		} else {
			return $a_conversion > $b_conversion ? 1 : -1;
		}
	}

	public static function compare_conversion_desc( $a, $b ) {
	    $a_conversion = $a->view_count > 0 ? $a->entry_count / $a->view_count : 0;
		$b_conversion = $b->view_count > 0 ? $b->entry_count / $b->view_count : 0;
		if ( $a_conversion === $b_conversion ) {
			return 0;
		} else {
			return $b_conversion > $a_conversion ? 1 : -1;
		}
	}
}
