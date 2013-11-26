<?php

function template_tabular_categories_above()
{
	global $context, $scripturl;

	$current_cat = current($context['categories']);
	addInlineJavascript('
		$(document).ready(function () {
			var current_cat = ' . $current_cat['id'] . ';
			if (window.location.hash)
				current_cat = window.location.hash.substring(2);

			$(".forum_category").hide();
			$(".forum_category .category_header").hide();

			$("#category_" + current_cat).fadeIn(\'fast\');
			$("#tabcat_" + current_cat + "").addClass("active");

			$("#tabular_cats li").click(function () {
				$("#tabular_cats li").removeClass("active");
				var id_cat = $(this).data("catid");

				$(".forum_category").hide();
				$("#category_" + id_cat).fadeIn(\'fast\');
				$(this).addClass("active");
				return false;
			});
		});', true);

	echo '
	<div id="tabular_cats" class="category_header">
			<ul>';
	foreach ($context['categories'] as $category)
		echo '
				<li data-catid="', $category['id'], '" id="tabcat_', $category['id'], '"><a href="', $scripturl, '#c', $category['id'], '">', $category['name'], '</a></li>';
	echo '
			</ul>
	</div>';
}