<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Funcionarios</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-3 mb-1"><h1>Lista de Funcionarios</h1></div>
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo">Agregar Nuevo</button>
            </div>
        </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Apellido</th>
          <th class="text-center">Email</th>
          <th class="text-center">Teléfono</th>
          <th class="text-center">Fecha de Registro</th>
          <th class="text-center">Usuario</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        include("conexion.php");
        $sql1 = "SELECT * FROM funcionario";
        $proceso1 = mysqli_query($conexion,$sql1);
        while($row1=mysqli_fetch_array($proceso1)){
            $funcionarioID = $row1["FuncionarioID"];
            $Nombre = $row1["Nombre"];
            $Apellido = $row1["Apellido"];
            $Email = $row1["Email"];
            $Telefono = $row1["Telefono"];
            $FechaRegistro = $row1["FechaRegistro"];
            $usuario = $row1["usuario"];
            echo '
                <tr>
                    <td class="text-center">'.$funcionarioID.'</td>
                    <td class="text-center">'.$Nombre.'</td>
                    <td class="text-center">'.$Apellido.'</td>
                    <td class="text-center">'.$Email.'</td>
                    <td class="text-center">'.$Telefono.'</td>
                    <td class="text-center">'.$FechaRegistro.'</td>
                    <td class="text-center">'.$usuario.'</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modificar" onclick="consultar('.$funcionarioID.')">Editar</button>
                        <button type="button" class="btn btn-danger" onclick="eliminar('.$funcionarioID.')">Eliminar</button>
                    </td>
                </tr>
            ';
        }
        ?>
      </tbody>
    </table>
    <input type="hidden" name="hiddenId" id="hiddenId" value="">
</body>
</html>

<!-- Modal Nuevo -->
    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="#" method="POST" id="formulario1" style="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group form-check">
                                <label for="nombre1" style="font-weight: bold;">Nombre *</label>
                                <input type="text" id="nombre1" name="nombre1" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="apellido1" style="font-weight: bold;">Apellido *</label>
                                <input type="text" id="apellido1" name="apellido1" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="email1" style="font-weight: bold;">Email *</label>
                                <input type="email" id="email1" name="email1" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="telefono1" style="font-weight: bold;">Teléfono *</label>
                                <input type="text" id="telefono1" name="telefono1" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="usuario1" style="font-weight: bold;">Usuario *</label>
                                <input type="text" id="usuario1" name="usuario1" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="password1" style="font-weight: bold;">Password *</label>
                                <input type="password" id="password1" name="password1" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!----------------->

<!-- Modal Modificar -->
    <div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="#" method="POST" id="formulario2" style="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group form-check">
                                <label for="nombre2" style="font-weight: bold;">Nombre *</label>
                                <input type="text" id="nombre2" name="nombre2" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="apellido2" style="font-weight: bold;">Apellido *</label>
                                <input type="text" id="apellido2" name="apellido2" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="email2" style="font-weight: bold;">Email *</label>
                                <input type="email" id="email2" name="email2" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="telefono2" style="font-weight: bold;">Teléfono *</label>
                                <input type="text" id="telefono2" name="telefono2" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="usuario2" style="font-weight: bold;">Usuario *</label>
                                <input type="text" id="usuario2" name="usuario2" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 form-group form-check">
                                <label for="password2" style="font-weight: bold;">Password</label>
                                <input type="password" id="password2" name="password2" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!----------------->

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/sweetalert2.js"></script>

<script>

    $("#formulario1").on("submit", function(e){
        e.preventDefault();
        var nombre = $('#nombre1').val();
        var apellido = $('#apellido1').val();
        var email = $('#email1').val();
        var telefono = $('#telefono1').val();
        var usuario = $('#usuario1').val();
        var password = $('#password1').val();
        $.ajax({
            type: 'POST',
            url: 'funciones2.php',
            dataType: "JSON",
            data: {
                "nombre": nombre,
                "apellido": apellido,
                "email": email,
                "telefono": telefono,
                "usuario": usuario,
                "password": password,
                "asunto": "crear",
            },

            success: function(respuesta) {
                console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    Swal.fire({
                        title: 'Ok',
                        text: respuesta["msg"],
                        icon: 'success',
                        position: 'center',
                        timer: 5000
                    });
                    $('#nombre1').val("");
                    $('#apellido1').val("");
                    $('#email1').val("");
                    $('#telefono1').val("");
                    $('#usuario1').val("");
                    $('#password1').val("");
                }else if(respuesta["estatus"]=="error"){
                    Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                        position: 'center',
                        timer: 5000
                    });
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    });

    function consultar(id){
        $.ajax({
            type: 'POST',
            url: 'funciones2.php',
            dataType: "JSON",
            data: {
                "id": id,
                "asunto": "consultar",
            },

            success: function(respuesta) {
                console.log(respuesta);
                $('#hiddenId').val(respuesta["id"]);
                $('#nombre2').val(respuesta["nombre"]);
                $('#apellido2').val(respuesta["apellido"]);
                $('#email2').val(respuesta["email"]);
                $('#telefono2').val(respuesta["telefono"]);
                $('#fechaRegistro2').val(respuesta["fechaRegistro"]);
                $('#usuario2').val(respuesta["usuario"]);
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

    $("#formulario2").on("submit", function(e){
        e.preventDefault();
        var id = $('#hiddenId').val();
        var nombre = $('#nombre2').val();
        var apellido = $('#apellido2').val();
        var email = $('#email2').val();
        var telefono = $('#telefono2').val();
        var usuario = $('#usuario2').val();
        var password = $('#password2').val();
        $.ajax({
            type: 'POST',
            url: 'funciones2.php',
            dataType: "JSON",
            data: {
                "id": id,
                "nombre": nombre,
                "apellido": apellido,
                "email": email,
                "telefono": telefono,
                "usuario": usuario,
                "password": password,
                "asunto": "modificar",
            },

            success: function(respuesta) {
                console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    Swal.fire({
                        title: 'Ok',
                        text: respuesta["msg"],
                        icon: 'success',
                        position: 'center',
                        timer: 5000
                    });
                    $('#nombre1').val("");
                    $('#apellido1').val("");
                    $('#email1').val("");
                    $('#telefono1').val("");
                    $('#usuario1').val("");
                    $('#password1').val("");
                }else if(respuesta["estatus"]=="error"){
                    Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                        position: 'center',
                        timer: 5000
                    });
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    });

    function eliminar(id){
        $.ajax({
            type: 'POST',
            url: 'funciones2.php',
            dataType: "JSON",
            data: {
                "id": id,
                "asunto": "eliminar",
            },

            success: function(respuesta) {
                console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    Swal.fire({
                        title: 'Ok',
                        text: respuesta["msg"],
                        icon: 'success',
                        position: 'center',
                        timer: 5000
                    });
                }else if(respuesta["estatus"]=="error"){
                    Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                        position: 'center',
                        timer: 5000
                    });
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }
    
</script>