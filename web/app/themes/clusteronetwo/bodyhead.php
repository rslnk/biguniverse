<div id="fb-root"></div>

<div id="wrapper" class="hfeed">

	<div id="main">

		<div id="header">

			<ins id="top-ad-1"
			style="display: none;"
			class="adsbygoogle-placeholder"></ins>

			<div id="branding">
				<div class="skip-link"><h1><a href="<?php echo home_url(); ?>/" title="<?php echo home_url(); ?>" rel="home"><?php bloginfo( 'name' ) ?></a></h1></div>
				<a class="logo" href="<?php echo home_url(); ?>" alt="<?php bloginfo( 'name' ) ?>" rel="home"></a>
			</div><!-- #branding -->

		<div id="top-navigation">

			<a class="skip-link" href="#content" title="<?php _e( 'Перейти к содержанию', 'clusterone' ) ?>"><?php _e( 'Перейти к содержанию', 'clusterone' ) ?></a>

			<div id="navmenu">
				<ul>
					<?php wp_nav_menu();?>
				</ul>
			</div>

			<div id="search">
			    <form class="searchform" method="get" action="<?php echo home_url(); ?>">
			        <fieldset>
			            <input name="s" type="text" onfocus="if(this.value=='поиск по сайту') this.value='';" onblur="if(this.value=='') this.value='поиск по сайту';" value="поиск по сайту" />
			            <button type="submit"><i class="icon-search"></i></button>
			        </fieldset>
			    </form>
			</div>

		</div><!-- top-navigation -->

</div><!-- #header -->