<?php

function tabular_categories()
{
	global $context;

	loadTemplate('TabularCategories');
	Template_Layers::getInstance()->addEnd('tabular_categories');

	$current_cat = current($context['categories']);
	loadCSSFile('TabularCategories.css');
}