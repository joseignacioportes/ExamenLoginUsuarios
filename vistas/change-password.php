<!DOCTYPE html>
<html>  
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cambiar Contraseña</title>
	<link href="../lib/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="../lib/css/style.css" rel="stylesheet">
</head>
<body>
<label class="col-form-label col-md-12 col-sm-3 label-align"><a href="signin.php"><---Regresar</a></label>
	<div class="col-md-12"><br><br></div>
	<div class="container register-form" style="max-width: 400px;">
		<div class="form">
			<div class="note">
				<p>Cambiar Contraseña</p>
			</div>
			<form id="basic-form" class="form-horizontal" action="" method="post" role="form">
				<div class="form-content">
					<div class="row align-center">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
									<input type="text" class="form-control" name="Correo" id="Correo" maxlength="100" autocomplete="off">
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Contraseña Anterior</label>
									<input type="password" class="form-control" name="Contrasena" id="Contrasena" maxlength="15" autocomplete="off">
								</div>
                                <div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Nueva Contraseña</label>
									<input type="password" class="form-control" name="Contrasena_Nueva" id="Contrasena_Nueva" maxlength="15" autocomplete="off">
								</div>
                                <div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Comfirmar Contraseña</label>
									<input type="password" class="form-control" name="Confirm_Contrasena" id="Confirm_Contrasena" maxlength="15" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-12" align="center">
							<br>
							<button type="submit" class="btnSubmitLogin">Cambiar</button>
						</div>
                    </div>    	
				</div>
			</form>
		</div>
	</div>
</body>
<script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="../lib/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        jQuery("#basic-form").validate({ //inicamos la validación del formulario
            onfocusout: false,  //Si un objeto no cumple con la validación, tomara el foco 
            rules: {
				Correo: {
					required: true,
					email: true,
					maxlength: 100
				},
				Contrasena: {
					required: true,
					maxlength: 15
				},
                Contrasena_Nueva: {
					required: true,
					maxlength: 15
				},
                Confirm_Contrasena: {
					required: true,
					maxlength: 15,
					equalTo: "#Contrasena_Nueva"
				},
			},
			messages : {
				Correo: {
					required:  "Obligatorio",
					email:  "Correo invalido",
					maxlength: "Maximo 100 Caracteres"
				},
                Contrasena: {
					required: "Obligatorio",
					maxlength: "Maximo 15 Caracteres"
				},
				Contrasena_Nueva: {
					required:  "Obligatorio",
					maxlength: "Maximo 15 Caracteres" 
				},
                Confirm_Contrasena: {
					required:  "Obligatorio",
					maxlength: "Maximo 15 Caracteres",
					equalTo: "El password no es igual al anterior"
				},
			},
           	submitHandler: function(form){
            	var datos= $(form).serializeArray();
				datos.push({name: 'accion', value: "cambiar_contrasena"});
				jQuery.ajax({
              		url: '../fachadas/usuarios/UsuariosFacade.Class.php',
              		type: 'POST',
              		dataType: 'html',
              		data: datos,
							beforeSend: function() {
					},
              		success: function(data, textStatus, xhr) {
                		var json = "";
						json = eval("(" + data + ")"); //Parsear JSON
						if (json.totalCount > 0) {
							alert(json.text);
                            $(location).attr('href','signin.php');
                        }else{
							alert(json.text);
						}
            		},
           		 	error: function(xhr, textStatus, errorThrown) {
                		alert("Ocurrio un error al guardar");
					}
        		});
    		}
        });
    });
</script>
</html>
