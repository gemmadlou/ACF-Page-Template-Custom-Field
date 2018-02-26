<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('gdl_acf_field_page_template') ) :


class gdl_acf_field_page_template extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct( $settings ) {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'page_template';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('Page Template', 'TEXTDOMAIN');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'relational';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'page_template'	=> 'default',
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'TEXTDOMAIN'),
		);
		
		
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		
		$this->settings = $settings;
		
		
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

		$templates = get_page_templates();
		$choices = [];
		$choices['default'] = 'Default';
		foreach ($templates as $value => $key) {
			$choices[$key] = $value;
		}

		acf_render_field_setting($field, array(
			'label' => __('Page Template Type', 'acf-image_select'), 
			'instructions'	=> __('Choose a page template','TEXTDOMAIN'),
			'type' => 'select', 
			'choices' => $choices,
			'layout' => 'horizontal',
			'name' => 'page_template'
		));

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {

		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/

		$args = [
			'post_type' => 'page',
			'post_status' => 'publish',
			'meta_query' => [
				[
					'key' => '_wp_page_template',
					'value' => $field['page_template'],
				]
			]
		];

		$templates = get_posts($args);
		
		?>
		
		<select name="<?= esc_attr($field['name']); ?>">
			<option value="">Select a page</option>
			<?php foreach ($templates as $template) : ?>		
				<option 
					value="<?= $template->ID; ?>"
					<?= $template->ID === (int) $field['value'] ? 'selected="selected"' : ''; ?>>
					<?= $template->post_title; ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
	}

}


// initialize
new gdl_acf_field_page_template( $this->settings );


// class_exists check
endif;

?>