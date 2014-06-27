<?php

/**
 * Tabular Categories
 *
 * @author  emanuele
 * @license BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.0.2
 */

function template_tabular_categories_above()
{
	global $context, $scripturl;

	$current_cat = current($context['categories']);
	addInlineJavascript('
		$(document).ready(function () {
			var current_cat = ' . $current_cat['id'] . ',
				useTabSide = $("#tabular_cats").hasClass("tabcatsside");

			if (window.location.hash)
				current_cat = window.location.hash.substring(2);

			function matchQuery($elem)
			{
				var mqmatch = window.matchMedia("screen and (max-width: 50em)")
				if (mqmatch.matches)
					$elem.css({display: "block"});
				else
					$elem.css({display: "inline-block"});
			}

			$(".forum_category .category_header").hide();

			if (useTabSide)
			{
				$(".forum_category").addClass("tabcatsside");
				$("#info_center").addClass("tabcatsside");

				$(window).resize(function() {
					$(".forum_category").each(function() {
						matchQuery($(this));
					});
				});
			}

			$("#tabular_cats li").click(function (e) {
				e.preventDefault();
				$("#tabular_cats li").removeClass("active");
				var id_cat = $(this).data("catid");

				if (useTabSide)
					matchQuery($(this));

				$(".forum_category").hide()

				$("#info_center").css({display: "block"});
				$("#info_center .category_header").css({display: "block"});
				$("#category_" + id_cat).fadeIn(\'fast\');
				$(this).addClass("active");
			});
			$("#tabcat_" + current_cat + "").click();
		});', true);

	echo '
	<div id="tabular_cats" class="', $context['show_side'] ? 'tabcatsside ' : '', 'category_header">
			<ul>';
	foreach ($context['categories'] as $category)
		echo '
				<li data-catid="', $category['id'], '" id="tabcat_', $category['id'], '"><a href="', $scripturl, '#c', $category['id'], '">', $category['name'], '</a></li>';
	echo '
			</ul>
	</div>';
}
