<script type="text/javascript">
$(document).ready(function() {
    $('.jqzoom').jqzoom({
        zoomType: 'standard',
        lens: false,
        title: false,
        preloadImages: false,
        alwaysOn:false,
        showEffect: 'fadein',  
        hideEffect: 'fadeout'
    });
});
</script>
<section class="content wrap-content row">
	<div class="col-lg-10 thumbs">
        <br>
        <div class="row">
            <div class="col-lg-6">
                <a href='<?=$imagenes[0]['pathProductoImagen']?>' class="jqzoom" rel='galeria<?=$producto['idProducto']?>'>
                    <img src="<?=$imagenes[0]['detailProductoImagen']?>" alt="<?=$producto['nombreProducto']?>" style="margin:0.5em;">
                </a>
                <div class="thumbs">
                    <ul id="thumblist">
                        <?php 
                        $i = 1;
                        foreach ($imagenes as $imagen) { 
                            if($i != 1) {?>
                                <a href="javascript:void(0);" id="imagen<?=$i?>" class="" rel="{gallery: 'galeria<?=$producto['idProducto']?>', smallimage: '<?=$imagen['detailProductoImagen']?>', largeimage: '<?=$imagen['pathProductoImagen']?>'}">
                                    <img src="<?=$imagen['thumbdetailProductoImagen']?>">
                                </a>
                            <?php
                            } 
                            $i++;
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <h5><?=$producto['nombreProducto']?></h5>
                <p><?=$producto['descripcionProducto']?></p>
            </div>
        </div>
    </div>
</section>
