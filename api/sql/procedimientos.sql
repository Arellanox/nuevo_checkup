CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_config_guardar`(IN _json JSON)
BEGIN
    INSERT INTO tracking_config (json_data) VALUES (_json);
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_config_obtener`()
BEGIN
    SELECT json_data FROM tracking_config ORDER BY id DESC LIMIT 1;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_entidad_categoria_agregar`(
    IN _type VARCHAR(50), IN _id INT, IN _super VARCHAR(50), IN _cat VARCHAR(50), IN _sub VARCHAR(50)
)
BEGIN
    INSERT INTO tracking_entidad_categorias (entidad_tipo, entidad_id, super_category_id, category_id, subcategory_id)
    VALUES (_type, _id, _super, _cat, _sub);
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_medicos_b`(IN `_medico_tratante` int)
BEGIN
	
	
	set _medico_tratante = if(_medico_tratante = 0, null, _medico_tratante);
	
	SELECT
	turn.ID_TURNO,
	turn.PREFOLIO,
	CONCAT( pac.NOMBRE, ' ', pac.PATERNO, ' ', pac.MATERNO ) PX,
	cli.NOMBRE_COMERCIAL PROCEDENCIA,
	turn.FECHA_RECEPCION,
	turn.PREFOLIO,
	med.NOMBRE_MEDICO,
	med.ESPECIALIDAD,
	DATE(turn.FECHA_RECEPCION) FECHA_INGRESO,
	concat(hour(turn.FECHA_RECEPCION),':', MINUTE(turn.FECHA_RECEPCION)) HORA_INGRESO,
	med.EMAIL CORREO_MEDICO,
	pac.CURP,
	CONCAT(pac.COLONIA,' ', pac.CALLE, ' ',pac.INTERIOR, pac.EXTERIOR, ' ', pac.POSTAL, '. ', pac.MUNICIPIO) DIRECCION,
	turn.DIAGNOSTICO,
	pac.GENERO,
	ROW_NUMBER() over (ORDER BY turn.ID_TURNO desc) COUNT,
	
	SUM(ct.PRECIO_VENTA) SUBTOTAL,
	SUM(ct.MONTO_IVA) IVA,
	
	SUM(ct.TOTAL) TOTAL_CON_IVA
FROM
	turnos turn
	LEFT JOIN pacientes pac ON pac.ID_PACIENTE = turn.PACIENTE_ID
	LEFT JOIN clientes cli ON cli.ID_CLIENTE = turn.CLIENTE_ID
	LEFT JOIN medicos_tratantes med ON med.ID_MEDICO = turn.MEDICO_TRATANTE
	LEFT JOIN cargos_turno ct on ct.TURNO_ID = turn.ID_TURNO
	AND ct.ACTIVO = 1
WHERE
	turn.ACTIVO = 1 
	AND turn.ACEPTADO = 1 
	AND 
		case when _medico_tratante is null then 
			1
	 when _medico_tratante =3 then
			(turn.MEDICO_TRATANTE = 3 or turn.MEDICO_TRATANTE = 2)
		else
			turn.MEDICO_TRATANTE = _medico_tratante
		end
	
GROUP BY
	turn.ID_TURNO
ORDER BY
	turn.ID_TURNO DESC;

