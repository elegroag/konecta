###################
CodeIgniter
###################


Información Sistema Prueba Konecta
===

Requirements
---

* PHP versión 5.6 es recomendada.       

Descripción problema:
---
Software, que permita almacenar y gestionar el inventario de sus productos.         
Este software debe permitir:        

* la creación de productos,  
* la edición de los productos,      
* la eliminación de productos 
* y listar todos los productos registrados en el sistema.



Funcionalidad requerida:
---
* Realizar una consulta que permita conocer cuál es el producto que más stock tiene.
* Realizar una consulta que permita conocer cuál es el producto más vendido.


Despliegue
----
* Alojar el directorio del proyecto en una ruta que se pueda procesar por el servidor apache. /var/www/html/konecta
* Ingresamos el sql, haciendo import del mismo. Adjunto él ./db.sql, donde se define el usuario y la clave a la base de datos.
* Ingresamos a la ruta http://localhost/konecta/productos 
* git clone https://github.com/elegroag/konecta.git

En shell se requiere:
------
```
$~ git clone https://github.com/elegroag/konecta.git
$~ cd konecta 
$~ git pull origin master 
$~ git checkout -b produccion 
$~ git pull origin produccion 
```

* Segun el ambiente git intentara comprobar el Fast-forward que estas a punto de hacer. Se debe confirmar y ya está listo.

Consultas
----

```
SELECT max(stock), productos.id, nombre, referencia, precio, stock, precio, peso, productos.categoria as idcategoria, categorias.categoria 
FROM productos
INNER JOIN categorias ON categorias.id=productos.categoria;

SELECT count(productos.id) as cantidad, productos.id, nombre, referencia, precio, stock, precio, peso, productos.categoria as idcategoria, categorias.categoria 
FROM ventas
INNER JOIN productos ON productos.id=ventas.producto 
INNER JOIN categorias ON categorias.id=productos.categoria
GROUP BY productos.id
ORDER BY count(productos.id) DESC 
LIMIT 1;
```
