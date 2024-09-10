<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package pbz
 */

get_header();
?>

<div id="content">

	<div id="inner-content" class="wrap">

		<main id="main" class="" role="main">

			<article id="post-not-found" class="hentry">

				<header class="article-header">

					<h1><?php esc_html_e( 'Epic 404 - Article Not Found', 'pbltheme' ); ?></h1>

				</header>

				<section class="entry-content">

					<p><?php esc_html_e( 'The article you were looking for was not found, but maybe try looking again!', 'pbltheme' ); ?></p>

				</section>

				<section class="search">

					<p><?php get_search_form(); ?></p>

				</section>

				<footer class="article-footer">

					<p><?php esc_html_e( 'This is the 404.php template.', 'pbltheme' ); ?></p>

				</footer>

			</article>

		</main>

	</div>

</div>

<?php get_footer(); ?>
