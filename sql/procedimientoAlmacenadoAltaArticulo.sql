DELIMITER //
CREATE PROCEDURE altaArticulo(IN P_sku INT(6),IN P_articulo VARCHAR(15), IN P_marca VARCHAR(15), IN P_modelo VARCHAR(20), IN P_departamento INT(1), IN P_clase INT(2), IN P_familia INT(3), IN P_cantidad INT(9), IN P_stock INT(9)) 
BEGIN 
	INSERT INTO articulos(sku, articulo, marca, modelo, fk_departamento,fk_clase,fk_familia,fechaAlta,stock,cantidad,descontinuado,fechaBaja, borrado) VALUES (P_sku, P_articulo, P_marca, P_modelo, P_departamento, P_clase, P_familia, CURDATE(), P_stock, P_cantidad, 0, '1900-01-01', 0); 
	
END;
DELIMITER ;


DELIMITER //

CREATE PROCEDURE borradologico(IN P_sku INT(6))
BEGIN
	UPDATE articulos SET borrado = 1 WHERE sku = P_sku;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE cambiararticulo(
  IN p_sku INT,
  IN p_articulo TEXT,
  IN p_marca TEXT,
  IN p_modelo TEXT,
  IN p_fk_departamento INT,
  IN p_stock INT,
  IN p_cantidad INT,
  IN p_descontinuado INT,
  IN p_fk_clase INT,
  IN p_fk_familia INT
)
BEGIN
  UPDATE articulos
  SET
    articulo = p_articulo,
    marca = p_marca,
    modelo = p_modelo,
    fk_departamento = p_fk_departamento,
    stock = p_stock,
    cantidad = p_cantidad,
    descontinuado = p_descontinuado,
    fk_clase = p_fk_clase,
    fk_familia = p_fk_familia
  WHERE sku = p_sku;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE ObtenerDatosArticulo(IN sku_param INT)
BEGIN
    DECLARE departamento_nombre TEXT;
    DECLARE clase_nombre TEXT;
    DECLARE familia_nombre TEXT;
    
    -- Obtener el nombre del departamento
    SELECT nombre INTO departamento_nombre FROM departamento WHERE id = (SELECT fk_departamento FROM articulos WHERE sku = sku_param);
    
    -- Obtener el nombre de la clase
    SELECT nombre INTO clase_nombre FROM clase WHERE id = (SELECT fk_clase FROM articulos WHERE sku = sku_param);
    
    -- Obtener el nombre de la familia
    SELECT nombre INTO familia_nombre FROM familia WHERE id = (SELECT fk_familia FROM articulos WHERE sku = sku_param);
    
    -- Devolver los resultados
    SELECT articulos.articulo, articulos.marca, articulos.modelo, articulos.stock, articulos.cantidad, articulos.descontinuado,articulos.fechaAlta, articulos.fechaBaja, departamento_nombre, clase_nombre, familia_nombre
    FROM articulos 
    WHERE sku = sku_param;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ObtenerInfoDepartamento()
BEGIN
	SELECT d.id, d.nombre AS departamento, c.numero AS clase, c.nombre AS nombre_clase, f.numero AS familia, f.nombre AS nombre_familia
    FROM departamento d
    JOIN clase c ON d.id = c.fk_departamento
    JOIN familia f ON c.id = f.fk_clase;
END //

DELIMITER ;
