<div class='row'>
	<div class='col-sm-12 col-md-auto mr-auto pr-0 d-none d-md-inline'>
		<label class='text-nowrap mb-0'>Mostrar
			<select id='cantidad_paginate' name='cantidad_paginate' class='form-control form-control-sm d-sm-inline-block w-auto' onchange='changeCantidadPagina()'>
				<option value='5'>5</option>
				<option value='10'>10</option>
				<option value='15'>15</option>
				<option value='30'>30</option>
				<option value='50'>50</option>
				<option value='100'>100</option>
			</select>
			registros
		</label>
	</div>
	<div class='col-sm-12 col-md-auto pl-0 pr-0 pr-sm-3'>
		<nav>
			<ul class='pagination justify-content-center justify-content-md-end mb-0'>
				<li class='page-item' onclick="buscar(this)" pagina='{$paginate->first}'>
					<a class='page-link'><i class='fa fa-angle-double-left'></i></a>
				</li>
				<li class='page-item' onclick="buscar(this)" pagina='{$paginate->before}'>
					<a class='page-link'><i class='fa fa-angle-left'></i></a>
				</li>
				<?
				for($i=$paginate->current-5; $i < $paginate->current;$i++)
				{
					if($i < $paginate->first) continue;
					?> <li class='page-item' onclick="buscar(this)"><a class='page-link'><?=$i?></a></li> <? 
				}
				for($i=$paginate->current; $i<= ($paginate->current+5); $i++)
				{
					$clase = "";
					if($i == $paginate->current) $clase = "active";
					if($i > $paginate->last) continue; 
					?> <li class='page-item <?=$clase?>' onclick="buscar(this)"><a class='page-link'><?=$i?></a></li> <? 
				} ?>

				<li class='page-item' onclick="buscar(this)" pagina='{$paginate->next}'>
					<a class='page-link'><i class='fa fa-angle-right'></i></a>
				</li>
				<li class='page-item' onclick="buscar(this)" pagina='{$paginate->last}'>
					<a class='page-link'><i class='fa fa-angle-double-right'></i></a>
				</li>
			</ul>
		</nav>
	</div>
</div>