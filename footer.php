<?php
/**
 * The template for displaying the footer
 *
 * @package Priority_Biz
 */

?>
<footer class="footer">

	<div id="inner-footer" class="large-wrapper">

		<div class="container">

			<div class="row align-items-center">

				<div class="copyright col-sm-12 col-md-6 mb-2">
					<div>
						<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Prioritybiz, Inc.</span>
						|
						<a href="<?php echo esc_url( site_url() ); ?>/privacy-policy">Privacy Policy</a>
					</div>
					<div>
						<span>Location: 4001 River Rd Tonawanda, NY 14150</span>
					</div>
				</div>
				<div class="developer col-sm-12 col-md-6 mb-2">
					Built By: <a target="_blank" href="https://minervawebdevelopment.com">Minerva Web Development</a>
				</div>
			</div>

		</div>

	</div>

</footer>

</div>

<?php wp_footer(); ?>


</body>

</html>
