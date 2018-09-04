<?php include("header.html");?>
<div class="contenedor-principal" ng-app="app" ng-controller="ctrl">
	<p class="titulo">{{titulo}}{{tituloPost}}</p>
	<div class="botones">
		<button class="active" ng-click="cambiarPag('lista', 'Lista de Posts')">Lista de Posts</button>
		<button ng-click="cambiarPag('nuevo', 'Agregar Nuevo Post')">Agregar nuevo post</button>
	</div>
	<div class="instrucciones" >
		<p ng-bind="instrucciones"></p>
	</div>
	<div class="pantallas">
		<div class="pantalla lista">
			<div class="busqueda">
				<p>
					<label>Buscar por nombre:</label>
					<input ng-model="searchText.title">	
				</p>
				<p>
					<label>Buscar por ID:</label>
					<input ng-model="searchID" ng-keyup="buscarServidor()">
					<span class="loader"></span>
				</p>
				
			</div>
			<p class="mensaje-error inactive">Su busqueda no generó resultados</p>
			<table>
				<tr><th>Posts</th></tr>
				<tr class="posts" ng-repeat="x in posts | filter:searchText "><td ng-click="cambiarPag('detalles', 'Detalles de: ')" data-id="{{x.id}}">{{x.title}}</td></tr>
			</table>

		</div><!-- pantalla-1 -->
		<div class="pantalla detalles">
			<div class="contenedor-info">
				<label>Titulo</label>
				<p ng-bind="tituloPost"></p>
				<label>Descripcion</label>
				<p ng-bind="contenidoPost"></p>
			</div>
			<span class="loader"></span>
			<div class="contenedor-comentarios">
				<label>Comentarios</label>
				<div class="comentario" ng-repeat="x in comentarios">

					<span class="titulos">
						<p>{{x.name}}</p>
						<p class="mail">{{x.email}}</p>
					</span>
					<div class="contenido-comentario">
						<p>{{x.body}}</p>	
					</div>
				
				</div>
			</div>
		</div><!-- pantalla-2 -->
		<div class="pantalla nuevo">
			<form class="formulario">
				<p>
				<label>Titulo</label>
				<input ng-model="tituloInput" />
				</p>
				<p>
				<label>Contenido</label>
				<textarea  ng-model="contenidoInput" ></textarea>
				</p>
				<button ng-click="agregarPost()">Guardar</button>
			</form>
			<div class=" mensaje mensaje-error-enviar">Por favor llene todos los campos</div>
			<div class=" mensaje mensaje-exito-enviar" >Se ha agregado el POST con ID: <span ng-bind="idNuevo"></span></div>
		</div><!-- pantalla-3 -->
	</div>

</div><!-- Contenedor Principal -->
<?php include("footer.html"); ?>