END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_nomina_crear`(
    IN _worker_id INT, IN _anio INT, IN _quin INT,
    IN _dias INT, IN _bono DECIMAL(10,2), IN _imss DECIMAL(10,2),
    IN _monto DECIMAL(10,2), IN _fecha DATE
)
BEGIN
    INSERT INTO tracking_nomina (trabajador_id, periodo_anio, periodo_quincena, dias_trabajados, bono, imss, monto_total, fecha_pago)
    VALUES (_worker_id, _anio, _quin, _dias, _bono, _imss, _monto, _fecha);
    SELECT LAST_INSERT_ID() as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_pagos_crear`(
    IN _proveedor_id INT,
    IN _folio VARCHAR(50),
    IN _fecha_emision DATE,
    IN _fecha_limite DATE,
    IN _monto DECIMAL(10,2),
    IN _archivo_ruta VARCHAR(255)
)
BEGIN
    INSERT INTO tracking_pagos (proveedor_id, folio_fiscal, fecha_emision, fecha_limite_pago, monto_total, archivo_ruta)
    VALUES (_proveedor_id, _folio, _fecha_emision, _fecha_limite, _monto, _archivo_ruta);
    SELECT LAST_INSERT_ID() as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_pagos_listado`(IN _filter INT)
BEGIN
    SELECT 
        tp.id, 
        tp.proveedor_id as entidad_id,
        prov.razon_social as nombre, 
        tp.folio_fiscal as factura, 
        tp.fecha_emision as emision, 
        tp.fecha_limite_pago as pagoEstimado, 
        tp.estado as status, 
        tp.fecha_pago as fechaPago,
        'Gastos' as categoria,
        tp.monto_total
    FROM tracking_pagos tp
    LEFT JOIN tracking_proveedores prov ON tp.proveedor_id = prov.id
    WHERE tp.activo = 1
    
    UNION ALL
    
    SELECT 
        tn.id,
        tn.trabajador_id as entidad_id,
        tr.nombre_completo as nombre,
        CONCAT('NOM-', tn.periodo_anio, '-Q', tn.periodo_quincena) as factura,
        tn.fecha_pago as emision,
        tn.fecha_pago as pagoEstimado,
        'pendiente' as status,
        NULL as fechaPago,
        'Nómina' as categoria,
        tn.monto_total
    FROM tracking_nomina tn
    LEFT JOIN tracking_trabajadores tr ON tn.trabajador_id = tr.id
    WHERE tn.activo = 1
    
    ORDER BY pagoEstimado ASC;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_profesionales_crear`(
    IN _nombre VARCHAR(255), IN _esp VARCHAR(100), IN _mod VARCHAR(50), IN _monto DECIMAL(10,2),
    IN _inicio DATE, IN _fin DATE, IN _dom TEXT, IN _tel VARCHAR(20), IN _mail VARCHAR(100),
    IN _obs TEXT, IN _banco VARCHAR(50), IN _clabe VARCHAR(20), IN _unidad INT
)
BEGIN
    INSERT INTO tracking_profesionales (nombre_completo, especialidad, modalidad_fiscal, monto_honorarios, fecha_inicio, fecha_terminacion, domicilio, telefono, correo, observaciones, banco, cuenta_clabe, unidad_negocio_id)
    VALUES (_nombre, _esp, _mod, _monto, _inicio, _fin, _dom, _tel, _mail, _obs, _banco, _clabe, _unidad);
    SELECT LAST_INSERT_ID() as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_profesionales_listado`(IN _p INT, IN _l INT)
BEGIN
    SELECT p.*,
    (SELECT COUNT(*) FROM tracking_entidad_categorias tec 
     WHERE tec.entidad_id = p.id AND tec.entidad_tipo = 'PROFESIONAL' AND tec.activo = 1) as etiquetas_count
    FROM tracking_profesionales p WHERE p.activo = 1 ORDER BY p.nombre_completo;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_crear`(
    IN _razon VARCHAR(255), IN _contacto VARCHAR(255), IN _tel VARCHAR(20), IN _mail VARCHAR(100),
    IN _rfc VARCHAR(15), IN _banco VARCHAR(50), IN _clabe VARCHAR(20), IN _cred TINYINT, IN _dias INT, IN _unidad INT
)
BEGIN
    INSERT INTO tracking_proveedores (razon_social, nombre_contacto, telefono, correo, rfc, banco, cuenta_clabe, tiene_credito, dias_credito, unidad_negocio_id)
    VALUES (_razon, _contacto, _tel, _mail, _rfc, _banco, _clabe, _cred, _dias, _unidad);
    SELECT LAST_INSERT_ID() as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_eliminar`(IN _id INT)
BEGIN
    UPDATE tracking_proveedores SET activo = 0 WHERE id = _id;
    SELECT _id as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_listado`(
    IN _pagina INT,
    IN _limite INT
)
BEGIN
    DECLARE _offset INT;
    IF _pagina IS NULL OR _pagina < 1 THEN SET _pagina = 1; END IF;
    IF _limite IS NULL OR _limite < 1 THEN SET _limite = 1000; END IF;
    SET _offset = (_pagina - 1) * _limite;

    SELECT 
        p.*,
        (SELECT COUNT(*) FROM tracking_entidad_categorias tec 
         WHERE tec.entidad_id = p.id AND tec.entidad_tipo = 'PROVEEDOR' AND tec.activo = 1) as etiquetas_count
    FROM tracking_proveedores p
    WHERE p.activo = 1
    ORDER BY p.razon_social ASC
    LIMIT _limite OFFSET _offset;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_atributos`()
BEGIN
    SELECT * 
    FROM tracking_entidad_categorias 
    WHERE entidad_tipo = 'TRABAJADOR' AND activo = 1;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_crear`(
    IN _nombre VARCHAR(255), IN _puesto VARCHAR(100), IN _salario DECIMAL(10,2), IN _inicio DATE,
    IN _curp VARCHAR(20), IN _rfc VARCHAR(15), IN _nss VARCHAR(20), IN _tel VARCHAR(20),
    IN _mail VARCHAR(100), IN _banco VARCHAR(50), IN _clabe VARCHAR(20)
)
BEGIN
    INSERT INTO tracking_trabajadores (nombre_completo, puesto, salario_diario, fecha_inicio, curp, rfc, nss, telefono, correo, banco, cuenta_clabe)
    VALUES (_nombre, _puesto, _salario, _inicio, _curp, _rfc, _nss, _tel, _mail, _banco, _clabe);
    SELECT LAST_INSERT_ID() as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_eliminar`(IN _id INT)
BEGIN
    UPDATE tracking_trabajadores SET activo = 0 WHERE id = _id;
    SELECT _id as id;
END;

CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_listado`(IN _activo TINYINT)
BEGIN
    SELECT * FROM tracking_trabajadores WHERE activo = IFNULL(_activo, 1) ORDER BY nombre_completo;
