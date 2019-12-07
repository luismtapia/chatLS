<?php
	include("lynxspace.class.php");
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario = $_SESSION['id_usuario'];
	$data = $sitio->persona($id_usuario);
	$foto = $data['foto'];
	$nombre = $data['nombre'];

	if (isset($_POST['enviar'])) {
		$data = $_POST;
		$sitio->publicar($data);
	}
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lynx-Space</title>
	<link rel="stylesheet" type="text/css" href="css/all.min.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/estilo2.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #008080;">
				  	<a href="index.php"><img src="image/Logo.png" style="margin-left: 30px;" alt="logo"></a>
					<div class="collapse navbar-collapse" id="navbarColor01" style="margin-right: 90px;">
				    	<ul class="navbar-nav ml-auto" style="font-size: 17px;">
				    		<li class="nav-item active">
				    			<a class="nav-link" href="index.php">
							  	<?php
								if (is_null($data['foto'])) {
									echo "<img src='uploads/default.png' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}else{
									echo "<img src='uploads/$foto' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}
								?>
								<?php echo $data['nombre']." ".$data['apellidos']." (".$data['apodo'].")"; ?>
								</a>
				    		</li>
					      	<li class="nav-item active">
					        	<a class="nav-link" href="index.php">Inicio</a>
					      	</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="amigos.php">Amigos</a>
			  				</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="sugerencias.php">Sugerencias</a>
			  				</li>
					      	<li class="nav-item dropdown">
			      				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+ Opciones
			      				</a>
			      				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			      					<a class="dropdown-item" href="editar_perfil.php">Editar Perfil</a>
			        				<a class="dropdown-item" href="seguridad.php">Roles y Privilegios</a>
			        				<a class="dropdown-item" href="admi_seguridad.php">Administrador</a>
			        				<a class="dropdown-item" href="log_out.php">Salir</a>
			      				</div>
			    			</li>
				   	 	</ul>
				  	</div>
				</nav>
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-sm-12">
				<form method="POST" action="index.php">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" placeholder="¿Que piensas?" name="mensaje">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="submit" name="enviar" value="Publicar" class="btn btn-dark btn-block">
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>













	<div class="container">
              <div class="row">
                <div class="col-sm-8">
                    <article>
											<?php
													$var_mensaje=$sitio->indice();
												if(isset($_GET['accion'])){
															$accion=$_GET['accion'];
															switch ($accion){
																case 'reaccion':
																		if(isset($_GET['id_mensaje']) AND isset($_GET['reaccion'])){
																				$reaccion=$_GET['reaccion'];
																				$id_mensaje=$_GET['id_mensaje'];
																				$sitio->reaccion($id_mensaje,$reaccion);
																				header('Location: index.php');
																		}
																	break;
															 case 2:
															 break;
														}
													}
													foreach($var_mensaje as $key =>$n){
															$sitio->mensaje($n);
													}
												?>
												<div class="card-footer">
													<div class="row reacciones">
															<div class="col-sm-3">
																	<button type="button" class="btn btn-outline-primary">
																		<i class="material-icons">thumb_up</i>
																		Me gusta</button>
															</div>
															<div class="col-sm-3">
																	<button type="button" class="btn btn-outline-danger">
																		<i class="material-icons">thumb_down</i>
																		No gusta</button>
															</div>
															<div class="col-sm-3">
																	<button type="button" class="btn btn-outline-warning">
																		<i class="material-icons">comment</i>
																		Comentar</button>
															</div>
															<div class="col-sm-3">
																	<button type="button" class="btn btn-outline-success">
																		<i class="material-icons">share</i>
																		Compartir</button>
															</div>
													</div>
												</div>
											</div>






                        <div class="card" style="width: 45rem;">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-12 sprite">
                                  <div class="sprite_editar"></div>
                                  <div class="sprite_cancelar"></div>
                              </div>
                            </div>
                            <h2 class="card-title"><img src="image/tux.png" width="45" height="45"/>Sherlock</h2>
                            <h6 class="card-subtitle mb-2 text-muted">Hace 3 días</h6>
                            <div class="row cuerpo">

                              <iframe width="560" height="315" src="https://www.youtube.com/embed/SlgtjRq5AXs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>

                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row reacciones">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-primary">
                                      <i class="material-icons">thumb_up</i>
                                      Me gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-danger">
                                      <i class="material-icons">thumb_down</i>
                                      No gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-warning">
                                      <i class="material-icons">comment</i>
                                      Comentar</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-success">
                                      <i class="material-icons">share</i>
                                      Compartir</button>
                                </div>
                            </div>
                          </div>
                        </div>







                        <div class="card" style="width: 45rem;">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-12 sprite">
                                  <div class="sprite_editar"></div>
                                  <div class="sprite_cancelar"></div>
                              </div>
                            </div>
                            <h2 class="card-title"><img src="image/Merida.png" width="45" height="45"/>Merida</h2>
                            <h6 class="card-subtitle mb-2 text-muted">Hace 5 días</h6>
                            <div class="row cuerpo">
                                    <br/>Al primer momento de asfixia se valiente y huye... <3
                            </div>
                            <div class="row cuerpo">
                                <img src="image/valiente.jpg" width="200" height="300" />
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row reacciones">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-primary">
                                      <i class="material-icons">thumb_up</i>
                                      Me gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-danger">
                                      <i class="material-icons">thumb_down</i>
                                      No gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-warning">
                                      <i class="material-icons">comment</i>
                                      Comentar</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-success">
                                      <i class="material-icons">share</i>
                                      Compartir</button>
                                </div>
                            </div>
                          </div>
                        </div>






                        <div class="card" style="width: 45rem;">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-12 sprite">
                                  <div class="sprite_editar"></div>
                                  <div class="sprite_cancelar"></div>
                              </div>
                            </div>
                            <h2 class="card-title"><img src="image/deadpool.png" width="45" height="45"/>Deadpool</h2>
                            <h6 class="card-subtitle mb-2 text-muted">Hace 7 días</h6>
                            <div class="row cuerpo">
                                    <br/>¿Se preguntaran porque el traje rojo?¡Ah! s para que los chicos malos no me vean sangrar. Aquel sujeto sabe de lo que hablo, tiene pantaones marrones.
                            </div>
                            <div class="row cuerpo">
                                <img src="image/deadpool_unicornio.png" width="200" height="300" />
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row reacciones">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-primary">
                                      <i class="material-icons">thumb_up</i>
                                      Me gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-danger">
                                      <i class="material-icons">thumb_down</i>
                                      No gusta</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-warning">
                                      <i class="material-icons">comment</i>
                                      Comentar</button>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-outline-success">
                                      <i class="material-icons">share</i>
                                      Compartir</button>
                                </div>
                            </div>
                          </div>
                        </div>





                    </article>
                </div>
                <div class="col-sm-4" id="mensajero">
                    <div class="row">
                      <div class="col-sm-12">
                        <h2>Conectados</h2>
                      </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/1.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Magdalena Magaña</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/2.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Sergio Casillas Sotelo</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/3.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Samantha Flores Sánchez</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/4.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Benjamin Ruiz</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/5.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Noé Reyes</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/6.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Ramsses Jhosep Esquivel</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/7.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Paloma Granados</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/8.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Joseline Mondragón</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/9.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Cynthia Rodriguez</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/10.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Alejandro Avila Montero</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/11.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>Yesenia Rodriguez</span>
                        </div>
                        <div class="col-sm-3 pa">
                          <img class="rounded-circle" src="image/personas/12.png" width="32" height="32">
                        </div>
                        <div class="col-sm-9">
                          <span>David Berosini</span>
                        </div>
                        <div class="col-sm-12">
                          <form class="form-inline">
                              <button  type="button" class="btn btn-success btn-lg btn-block ">Abrir Conversación
                                <img src="image/mensajero.png" width="32" height="32" class="conversar">
                              </button>
                          </form>
                        </div>

                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-8">
                    <h4>Sobre LynxSpace</h4>
                    <ul class="list-unstyled">
                        <a href="#"><li>Política de privacidad</li></a>
                        <a href="#"><li>Términos y condiciones</li></a>
                        <a href="#"><li>Publicidad</li></a>
                    </ul>
                </div>
                <div class="col-sm-4 sprite">
                    <div class="sprite_rss sprite_animacion"></div>
                    <div class="sprite_youtube sprite_animacion"></div>
                    <div class="sprite_compartir sprite_animacion"></div>

                </div>
              </div>
        </div>
</body>
</html>
