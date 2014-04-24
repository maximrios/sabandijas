<?php
    $vcHeaderLoginView = (!empty($vcHeaderLoginView))?$vcHeaderLoginView:'';
    $vcBaseUrlAssets = (!empty($vcBaseUrlAssets))?$vcBaseUrlAssets: config_item('ext_base_url_assets');
    $vcBaseUrlPlantillaElegida = (!empty($vcBaseUrlPlantillaElegida))?$vcBaseUrlPlantillaElegida: config_item('ext_base_url_plantilla_elegida');
    //$vcMenu = (!empty($vcMenu))? $vcMenu: '';
    $vcMainContent = (!empty($vcMainContent))? $vcMainContent: '';
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class                                       ="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class                                       ="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class                                       ="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <base href="<?= base_url(); ?>" />
        <title><?=$SiteInfo['title']; ?></title>
        <meta name="description" content="<?= $SiteInfo['descriptions'];?>">
        <meta name="author" content="<?= $SiteInfo['author'];?>">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
        <?php
            # Para garantizar que los archivos CSS se descarguen en paralelo,
            # incluya siempre los recursos CSS externos antes que los recursos JavaScript externos
            print incluirjscss_stylecss();
            print incluirjscss_linkjs();
        ?>
        <!-- Scripts for any page -->
        <?= $vcIncludesGlobales; ?>
        <!-- End Scripts for any page -->
        <style type="text/css">
        /*.lavalamp-object {
            top: -10px!important;
            border-bottom: 2px solid orange;
        }
        #nav-primary li:hover a {
            color: orange!important;
        }*/
        </style>
    </head>
    <body>
        <div class="header-shadow">
        <header>
            
            <div id="header" class="col-lg-8">
                <h1 id="logo">
                    <a href="http://www.industriasrosobe.com.ar" alt="<?=config_item('ext_base_nombre_sitio');?>" title="<?=config_item('ext_base_nombre_sitio');?>">Sabandijas - Rodados para Bebé</a>
                </h1>
                <div id="locked" class="pull-right col-lg-2">
                    Login
                </div>  
                <nav class="pull-right" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Menú</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul id="nav-primary" class="nav navbar-nav wrap-nav nav-primary">
                                <?php
                                echo $vcMenu;
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            
        </header>
        </div>
        <section id="wrap-content" class="col-lg-8">
            <section>
                <?=$vcMainContent; ?>
            </section>
        </section>
            <footer class="col-xs-12 col-lg-8">
                <div class="info-shadow">
                <div class="info row">
                    <div class="col-xs-12 col-lg-4">
                        <h5><span class="naranja">SABANDIJAS</span> RODADOS</h5>
                        <ul>
                            <li>Goycoechea 1097- Villa Allende</li>
                            <li>Córdoba - Argentina</li>
                            <li>TEL: 03543 43-5608</li>
                            <li><a href="mailto:sabandijasrodados@yahoo.com" title="Sabandijas - Rodados para bebé">sabandijasrodados@yahoo.com</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                        <h5><span class="naranja">HORARIOS</span> DE ATENCIÓN</h5>
                        <ul>
                            <li>Lunes a Viernes de </li>
                            <li>Sábados de </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-lg-3">
                        <h5><span class="naranja">BUSCANOS</span> EN</h5>
                        <ul class="sociales">
                            <li><a href="#" class="redes_sociales facebook"></a></li>
                            <li><a href="#" class="redes_sociales twitter"></a></li>
                            <li><a href="#" class="redes_sociales flickr"></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-lg-1" style="text-align:center;">
                        <img src="assets/themes/base/img/fiscal.png" alt="" width="50">
                    </div>
                </div>
                </div>
                <div class="web row">
                    <a href="http://www.sabandijasrodados.com.ar" target="_blank">WWW.SABANDIJASRODADOS.COM.AR</a>
                </div>
            </footer>
    </body>
</html>