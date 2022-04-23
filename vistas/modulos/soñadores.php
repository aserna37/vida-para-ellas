    <div class="retorno">
        <a class="btn btn-sm rounded float-right" href="menu" role="button">
        Regresar al menu
        <lord-icon
            src="https://cdn.lordicon.com/gwlkhzue.json"
            trigger="loop"
            colors="primary:#ffffff"
            style="width:20px;height:20px">
        </lord-icon> 
        </a>
    </div>

<br>

<div class="nombre_menu">
  <div class="container rounded">
    <h4>Soñadores</h4>
  </div>
</div>

<div class="btnnuevo container">
        <a id="" class="btn btn-sm rounded float-left" href="menu" data-toggle="modal" data-target="#ModalCrearSoñadora" role="button">
        <lord-icon
            src="https://cdn.lordicon.com/dxjqoygy.json"
            trigger="loop"
            colors="primary:#fcee20,secondary:#fcee20"
            style="width:30px;height:30px">
        </lord-icon> 
        Nuevo soñador
        </a>
</div>
<br>
<br>
<div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped" style="width:100%" id="tablaSoñadores">
        <thead>
            <tr>
            <th scope="col">Documento</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Ciudad</th>
            <th scope="col">Departamento</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
  </div>
</div>




<!-- Modal Creacion Soñadora -->
<div class="modal fade" id="ModalCrearSoñadora" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Soñador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="agregarSoñador">
            <div class="modal-body">
                
                <div class="form-group row">
                    <div class="form-group col-sm-6">
                        <label for="tipo" class="col-form-label col-form-label-sm">Tipo de Documento</label>
                        <select class="form-control form-control-sm rounded" name="tipo" id="tipo" required>
                            <option selected value="">Seleccione...</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CC">Cedula de ciudadania</option>
                            <option value="CE">Cedula de extranjeria</option>
                            <option value="CV">Cedula venezolana</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Documento</label>
                        <input type="text" class="form-control form-control-sm" 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        name="documento" 
                        maxlength="12" 
                        id="documento" required>
                    </div> 
                    
                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Nombres</label>
                        <input type="text" class="form-control form-control-sm"
                        name="nombres"
                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
                        id="nombres"
                        minlength="3" required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Apellidos</label>
                        <input type="text" class="form-control form-control-sm"
                        name="apellidos"
                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
                        id="apellidos"
                        minlength="3" required>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Fecha de Nacimiento</label>
                        <input type="date" class="form-control form-control-sm"
                        name="f_nacimiento"
                        id="f_nacimiento"
                        required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Sexo</label>
                        <select class="form-control form-control-sm rounded" name="sexo" id="sexo" required>
                            <option selected value="">Seleccione...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="NB">No binario</option>
                        </select>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Dirección</label>
                        <input type="text" class="form-control form-control-sm"
                        name="direccion"
                        id="direccion"
                        minlength="3" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Celular</label>
                        <input type="text" class="form-control form-control-sm" 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        name="celular" 
                        maxlength="12" 
                        id="celular" required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Departamento</label>
                        <select class="form-control form-control-sm rounded" name="departamento" id="departamento" required>
                            <option selected value="">Seleccione...</option>
                            <?php
                                $item = null;
                                $valor = null;

                                $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item,$valor);

                                foreach($departamentos as $key => $value){
                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6" id="listaMunicipios"></div>

                    
                    <div class="form-group col-sm-12">
                        <label for="documento" class="col-form-label col-form-label-sm">Correo electronico</label>
                        <input type="email" class="form-control form-control-sm " 
                        name="email" 
                        id="email">
                    </div>
                    
                    <input type="text" name="estado" value="1" hidden>
                    <input type="text" name="rol_id" value="4" hidden>
                    <input type="text" name="opcion" value="1" hidden>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btnGuardar">Guardar</button>
                <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- **************************************** -->


<!-- Modal - VER SOÑADOR -->
<div class="modal fade" id="modalVerSoñador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos Soñador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
        <div class="row">
            <div class="col-12">
                <img class="img-fluid " width="50px" src="vistas/img/perfiles/soñador.jpg" alt="">
                <p class="font-italic text-muted" id="veremail"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4 float-left">

            <h6><span class="badge badge-secondary">Tipo Documento</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Documento</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Nombres</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Apellidos</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Dirección</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Celular</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Departamento</span></h6>
            <hr>
            <h6><span class="badge badge-secondary">Ciudad</span></h6>


            </div>
            <div class="col-8 float-right">

            <h6 class="textotitulo" id="vertipo"></h6>
            <hr>
            <h6 class="textotitulo" id="verdocumento"></h6>
            <hr>
            <h6 class="textotitulo" id="vernombres"></h6>
            <hr>
            <h6 class="textotitulo" id="verapellidos"></h6>
            <hr>
            <h6 class="textotitulo" id="verdireccion"></h6>
            <hr>
            <h6 class="textotitulo" id="vercelular"></h6>
            <hr>
            <h6 class="textotitulo" id="verdepartamento"></h6>
            <hr>
            <h6 class="textotitulo" id="vermunicipio"></h6>

            </div>
        </div>
        
        
                             
      </div>
      </div>
  </div>
</div>

<!-- ***************************************************** -->


<!-- EDITAR SOÑADOR -->

<div class="modal fade" id="ModalEditarSoñador" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Soñador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarSoñador">
            <div class="modal-body">
                
                <div class="form-group row">
                    <div class="form-group col-sm-6">
                        <label for="tipo" class="col-form-label col-form-label-sm">Tipo de Documento</label>
                        <select class="form-control form-control-sm rounded editartipo" name="tipo" id="tipo" required disabled>
                            <option selected value="">Seleccione...</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CC">Cedula de ciudadania</option>
                            <option value="CE">Cedula de extranjeria</option>
                            <option value="CV">Cedula venezolana</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Documento</label>
                        <input type="text" class="form-control form-control-sm editardocumento" 
                        readonly
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        name="edocumento" 
                        maxlength="12" 
                        id="documento" required>
                    </div> 
                    
                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Nombres</label>
                        <input type="text" class="form-control form-control-sm editarnombres"
                        name="enombres"
                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
                        id="nombres"
                        minlength="3" required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Apellidos</label>
                        <input type="text" class="form-control form-control-sm editarapellidos"
                        name="eapellidos"
                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
                        id="apellidos"
                        minlength="3" required>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Fecha de Nacimiento</label>
                        <input type="date" class="form-control form-control-sm editarf_nacimiento"
                        name="ef_nacimiento"
                        id="f_nacimiento"
                        required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Sexo</label>
                        <select class="form-control form-control-sm rounded editarsexo" name="esexo" id="sexo" required>
                            <option selected value="">Seleccione...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="NB">No binario</option>
                        </select>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Dirección</label>
                        <input type="text" class="form-control form-control-sm editardireccion"
                        name="edireccion"
                        id="direccion"
                        minlength="3" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Celular</label>
                        <input type="text" class="form-control form-control-sm editarcelular" 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        name="ecelular" 
                        maxlength="12" 
                        id="celular" required>
                    </div> 

                    <div class="form-group col-sm-6">
                        <label for="documento" class="col-form-label col-form-label-sm">Departamento</label>
                        <select class="form-control form-control-sm rounded editardepartamento" name="edepartamento" id="departamento" required>
                            <option selected value="">Seleccione...</option>
                            <?php
                                $item = null;
                                $valor = null;

                                $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item,$valor);

                                foreach($departamentos as $key => $value){
                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                }
                            ?>
                        </select>
                    </div>

                    
                    <div class="form-group col-sm-6" id="listaMunicipios"></div>

                    <div class="form-group col-sm-12">
                        <label for="documento" class="col-form-label col-form-label-sm">Correo electronico</label>
                        <input type="email" class="form-control form-control-sm editaremail" 
                        name="eemail" 
                        id="email">
                    </div>
                    
                    <input type="text" name="opcion" value="2" hidden>
                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btnGuardar">Actualizar</button>
                <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--*****************************************************************  -->




