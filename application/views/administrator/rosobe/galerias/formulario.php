<?php
    $vcFormName = antibotHacerLlave();
    $vcMsjSrv = (!empty($vcMsjSrv))? $vcMsjSrv: '';
    $vcFrmAction = (!empty($vcFrmAction))? $vcFrmAction: '';
?>
<div class="row">
<div class="forms">
    <?= $vcMsjSrv; ?>
    <form id="proba" name="<?= $vcFormName; ?>" action="<?= $vcFrmAction; ?>" method="post" target="contenido-abm">
        <div class="form-group col-lg-12">
            <label for="nombreGaleria">Titulo de la Imagen</label>
            <input type="text" id="nombreGaleria" name="nombreGaleria" tabindex="1" class="form-control" placeholder="Titulo de la Imagen." value="<?php echo $Reg['nombreGaleria']?>" autofocus>
        </div>
        <div class="form-group col-lg-12">
            <label for="descripcionGaleria">Descripcion de la Imagen</label>
            <input type="text" id="descripcionGaleria" name="descripcionGaleria" tabindex="1" class="form-control" placeholder="Descripcion de la Imagen." value="<?php echo $Reg['descripcionGaleria']?>">
        </div>
        <div class="form-group col-lg-12">
            <label for="estadoGaleria">Estado de la Imagen</label>
            <input type="checkbox" id="estadoGaleria" name="estadoGaleria" class="form-control" value="1">
        </div>
        <div class="form-group col-lg-12">
            <label for="">Imagen</label>
            <input type="file" name="userfile" id="userfile"/>
            <progress id="progressBar" value="0" max="100" style="width:300px;"></progress> 
            <output id="filesInfo"></output>
        </div>
        <input type="submit" id="uploadFilesBt" class="btn btn-primary btn-accion" value="Guardar" name="btnvo"/>
        <input type="hidden" id="idGaleria" name="idGaleria" value="<?php echo $Reg['idGaleria']?>">
        <input type="hidden" id="pathGaleria" name="pathGaleria" value="<?php echo $Reg['pathGaleria']?>">
        <input type="hidden" id="thumbGaleria" name="thumbGaleria" value="<?php echo $Reg['thumbGaleria']?>">
        <input type="hidden" id="vcForm" name="vcForm" value="<?= $vcFormName; ?>" />
    </form>
</div>
<script>
    $('figcaption > input').on('click', function() {
        $('figcaption > input[type=checkbox]').prop('checked', '');
        $(this).prop('checked', 'checked');
    });
    $('figcaption > a').on('click', function(event) {
        if (confirm("Esta seguro de eliminar la imagen?")) {
            $.ajax({
                type: 'POST'
                , url: $(this).attr('href')
                , data: $(this).attr('rel')
                , success: function() {
                    alert('probando ando');
                }
            });
        }
        event.preventDefault();
    });
function fileSelect(evt) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var files = evt.target.files;
        var result = '';
        var file;
        for (var i = 0; file = files[i]; i++) {
             // if the file is not an image, continue
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
        alert('The File APIs are not fully supported in this browser.');
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
</script>