END;

-- 17. LISTADO ACTUALIZADO (CATEGORIAS + MONTOS)
DROP PROCEDURE IF EXISTS sp_tracking_pagos_listado;

CREATE PROCEDURE sp_tracking_pagos_listado(IN _filter INT)
BEGIN
    SELECT 
        tp.id, 
        tp.proveedor_id as entidad_id,
        prov.razon_social as nombre, 
        tp.folio_fiscal as factura, 
        tp.fecha_emision as emision, 
        tp.fecha_limite_pago as pagoEstimado, 
        tp.estado as status, 
        tp.fecha_pago as fechaPago,
        tp.monto_total,
        COALESCE(p_cat.super_category_id, 'S/C') as super_categoria,
        COALESCE(p_cat.category_id, 'Gasto General') as categoria,
        COALESCE(p_cat.subcategory_id, '-') as sub_categoria,
        'PROVEEDOR' as origen_tipo
    FROM tracking_pagos tp
    LEFT JOIN tracking_proveedores prov ON tp.proveedor_id = prov.id
    LEFT JOIN tracking_entidad_categorias p_cat ON p_cat.entidad_id = tp.proveedor_id AND p_cat.entidad_tipo = 'PROVEEDOR' AND p_cat.activo = 1
    WHERE tp.activo = 1
    GROUP BY tp.id 
    
    UNION ALL
    
    SELECT 
        tn.id,
        tn.trabajador_id as entidad_id,
        tr.nombre_completo as nombre,
        CONCAT('NOM-', tn.periodo_anio, '-Q', tn.periodo_quincena) as factura,
        tn.fecha_pago as emision,
        tn.fecha_pago as pagoEstimado,
        CASE WHEN tn.fecha_pago <= CURDATE() THEN 'pagado' ELSE 'pendiente' END as status,
        tn.fecha_pago as fechaPago,
        tn.monto_total,
        'RH' as super_categoria,
        'NOMINA' as categoria,
        'GENERAL' as sub_categoria,
        'NOMINA' as origen_tipo
    FROM tracking_nomina tn
    LEFT JOIN tracking_trabajadores tr ON tn.trabajador_id = tr.id
    WHERE tn.activo = 1
    
    ORDER BY pagoEstimado ASC;
END;

-- 18. REGISTRAR PAGO (ACCION)
DROP PROCEDURE IF EXISTS sp_tracking_pago_pagar;

CREATE PROCEDURE sp_tracking_pago_pagar(IN _id INT, IN _fecha DATE, IN _origen VARCHAR(20))
BEGIN
    IF _origen = 'PROVEEDOR' THEN
        UPDATE tracking_pagos 
        SET estado = 'pagado', fecha_pago = _fecha 
        WHERE id = _id;
    END IF;
    -- Nomina logic skipped for now as table structure is simple
    SELECT _id as id;
END;
-- UPDATE sp_tracking_pago_pagar to include NOMINA logic
DROP PROCEDURE IF EXISTS sp_tracking_pago_pagar;
DELIMITER //
CREATE PROCEDURE sp_tracking_pago_pagar(IN _id INT, IN _fecha DATE, IN _origen VARCHAR(20))
BEGIN
    IF _origen = 'PROVEEDOR' THEN
        UPDATE tracking_pagos 
        SET estado = 'pagado', fecha_pago = _fecha 
        WHERE id = _id;
    ELSEIF _origen = 'NOMINA' THEN
        UPDATE tracking_nomina
        SET fecha_pago = _fecha 
        WHERE id = _id;
    END IF;
    SELECT _id as id;
END //
DELIMITER ;

-- Procedimiento para eliminar facturas (soft delete)
DROP PROCEDURE IF EXISTS sp_tracking_pago_eliminar;

DELIMITER / /

CREATE PROCEDURE sp_tracking_pago_eliminar(IN _id INT, IN _origen VARCHAR(20))
BEGIN
    IF _origen = 'PROVEEDOR' THEN
        UPDATE tracking_pagos 
        SET activo = 0 
        WHERE id = _id;
    ELSEIF _origen = 'NOMINA' THEN
        UPDATE tracking_nomina
        SET activo = 0 
        WHERE id = _id;
    END IF;
    SELECT _id as id;
END //

DELIMITER;