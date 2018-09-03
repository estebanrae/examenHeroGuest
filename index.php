<?php include("header.html");?>
<div class="contenedor-principal" ng-app="app" ng-controller="ctrl">
	<p class="titulo">{{titulo}}</p>
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
					<input ng-model="searchID">
					<button ng-click="buscarServidor()">Buscar en Servidor</button>
				</p>
				
			</div>
			<p class="mensaje-error inactive">Su busqueda no generó resultados</p>
			<table>
				<tr><th>Titulo</th></tr>
				<tr class="posts" ng-repeat="x in posts | filter:searchText "><td ng-click="cambiarPag('detalles', 'Detalles')" data-id="{{x.id}}">{{x.title}}</td></tr>
			</table>

		</div><!-- pantalla-1 -->
		<div class="pantalla detalles">
			<div class="contenedor-info">
				<label>Titulo</label>
				<p ng-bind="tituloPost"></p>
				<label>Descripcion</label>
				<p ng-bind="contenidoPost"></p>
			</div>
			<div class="contenedor-comentarios">
				<label>Comentarios</label>
				<p ng-repeat="x in comentarios">{{x.name}}</p>
			</div>
		</div><!-- pantalla-2 -->
		<div class="pantalla nuevo">
			Nuevo
		</div><!-- pantalla-3 -->
	</div>

</div><!-- Contenedor Principal -->
<?php include("footer.html"); ?>