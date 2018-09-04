
appgeneral.controller("ctrl", function($scope, $http){
	$scope.titulo = "Examen Hero Guest";
	$scope.instrucciones = "Da click en un boton para seleccionar una acción";
	$scope.posts = [];
	$scope.seleccionado;
	$scope.tituloPost;
	$scope.contenidoPost;

	init($scope);
  
	$scope.cambiarPag = function(clase, titulo){
		$scope.titulo = titulo;
		$scope.tituloPost = '';
		$(".pantalla").each(function(){
			$(this).hide();
		});
		$(".pantallas").find("." + clase).fadeIn(200);
		if(clase=='lista'){
			$(".mensaje-error").hide();
			$scope.instrucciones = "Da click en un post para ver detalles";
			init($scope);
		}	
		if(clase=='detalles'){
			$scope.instrucciones = '';
			$scope.tituloPost = this.x.title;
			$scope.contenidoPost = this.x.body;
			insertarComentarios($scope, this.x.id);
		}
	}
	$scope.buscarServidor = function(){
		var id =$scope.searchID;
		var url = 'https://jsonplaceholder.typicode.com/posts/' + $scope.searchID;
		console.log(id);
		if(id == ''){
			url = 'https://jsonplaceholder.typicode.com/posts';
			init($scope);
		}else{
			$(".loader").show();
			console.log(url);
			fetch(url)
			  .then(function(response){
			  	return response.json();
			  }).then(function(J){
			  	console.log(J);
			  	if($.isEmptyObject(J)){
			  		$(".mensaje-error").show();
			  	}else{

			  		$(".mensaje-error").hide();
			  	}
			  	console.log(J);
			  	$scope.posts = [];
			  	$scope.posts.push(J);
			  	$scope.$apply();
			  	$(".loader").hide();
			  });
		}
		
	}

	$scope.agregarPost = function(){
		$(".mensaje").hide();
		if(!$scope.tituloInput || !$scope.contenidoInput){
			$(".mensaje-error-enviar").fadeIn(300);
		}else{
			$http({
				url: 'https://jsonplaceholder.typicode.com/posts',
				method: "POST",
				data: {"title": $scope.tituloInput, "body": $scope.contenidoInput, "userId": 1}
				}).then(function(s){
					$scope.idNuevo = s.data.id;
					$(".mensaje-exito-enviar").show();
					console.log(s);
				}, function(err){
					console.log(err);
			});
		}
		
	}
});

function init($scope){
	$(".loader").show();
	fetch('https://jsonplaceholder.typicode.com/posts')
  .then(function(response){
  	return response.json();
  }).then(function(J){
  	$scope.posts = J;
  	$scope.$apply();
  	$(".loader").hide();
  });
}

function insertarComentarios($scope, id){
	$(".loader").show();
	fetch('https://jsonplaceholder.typicode.com/posts/' + id +'/comments')
  .then(function(response){
  	return response.json();
  }).then(function(J){
  	$scope.comentarios = J;
  	$scope.$apply();
  	$(".loader").hide();
  });
}
