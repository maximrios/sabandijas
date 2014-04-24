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
	<h3>PRODUCTOS</h3>
	<h5><?=$breadcrumb?></h5>
</div>
<section>
	<div class="row">
		<div class="col-lg-8">
			<ul class="categorias">
            <?php foreach ($productos as $producto) { ?>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-6" style="margin-bottom:2.5em;">
                    <figure style="background:#f6f5f5;">
                        <a href="producto/<?=$producto['uriProducto']?>" title="<?=$producto['nombreProducto']?>" alt="<?=$producto['nombreProducto']?>"><img src="<?=$producto['thumbProductoImagen']?>" alt="<?=$producto['nombreProducto']?>" style="border:1px #888 solid;" class="center-block"></a>
                        <figcaption>
                            <h3><?=$producto['nombreProducto']?></h3>
                        </figcaption>
                    </figure>
                </li>
            <?php } ?>  
            </ul>
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