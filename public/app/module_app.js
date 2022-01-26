
const module_app = angular.module('app_crud', ['ui.router', 'ui-notification']);
var _app = {};
_app.productos = _productos;
_app.categorias = _categorias;


module_app.config(
function($stateProvider, $urlRouterProvider, NotificationProvider){
	$stateProvider
	.state({
		name: 'index',
		url: '/index',
		templateUrl: base_url+"public/app/views/tmp_tabla_productos.html",
		controller: 'ListarProductos'
	})
	.state({
		name: 'agregar',
		url: '/agregar',
		templateUrl: base_url+"public/app/views/tmp_form_producto.html",
		controller: 'AgregarProducto'
	})
	.state({
		name: 'editar',
		url: '/editar/:id',
		templateUrl: base_url+"public/app/views/tmp_editar_producto.html",
		controller: 'EditarProducto'
	})
	.state({
		name: 'mostrar',
		url: '/mostrar/:id',
		templateUrl: base_url+"/public/app/views/tmp_mostrar_producto.html",
		controller: 'MostrarProducto'
	}).state({
		name: "ventas_stock",
		url: "/ventas_stock",
		templateUrl: base_url+"/public/app/views/tmp_ventas_stock.html",
		controller: 'VentasStock'
	})	

	$urlRouterProvider.otherwise('index');
	NotificationProvider.setOptions({
		delay: 10000,
		startTop: 20,
		startRight: 10,
		verticalSpacing: 20,
		horizontalSpacing: 20,
		positionX: 'left',
		positionY: 'bottom'
	});
}).
factory('_app', function($http, Notification, $state){
	_app.categorias = _categorias;
	_app.categoria = {};
	_app.producto = {};
	_app.ventas = {};

	_app.mensaje = function(texto, state){
		if(state == 200){
			Notification.success(texto);
		}else{
			Notification.error('Error. '+texto);
		}
	};

	_app.add_producto = function(producto){
		$http({
			url: site_url+'rest_productos',
			method: 'POST',
			dataType: "json",
			data: producto
		}).then(function successCallback(response)
		{
			if(response.data.state == 200)
			{
				_app.producto = response.data.model;
				_app.categoria = _.findWhere(_app.categorias, {id: ""+producto.categoria});
				_app.producto.categoria = _app.categoria.categoria;
				_app.productos.push(_app.producto);
				Notification.success('Registro con éxito');
				$state.go('index');
			}else{
				Notification.error('Registro no es posible, error de validación');
			}
		}, function errorCallback(response){
			Notification.error('Error, el registro no es posible</br>'+response.data.message);
		});
	};

	_app.up_producto = function(producto){
		$http({
			method: 'PUT',
			url: site_url+'rest_productos/' + producto.id,
			data: producto
		}).then(function successCallback(response)
		{
			var indice = _app.productos.indexOf(_app.productos);
			_app.categoria = _.findWhere(_app.categorias, {id: ""+producto.categorias_id});

			_app.producto.categoria = _app.categoria.categoria;
			_app.productos[indice] = _app.producto;
			Notification.success('Registro con éxito');
		}, function errorCallback(response){
				Notification.error('Error, el registro no es posible</br>'+response.data.message);
		});
	};

	_app.remove_producto = function(producto){
		$http({
			method: 'delete',
			dataType: 'json',
			url: site_url+'rest_productos/'+producto.id
		}).then(function successCallback(response){
			var indice = _app.productos.indexOf(producto);
			_app.productos.splice(indice, 1);
			Notification.success('Registro con éxito');
		}, function errorCallback(response){
			console.log(response.responseText);
		});
	};

	return _app;
})
.controller('ListarProductos', function($scope, $state, _app){
	$scope.productos = _app.productos;
	$scope.categorias = _app.categorias;

	$scope.agregar = function(){
		$state.go('agregar');
	};

	$scope.editar = function(producto){
		_app.producto = producto;
		$state.go('editar', {id: producto.id});
	};

	$scope.borrar = function(producto){
		_app.producto = producto;
		_app.remove_producto(producto);
	};

	$scope.mostrar = function(producto){
		_app.producto = producto;
		$state.go('mostrar',{id: producto.id});
	};

	$scope.ventas_stock = function(){
		$state.go('ventas_stock');
	};
})
.controller('EditarProducto', function($stateParams, $scope, $state, _app){
	if(_.size(_app.producto) == 0){
		_app.producto = _.findWhere(_app.productos, {id: ""+$stateParams.id});
		$scope.producto = _app.producto;
	}else{
		$scope.producto = _app.producto;
	}
	if(!$scope.producto) { 
		$state.go('index'); 
		return false;
	}

	$scope.categorias = _app.categorias;
	
	$scope.categoria_actual = {
		"name": _app.producto.categoria,
		"id":_app.producto.idcategoria
	};

	$scope.lista = function(){
		$state.go('index');
	};

	$scope.actualizar = function()
	{
		_app.producto = $scope.producto;
		_app.up_producto(_app.producto);
		$state.go('index');
	};

	$scope.change_categoria = function(){
		_id = $("[name='categoria']").val();
		categoria = _.findWhere(_app.categorias, {id: ""+_id});
		$scope.categoria_id = categoria.id;
		$scope.categoria_detalle = categoria.categoria;
	};

	$scope.mostrar = function(producto){
		_app.producto = producto;
		$state.go('mostrar', {id: producto.id});
	};
})
.controller('AgregarProducto', function($scope, $state, _app){
	$scope.producto = {};
	$scope.categorias = _app.categorias;

	$scope.lista = function(){
		$state.go('index');
	};

	$scope.registrar = function(){
		$scope.producto.categoria = parseInt($scope.producto.categoria);
		$scope.producto.id = parseInt($scope.producto.id);
		_app.add_producto($scope.producto);
	};

	$scope.mostrar = function(){
	};

	$scope.change_categoria = function(){
		_id = $("[name='categoria']").val();
		categoria = _.findWhere(_app.categorias, {id: ""+_id});
		$scope.categoria_id = categoria.id;
		$scope.categoria_detalle = categoria.categoria;
	};
})
.controller('MostrarProducto', function($stateParams, $scope, $state, _app){
	if(_.size(_app.producto) == 0){
		_app.producto = _.findWhere(_app.productos, {id: ""+$stateParams.id});
		$scope.producto = _app.producto;
	}else{
		$scope.producto = _app.producto;
	}
	
	if(!$scope.producto) { 
		$state.go('index'); 
		return false;
	}

	$scope.lista = function(){
		$state.go('index');
	};
})
.controller('VentasStock', function($scope, $state, $app){
	$scope.lista = function(){
		$state.go('index');
	};
});
