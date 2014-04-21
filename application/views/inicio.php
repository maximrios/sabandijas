<div id="slider" class="nivoSlider">
    <?php foreach ($slider as $imagen) { ?>
        <a href="<?=$imagen['linkSlider']?>" target="<?=$imagen['targetSlider']?>"><img src="<?=$imagen['pathSlider']?>" alt="<?=$imagen['tituloSlider']?>" /></a>
    <?php } ?>
</div>
<section class="content">
    <div class="row" style="margin:0;margin-top:1em;">
        <div class="col-lg-12">
            <div class="title">
                <h4><span>Nuestros Productos</span></h4>
            </div>
            <ul class="categorias">
            <?php foreach ($productos as $producto) { ?>
                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <figure style="background:white;border: 1px solid #D9D9D9;min-height:180px;">
                        <a href="producto/<?=$producto['uriProducto']?>" title="<?=$producto['nombreProducto']?>" alt="<?=$producto['nombreProducto']?>"><img width="170" src="<?=$producto['thumbProductoImagen']?>" alt="<?=$producto['nombreProducto']?>"></a>
                        <figcaption>
                            <h4><?=$producto['nombreProducto']?></h4>
                        </figcaption>
                    </figure>
                </li>
            <?php } ?>  
            </ul>
        </div>
    </div>
    <hr>
    <div class="row paneles" style="margin-top:2em;">
        <div class="col-lg-4 cel">
            <div class="col-lg-12 celeste">
                <h6>Nuestros Medios de Pago</h6>
                <img src="assets/images/mediospago.png">
            </div>
        </div>
        <div class="col-lg-4 nar">
            <div class="col-lg-12 naranja">
                <h6>Nuestros Horarios:</h6>
            </div>
        </div>
        <div class="col-lg-4 ver">
            <div class="col-lg-12 verde">
                <h6>Dónde estamos:</h6>
                <label>Goycoechea 1097</label>
                <label>Córdoba - Argentina</label>
                <label>TE: 03543 43-5608</label>
                <label>sabandijasrodados@yahoo.com</label>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
//$(window).load(function() {
    $('#slider').nivoSlider({
        directionNav: false,             // Next & Prev navigation
        controlNav: false,
        effect: 'fade',               // 1,2,3... navigation
    });
//});
</script>