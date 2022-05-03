<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>

	</div><!-- #content -->

<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    <?php echo get_theme_mod('example_textbox', 'TEXT'); ?>
  </div>
  <!-- Copyright -->
</footer>

<?php wp_footer(); ?>
</div>
</body>
</html>
