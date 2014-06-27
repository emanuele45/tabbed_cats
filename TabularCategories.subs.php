<?php

/**
 * Tabular Categories
 *
 * @author  emanuele
 * @license BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.0.2
 */

/**
 * A demo addon to demonstrate the usage of template layers
 * to inject some template elements into the board index
 */

/**
 * The entry point of the addon attached to the integrate_action_boardindex_after hook
 */
function tabular_categories()
{
	global $context, $modSettings;

	loadTemplate('TabularCategories');
	Template_Layers::getInstance()->addEnd('tabular_categories');

	$current_cat = current($context['categories']);
	loadCSSFile('TabularCategories.css');

	$context['show_side'] = !empty($modSettings['tabcats_toggle_side']);
}

function tabular_categories_setting(&$config_vars)
{
	loadLanguage('TabularCategories');
	$config_vars[] = array('check', 'tabcats_toggle_side');
}