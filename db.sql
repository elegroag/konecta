CREATE DATABASE  konecta_development;

CREATE TABLE konecta_development.categorias (
	id int(15) auto_increment NOT NULL PRIMARY KEY,
	categoria VARCHAR(124) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_spanish2_ci;

CREATE TABLE konecta_development.productos (
	id int(15) auto_increment NOT NULL PRIMARY KEY,
	nombre VARCHAR(124) NOT NULL,
	referencia VARCHAR(124) NOT NULL,
	precio int(8) NOT NULL,
	peso int(8) NOT NULL,
	categoria int(15) NOT NULL,
	stock int(6) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_spanish2_ci;

CREATE INDEX productos_categoria_IDX USING BTREE ON konecta_development.productos (categoria);
ALTER TABLE konecta_development.productos ADD CONSTRAINT productos_FK FOREIGN KEY (categoria) REFERENCES konecta_development.categorias(id) ON DELETE CASCADE ON UPDATE CASCADE;



INSERT INTO konecta_development.categorias (categoria) VALUES
('Bebidas Preparadas'),
('Pan'),
('Cereales'),
('Tamales'),
('Gaseosas');


INSERT INTO konecta_development.productos (nombre, referencia, precio, peso, categoria, stock) VALUES
('Cafe Leche', 'CAFE2', 3000, 750, 1, 120),
('Pan Artesanal', 'PAN1', 5000, 220, 2, 40),
('Pan Dulce', 'PAN2', 4500, 120, 2, 80),
('Pan De La Casa', 'PAN3', 8500, 420, 2, 50),
('Agua Cristal', 'AGUA1', 2500, 300, 1, 50),
('Agua Cristal', 'AGUA1', 2500, 300, 1, 50);


CREATE TABLE konecta_development.ventas (
	id int(20) auto_increment NOT NULL PRIMARY KEY,
	producto int(15) NOT NULL,
	fectura int(15) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_spanish2_ci;


CREATE INDEX ventas_productos_IDX USING BTREE ON konecta_development.ventas (producto);
ALTER TABLE konecta_development.ventas ADD CONSTRAINT ventas_FK FOREIGN KEY (producto) REFERENCES konecta_development.productos(id) ON DELETE CASCADE ON UPDATE CASCADE;

