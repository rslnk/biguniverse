	<div class="footer-menu-block">

		<div class="footer-menu">
			<?php wp_nav_menu( array(

				'theme_location' => 'secondary_navigation',
				'menu_class'=> 'footer-menu'

			) ); ?>
		</div>
	</div>

		<div id="footer">

			<span class="copyright">
				 <strong>&copy; Большая Вселенная, 2010—2015</strong>.
				<p>Использование материалов сайта «Большая Вселенная» разрешено при наличии активной ссылки на источник.
				<br />Все права на фотографии и иллюстрации принадлежат их авторам.</p>
			</span>

			<div class="clear"></div>

		</div>

	</div><!-- #main -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>

</html>