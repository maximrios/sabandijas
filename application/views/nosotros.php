<style type="text/css">
	#cssmenu > ul {
		padding-left: 0;
	}
	#cssmenu > ul > li > ul {
		display: none;
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
	#cssmenu ul li a:hover, #cssmenu ul li a:active, #cssmenu ul li a:focus {
		text-decoration: none;
		border: none;
  		outline: 0;
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
					<?php foreach ($categorias as $categoria) { ?>
						<li><a href="#"><?=$categoria['nombreCategoria']?></a>
							<?php if($subcategorias = $this->layout->obtenerCategorias($categoria['idCategoria'])) { ?>
							<ul>
							<?php foreach ($subcategorias as $subcategoria) { ?>
								<li><a href="productos/<?=$subcategoria['uriCategoria']?>"><?=$subcategoria['nombreCategoria']?></a></li>
							<?php } ?>
							</ul>
							<?php } 
							else { ?>
								</li>
							<?php } ?>
					<?php } ?>
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