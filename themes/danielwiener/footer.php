<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Daniel Wiener
 * @since Daniel Wiener 1.0
 */
?>

	</div><!-- #main -->  
</div><!-- #page .hfeed .site --> 
</div><!-- #container -->
<?php get_template_part('subfooter'); ?> 
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php do_action( '_s_credits' ); ?>
		<a href="/is">Daniel Wiener</a> <span class="sep"> | </span> &copy;1982 - <?php echo date('Y'); ?> <span class="sep"> | </span>
		<a href="http://wordpress.org/" title="Site is created using Wordpress, designed by Daniel Wiener starting with the _s theme by Automattic" rel="generator">Credits</a>
	</div><!-- .site-info -->
</footer><!-- .site-footer .site-footer -->

<?php wp_footer(); ?>
<?php if (is_front_page()): ?>
	<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
<?php endif ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-11392590-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>