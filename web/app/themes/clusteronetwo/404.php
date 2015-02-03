<?php get_header(); ?>

<div id="container">

	<section id="content" class="page-404 block-full">

		<br />
		
		<div class="pic"><img src="<?php echo home_url(); ?>/wp-content/themes/clusterone/images/black-hole.png"></img></div>
		
		<br />
		<br />
		<br />
		
		<span class="title">Ого! Черная дыра!</span>
		
		<br />
		<br />
		<br />	

		<div>
			<strong>Что-то не так!</strong> Такой страницы на сайте нет.
			<br />
			<br />
			<p>Если вы попали сюда по какой-либо ссылке, то, возможно, материал был перенесен в другой раздел.<br/>Вы можете воспользоваться поиском или перейти на <a href="<?php echo home_url(); ?>/" rel="home">главную страницу</a>.</p>
			
		</div>

		<br />
			
		<form method="get" class="searchform" action="<?php echo home_url(); ?>">
			<fieldset>
				<input name="s" type="text" onfocus="if(this.value=='<?php the_search_query(); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php the_search_query(); ?>';" value="<?php the_search_query(); ?>" />
				<button type="submit"></button>
			</fieldset>
		</form>

	</section>
	
</div><!-- #container -->