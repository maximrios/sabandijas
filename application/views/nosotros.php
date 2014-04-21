<style type="text/css">
	#cssmenu > ul {
		padding-left: 0;
	}
	#cssmenu ul {
		list-style: none;
	}
	#cssmenu ul li {
		border-bottom: dotted;
		border-width: 2px;
		border-spacing: 5px;
		border-color: #d0d0d0;
		line-height: 1.8em;
	}
	#cssmenu ul li ul li:first-child {
		border-top: dotted;
		border-width: 2px;
		border-spacing: 15px;
		border-color: #d0d0d0;
	}
	#cssmenu ul li ul li:last-child {
		border: none;
	}
</style>
<div class="row ubicacion">
	<h3>LA EMPRESA</h3>
	<h5>Home / La Empresa</h5>
</div>
<section>
	<div class="row">
		<div class="col-lg-8">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div id="slider-empresa">
				<img src="assets/images/empresa/imagen1.jpg">
			</div>
		</div>
		<div class="col-lg-4 categorias">
			<h3>Productos <span class="celeste">Categorías</span></h3>
			<div id="cssmenu">
				<ul>
					<li><a href="#"><span>Home</span></a></li>
					<li><a href="#">Products</a>
						<ul>
							<li><a href="#">Widgets</a></li>
							<li><a href="#">Menus</a></li>
							<li><a href="#">Products</a></li>
						</ul>
					</li>
					<li><a href="#"><span>Company</span></a>
						<ul>
							<li><a href="#">About</a></li>
							<li><a href="#">Location</a></li>
						</ul>
					</li>
					<li><a href="#"><span>Contact</span></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#cssmenu > ul > li > a').click(function() {

	var checkElement = $(this).next();

	$('#cssmenu li').removeClass('active');
	$(this).closest('li').addClass('active');	

	if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		$(this).closest('li').removeClass('active');
		checkElement.slideUp('normal');
	}

	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
		$('#cssmenu ul ul:visible').slideUp('normal');
		checkElement.slideDown('normal');
	}

	if (checkElement.is('ul')) {
		return false;
	} else {
		return true;	
	}
});
</script>