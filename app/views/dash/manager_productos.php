<div class="container">  
  <div class="row"> 			
		<h2 class="text-center"><b>DASH Manager Productos</b></h2>
		<div class="hidden alert alert-success"></div>
   	<ui-view></ui-view>
	</div>
</div>
<script type="text/javascript">
  var _productos = <?=$_productos?>;
  var _categorias = <?=$_categorias?>;
</script>
<script src="<?=asset('module_app.js', 'app')?>"></script> 