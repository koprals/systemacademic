<?php
/**
 * FCKHelper is a helper for FCKEditor.
 * This helper REQUIRES the FCKEditor installation files.
 *
 * Copyright 2009, Jose Diaz-Gonzalez (http://josediazgonzalez.com)
 *
 * Licensed under The MIT License
 *
 * @copyright     Copyright 2009, Jose Diaz-Gonzalez (http://josediazgonzalez.com)
 * @link          http://github.com/josegonzalez/cakephp-wysiwyg-plugin
 * @package       Wysiwyg
 * @subpackage    Wysiwyg.View.Helper
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('WysiwygAppHelper', 'Wysiwyg.View/Helper');

class CkHelper extends WysiwygAppHelper {

/**
 * Initializes the Wysiwyg Helper JS/CSS and generates helper javascript
 *
 * ### Options
 *
 * See each field type method for more information. Any options that are part of
 * $attributes or $options for the different **type** methods can be included in `$options` for input().i
 * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
 * will be treated as a regular html attribute for the generated input.
 *
 * - `_buffer` - A boolean for whether we should buffer input transformation js
 * - `_scripts` - An array of scripts to buffer
 * - `_css` - An array of css files to buffer
 * - `_cssText` - A text string containing relevant css
 *	See http://ckeditor.com/ for more options.
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $options Each type of wysiwyg helper takes different options.
 * @return string JavaScript code to initialise the Wysiwyg area
 */
	protected function _build($fieldName, $options = array()) {
		$options = array_merge(array(
			'_buffer' => false,
			'_scripts' => array(
				'core' => 'ck/ckeditor.js',
			),
		), $options);

		$this->_initialize($options);
		$domId = $this->domId($fieldName);
		$initOptions = $this->_initializationOptions($options);

		$script = "var editor = CKEDITOR.replace({$domId}, {$initOptions});";
		if (!empty($options['buffer'])) {
			$this->Js->buffer($script);
			return '';
		}

		return $this->Html->scriptBlock($script, array('safe' => false));
	}

}
