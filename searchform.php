<?php
/**
 * The theme's search form.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<form role="search" method="get" class="search-form" action="<?php bloginfo( 'url' ); ?>">

	<div class="fields row">
		<label class="search-field-label columns small-12 medium-8">
			<span class="screen-reader-text">Search for:</span>
			<span class="fa fa-search"></span>
			<input type="search" class="search-field" placeholder="SEARCH" value="" name="s"
			       title="Search for:">
		</label>
	</div>
</form>