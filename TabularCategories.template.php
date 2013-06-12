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

			$("#boardindex_table .header").hide();
			$("#boardindex_table .divider").hide();
			$("#boardindex_table .content").hide();
			$("#category_" + current_cat + "_boards").fadeIn();
			$("#tabcat_" + current_cat + "").addClass("active");

			$("#tabular_cats li").click(function () {
				$("#tabular_cats li").removeClass("active");
				var id_cat = $(this).attr("id").split("_")[1];
				$("#boardindex_table .content").hide();
				$("#category_" + id_cat + "_boards").fadeIn();
				$(this).addClass("active");
				return false;
			});
		});', true);

	echo '
	<div id="tabular_cats" class="cat_bar">
		<h3 class="catbg">
			<ul>';
	foreach ($context['categories'] as $category)
		echo '
				<li id="tabcat_', $category['id'], '"><a href="', $scripturl, '#c', $category['id'], '">', $category['name'], '</a></li>';
	echo '
			</ul>
		</h3>
	</div>';
}