
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
		$(".pantalla").each(function(){
			$(this).hide();
		});
		$(".pantallas").find("." + clase).fadeIn(200);
		if(clase=='lista'){
			$(".mensaje-error").hide();
			init($scope);
		}	
		if(clase=='detalles'){
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

			  });
		}
		
	}
});

function init($scope){
	fetch('https://jsonplaceholder.typicode.com/posts')
  .then(function(response){
  	return response.json();
  }).then(function(J){
  	$scope.posts = J;
  	$scope.$apply();
  });
}

function insertarComentarios($scope, id){
	fetch('https://jsonplaceholder.typicode.com/id/comments')
  .then(function(response){
  	return response.json();
  }).then(function(J){
  	$scope.comentarios = J;
  	$scope.$apply();
  });
}
