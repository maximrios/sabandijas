<?php
	$vcFormName = antibotHacerLlave();
	$vcMsjSrv = (!empty($vcMsjSrv))? $vcMsjSrv: '';
	$vcFrmAction = (!empty($vcFrmAction))? $vcFrmAction: '';
?>
	<?=$vcMsjSrv; ?>
	<form id="<?=$vcFormName;?>" name="<?=$vcFormName;?>" action="<?=$vcFrmAction;?>" method="post" target="contenido-abm" enctype="multipart/form-data">
		<div class="form-group col-lg-12">
    		<label for="nombreGaleria">Nombre Categoria</label>
			<input type="text" id="nombreCategoria" name="nombreCategoria" tabindex="1" class="form-control" placeholder="Nombre de la Categoría." value="<?php echo $Reg['nombreCategoria']?>" autofocus>
    	</div>
    	<div class="form-group col-lg-12">
            <label for="descripcionProducto">Imagen Representativa</label>
            <input type="file" name="userfile" id="userfile"/>
            <progress id="progressBar" value="0" max="100" style="width:300px;"></progress> 
            <output id="filesInfo"></output>
        </div>
		<input id="btnnuevo" type="submit" class="btn btn-primary btn-accion" value="Guardar"/>
		<input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $Reg['idCategoria'];?>">
		<input type="hidden" id="vcForm" name="vcForm" value="<?= $vcFormName; ?>" />
    </form>
<script type="text/javascript">
	function fileSelect(evt) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var files = evt.target.files;
        var result = '';
        var file;
        for (var i = 0; file = files[i]; i++) {
            if (!file.type.match('image.*')) {
                continue;
            }
            reader = new FileReader();
            reader.onload = (function (tFile) {
                return function (evt) {
                    var div = document.createElement('div');
                    div.innerHTML = '<img style="width: 90px;" src="' + evt.target.result + '" />';
                    document.getElementById('filesInfo').appendChild(div);
                };
            }(file));
            reader.readAsDataURL(file);
        }
    } else {
        alert('Su explorador no soporta le funcion de vista previa.');
    }
}
document.getElementById('userfile').addEventListener('change', fileSelect, false);
    $('#uploadFilesBtn').on('click', function() {
         var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(ev){
            document.getElementById('filesInfo').innerHTML = 'Done!';
        };
        xhr.open('POST', 'administrator/productos/do_upload', true);
        var files = document.getElementById('userfile').files;
        var data = new FormData();
        for(var i = 0; i < files.length; i++) data.append('file' + i, files[i]);
        xhr.send(data);
    });
	//$('#userfile').on('change', fileSelect, false);
</script>