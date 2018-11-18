<?php
/**
 * Template part for post meta
 *
 * @package Ahashop
 */

?>
<ul class="entry-meta">
	<li class="entry-date">
		<?php ahashop_entry_date(); ?>
	</li>

	<li class="entry-category">
		<?php ahashop_post_categories(); ?>
	</li>

	<li class="entry-author">
		<?php ahashop_post_author(); ?>
	</li>

	<li class="entry-comments">
		<?php ahashop_post_comments_link(); ?>
	</li>
</ul>
