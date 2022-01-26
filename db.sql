CREATE USER 'admin_konecta_prueba'@'%' IDENTIFIED BY 'konecta2022*';
GRANT Show databases ON *.* TO 'admin_konecta_prueba'@'%';
GRANT Process ON *.* TO 'admin_konecta_prueba'@'%';
GRANT Alter ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Create view ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Delete ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Create ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Delete history ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Drop ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Grant option ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Index ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Insert ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Select ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Show view ON konecta_development.* TO 'admin_konecta_prueba'@'%';
GRANT Update ON konecta_development.* TO 'admin_konecta_prueba'@'%';


CREATE DATABASE IF NOT EXISTS konecta_development;

CREATE TABLE IF NOT EXISTS konecta_development.categorias (
	id int(15) auto_increment NOT NULL PRIMARY KEY,
	categoria VARCHAR(124) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS konecta_development.productos (
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

CREATE TABLE IF NOT EXISTS konecta_development.ventas (
	id int(20) auto_increment NOT NULL PRIMARY KEY,
	producto int(15) NOT NULL,
	factura char(15) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_spanish2_ci;

CREATE INDEX ventas_productos_IDX USING BTREE ON konecta_development.ventas (producto);
ALTER TABLE konecta_development.ventas ADD CONSTRAINT ventas_FK FOREIGN KEY (producto) REFERENCES konecta_development.productos(id) ON DELETE CASCADE ON UPDATE CASCADE;


INSERT INTO konecta_development.ventas (producto,factura,createAt) VALUES
 (3,'FKO0000001','2022-01-26 11:21:19.0'),
 (3,'FKO0000003','2022-01-26 11:23:04.0'),
 (3,'FKO0000004','2022-01-26 11:23:04.0'),
 (4,'FKO0000005','2022-01-26 12:06:54.0'),
 (4,'FKO0000006','2022-01-26 12:06:54.0'),
 (4,'FKO0000007','2022-01-26 12:06:54.0');