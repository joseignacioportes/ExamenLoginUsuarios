<!DOCTYPE html>
<html>  
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registro de usuario</title>
	<link href="../lib/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="../lib/css/style.css" rel="stylesheet">
</head>
<body>
	<label class="col-form-label col-md-12 col-sm-3 label-align"><a href="signin.php"><---Regresar</a></label>
	<div class="container register-form">
		<div class="form">
			<div class="note">
				<p>Formulario de Registro</p>
			</div>
			<form id="basic-form" class="form-horizontal" action="" method="post" role="form">
				<div class="form-content">
					<div class="row align-center">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label col-md-6 col-sm-3 label-align">Nombre Completo</label>
									<input type="text" class="form-control" name="Nombre_Completo" id="Nombre_Completo" maxlength="100">
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-6 col-sm-3 label-align">Edad</label>
									<input type="text" class="form-control" name="Edad" id="Edad" maxlength="3">
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-6 col-sm-3 label-align">Teléfono</label>
									<input type="text" class="form-control" name="Telefono" id="Telefono" maxlength="10">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
									<input type="text" class="form-control" name="Correo" id="Correo" maxlength="100">
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Contraseña</label>
									<input type="password" class="form-control" name="Contrasena" id="Contrasena" maxlength="15">
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-6 col-sm-3 label-align">Confirmar Contraseña</label>
									<input type="password" class="form-control" name="Confirm_Contrasena" id="Confirm_Contrasena" maxlength="15">
								</div>
							</div>
						</div>
						<div class="col-md-12" align="center">
							<button type="submit" class="btnSubmit">Guardar</button>
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
				Nombre_Completo: {
					required: true,
					maxlength: 100
				},
				Edad: {
					number: true,
					maxlength: 3
				},
				Telefono: {
					required: true,
					number: true,
					maxlength: 10
				},
				Correo: {
					required: true,
					email: true,
					maxlength: 100
				},
				Contrasena: {
					required: true,
					maxlength: 15
				},
				Confirm_Contrasena: {
					required: true,
					maxlength: 15,
					equalTo: "#Contrasena"
				}
			},
			messages : {
				Nombre_Completo: {
					required:  "Obligatorio",
					maxlength: "Maximo 100 Caracteres" 
				},
				Edad: {
					number: "Solo números",
					maxlength: "Máximo 3 Caracteres" 
				},
				Telefono: {
					required: "Obligatorio",
					number: "Solo números",
					maxlength: "Máximo 10 Caracteres" 
				},
				Correo: {
					required:  "Obligatorio",
					email:  "Correo invalido",
					maxlength: "Maximo 100 Caracteres"
				},
				Contrasena: {
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
				datos.push({name: 'accion', value: "guardar"});
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
							alert(json.mensaje);
							$(location).attr('href','signin.php');
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
