CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_listado`(IN _activo TINYINT)
BEGIN
    SELECT * FROM tracking_trabajadores WHERE activo = IFNULL(_activo, 1) ORDER BY nombre_completo;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_config_obtener`()
BEGIN
    SELECT json_data FROM tracking_config ORDER BY id DESC LIMIT 1;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_cortes_por_caja_anio`(
    IN p_caja_id INT,
    IN p_anio INT
)
BEGIN
    SELECT
        ID_CORTE,
        CAJAS_ID,
        FECHA_INICIO,
        FECHA_FINAL,
        LPAD(FOLIO,4,'0') AS folio
    FROM corte_caja
    WHERE CAJAS_ID = p_caja_id
      AND ACTIVO = 1
      AND YEAR(FECHA_FINAL) = p_anio
    ORDER BY FECHA_FINAL;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_entidad_categoria_agregar`(
    IN _type VARCHAR(50), IN _id INT, IN _super VARCHAR(50), IN _cat VARCHAR(50), IN _sub VARCHAR(50)
)
BEGIN
    INSERT INTO tracking_entidad_categorias (entidad_tipo, entidad_id, super_category_id, category_id, subcategory_id)
    VALUES (_type, _id, _super, _cat, _sub);
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_entidad_categorias_limpiar`(
    IN _entidad_tipo VARCHAR(50),
    IN _entidad_id INT
)
BEGIN
    DELETE FROM tracking_entidad_categorias 
    WHERE entidad_tipo = _entidad_tipo AND entidad_id = _entidad_id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_estado_general_caja_toma_muestra`(
    IN p_anio INT
)
BEGIN
    SELECT
        YEAR(cc.FECHA_FINAL) AS anio,
        MONTH(cc.FECHA_FINAL) AS mes,

        c.ID_CLIENTE,
        c.NOMBRE_COMERCIAL AS cliente,

        CASE
            WHEN t.ID_TICKET IS NULL 
                 AND c.ID_CLIENTE <> 1
                THEN 'CRÉDITO'
            WHEN fp.DESCRIPCION = 'CORTESIA'
                THEN NULL
            ELSE 'CONTADO'
        END AS tipo_ingreso,

        ROUND(
            SUM(
                CASE
                    WHEN t.ID_TICKET IS NULL 
                         AND c.ID_CLIENTE <> 1
                        THEN ct.TOTAL
                    ELSE IFNULL(fpt.MONTO, t.TOTAL)
                END
            ),
            2
        ) AS total_ingresos

    FROM detalle_corte dc
    INNER JOIN corte_caja cc ON cc.ID_CORTE = dc.CORTE_ID
    INNER JOIN cajas caja ON caja.ID_CAJAS = cc.CAJAS_ID AND caja.ACTIVO = 1
    INNER JOIN turnos tur ON tur.ID_TURNO = dc.TURNO_ID
    INNER JOIN clientes c ON c.ID_CLIENTE = tur.CLIENTE_ID

    LEFT JOIN tickets t ON t.TURNO_ID = tur.ID_TURNO AND t.ACTIVO = 1
    LEFT JOIN forma_pago_ticket fpt ON fpt.TICKET_ID = t.ID_TICKET
    LEFT JOIN formas_pago fp ON fp.ID_PAGO = fpt.PAGO_ID
    LEFT JOIN cargos_turno ct ON ct.TURNO_ID = dc.TURNO_ID AND ct.ACTIVO = 1

    WHERE dc.ACTIVO = 1
      AND caja.DESCRIPCION = 'CAJA TOMA DE MUESTRA'
      AND YEAR(cc.FECHA_FINAL) = p_anio

    GROUP BY
        anio,
        mes,
        c.ID_CLIENTE,
        tipo_ingreso

    ORDER BY
        anio,
        mes,
        tipo_ingreso,
        cliente;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_nomina_crear`(
    IN _worker_id INT, IN _anio INT, IN _quin INT,
    IN _dias INT, IN _bono DECIMAL(10,2), IN _imss DECIMAL(10,2),
    IN _monto DECIMAL(10,2), IN _fecha DATE
)
BEGIN
    INSERT INTO tracking_nomina (trabajador_id, periodo_anio, periodo_quincena, dias_trabajados, bono, imss, monto_total, fecha_pago)
    VALUES (_worker_id, _anio, _quin, _dias, _bono, _imss, _monto, _fecha);
    SELECT LAST_INSERT_ID() as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_pago_eliminar`(IN _id INT, IN _origen VARCHAR(20))
BEGIN
    IF _origen = 'PROVEEDOR' THEN
        UPDATE tracking_pagos SET activo = 0 WHERE id = _id;
    ELSEIF _origen = 'NOMINA' THEN
        UPDATE tracking_nomina SET activo = 0 WHERE id = _id;
    END IF;
    SELECT _id as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_pago_pagar`(IN _id INT, IN _fecha DATE, IN _origen VARCHAR(20))
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
END
---------------------------------------------------------------------------------------------------------------------------
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
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_profesionales_listado`(IN _p INT, IN _l INT)
BEGIN
    SELECT p.*,
    (SELECT COUNT(*) FROM tracking_entidad_categorias tec 
     WHERE tec.entidad_id = p.id AND tec.entidad_tipo = 'PROFESIONAL' AND tec.activo = 1) as etiquetas_count
    FROM tracking_profesionales p WHERE p.activo = 1 ORDER BY p.nombre_completo;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_actualizar`(
    IN _id INT,
    IN _nombre_comercial VARCHAR(255),
    IN _razon VARCHAR(255), 
    IN _contacto VARCHAR(255), 
    IN _tel VARCHAR(20), 
    IN _mail VARCHAR(100),
    IN _rfc VARCHAR(15), 
    IN _banco VARCHAR(50), 
    IN _clabe VARCHAR(20), 
    IN _cred TINYINT, 
    IN _dias INT,
    IN _unidad INT
)
BEGIN
    UPDATE tracking_proveedores SET 
        nombre_comercial = _nombre_comercial,
        razon_social = _razon,
        nombre_contacto = _contacto,
        telefono = _tel,
        correo = _mail,
        rfc = _rfc,
        banco = _banco,
        cuenta_clabe = _clabe,
        tiene_credito = _cred,
        dias_credito = _dias,
        unidad_negocio_id = _unidad
    WHERE id = _id;
    SELECT _id as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_crear`(
    IN _nombre_comercial VARCHAR(255),
    IN _razon VARCHAR(255), 
    IN _contacto VARCHAR(255), 
    IN _tel VARCHAR(20), 
    IN _mail VARCHAR(100),
    IN _rfc VARCHAR(15), 
    IN _banco VARCHAR(50), 
    IN _clabe VARCHAR(20), 
    IN _cred TINYINT, 
    IN _dias INT, 
    IN _unidad INT
)
BEGIN
    INSERT INTO tracking_proveedores (
        nombre_comercial, razon_social, nombre_contacto, telefono, correo, rfc, banco, cuenta_clabe, tiene_credito, dias_credito, unidad_negocio_id
    )
    VALUES (
        _nombre_comercial, _razon, _contacto, _tel, _mail, _rfc, _banco, _clabe, _cred, _dias, _unidad
    );
    SELECT LAST_INSERT_ID() as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_eliminar`(IN _id INT)
BEGIN
    UPDATE tracking_proveedores SET activo = 0 WHERE id = _id;
    SELECT _id as id;
END
---------------------------------------------------------------------------------------------------------------------------
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
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_proveedores_obtener`(IN _id INT)
BEGIN
    SELECT 
        p.*,
        (SELECT JSON_ARRAYAGG(JSON_OBJECT(
            'superId', tec.super_category_id,
            'catId', tec.category_id,
            'subId', tec.subcategory_id
        ))
         FROM tracking_entidad_categorias tec 
         WHERE tec.entidad_id = p.id AND tec.entidad_tipo = 'PROVEEDOR' AND tec.activo = 1
        ) as categorias_json
    FROM tracking_proveedores p
    WHERE p.id = _id AND p.activo = 1;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_atributos`()
BEGIN
    SELECT * 
    FROM tracking_entidad_categorias 
    WHERE entidad_tipo = 'TRABAJADOR' AND activo = 1;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_crear`(
    IN _nombre VARCHAR(255), IN _puesto VARCHAR(100), IN _salario DECIMAL(10,2), IN _inicio DATE,
    IN _curp VARCHAR(20), IN _rfc VARCHAR(15), IN _nss VARCHAR(20), IN _tel VARCHAR(20),
    IN _mail VARCHAR(100), IN _banco VARCHAR(50), IN _clabe VARCHAR(20)
)
BEGIN
    INSERT INTO tracking_trabajadores (nombre_completo, puesto, salario_diario, fecha_inicio, curp, rfc, nss, telefono, correo, banco, cuenta_clabe)
    VALUES (_nombre, _puesto, _salario, _inicio, _curp, _rfc, _nss, _tel, _mail, _banco, _clabe);
    SELECT LAST_INSERT_ID() as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_eliminar`(IN _id INT)
BEGIN
    UPDATE tracking_trabajadores SET activo = 0 WHERE id = _id;
    SELECT _id as id;
END
---------------------------------------------------------------------------------------------------------------------------
CREATE DEFINER=`u808450138_bimo`@`%` PROCEDURE `sp_tracking_trabajadores_listado`(IN _activo TINYINT)
BEGIN
    SELECT * FROM tracking_trabajadores WHERE activo = IFNULL(_activo, 1) ORDER BY nombre_completo;
END
---------------------------------------------------------------------------------------------------------------------------
TABLAS
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `json_data` longtext DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_documentos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tipo_entidad` enum(
        'proveedor',
        'trabajador',
        'profesional'
    ) NOT NULL,
    `entidad_id` int(11) NOT NULL,
    `tipo_documento` varchar(50) NOT NULL,
    `ruta_archivo` text NOT NULL,
    `nombre_original` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_entidad_categorias` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `entidad_tipo` varchar(100) NOT NULL,
    `entidad_id` int(11) NOT NULL,
    `super_category_id` varchar(50) DEFAULT NULL,
    `category_id` varchar(50) DEFAULT NULL,
    `subcategory_id` varchar(50) DEFAULT NULL,
    `activo` tinyint(1) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `idx_entidad` (`entidad_tipo`, `entidad_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_nomina` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `trabajador_id` int(11) NOT NULL,
    `periodo_anio` int(11) DEFAULT NULL,
    `periodo_quincena` int(11) DEFAULT NULL,
    `dias_trabajados` int(11) DEFAULT NULL,
    `bono` decimal(10, 2) DEFAULT NULL,
    `imss` decimal(10, 2) DEFAULT NULL,
    `monto_total` decimal(10, 2) DEFAULT NULL,
    `fecha_pago` date DEFAULT NULL,
    `activo` tinyint(4) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_pagos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `proveedor_id` int(11) DEFAULT NULL,
    `folio_fiscal` varchar(50) DEFAULT NULL,
    `fecha_emision` date DEFAULT NULL,
    `fecha_limite_pago` date DEFAULT NULL,
    `monto_total` decimal(10, 2) DEFAULT NULL,
    `archivo_ruta` varchar(255) DEFAULT NULL,
    `estado` enum(
        'pendiente',
        'pagado',
        'vencido'
    ) DEFAULT 'pendiente',
    `fecha_pago` date DEFAULT NULL,
    `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
    `activo` tinyint(4) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_profesionales` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre_completo` varchar(255) DEFAULT NULL,
    `especialidad` varchar(100) DEFAULT NULL,
    `modalidad_fiscal` varchar(50) DEFAULT NULL,
    `monto_honorarios` decimal(10, 2) DEFAULT NULL,
    `fecha_inicio` date DEFAULT NULL,
    `fecha_terminacion` date DEFAULT NULL,
    `domicilio` text DEFAULT NULL,
    `telefono` varchar(20) DEFAULT NULL,
    `correo` varchar(100) DEFAULT NULL,
    `observaciones` text DEFAULT NULL,
    `banco` varchar(50) DEFAULT NULL,
    `cuenta_clabe` varchar(20) DEFAULT NULL,
    `unidad_negocio_id` int(11) DEFAULT NULL,
    `activo` tinyint(4) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_proveedores` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `razon_social` varchar(255) DEFAULT NULL,
    `nombre_comercial` varchar(255) DEFAULT NULL,
    `nombre_contacto` varchar(255) DEFAULT NULL,
    `telefono` varchar(20) DEFAULT NULL,
    `correo` varchar(100) DEFAULT NULL,
    `rfc` varchar(15) DEFAULT NULL,
    `banco` varchar(50) DEFAULT NULL,
    `cuenta_clabe` varchar(20) DEFAULT NULL,
    `tiene_credito` tinyint(4) DEFAULT 0,
    `dias_credito` int(11) DEFAULT 0,
    `activo` tinyint(4) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `tracking_trabajadores` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre_completo` varchar(150) NOT NULL,
    `puesto` varchar(100) DEFAULT NULL,
    `salario_diario` decimal(10, 2) NOT NULL DEFAULT 0.00,
    `curp` varchar(20) DEFAULT NULL,
    `rfc` varchar(20) DEFAULT NULL,
    `nss` varchar(20) DEFAULT NULL,
    `fecha_inicio` date NOT NULL,
    `fecha_terminacion` date DEFAULT NULL,
    `telefono` varchar(50) DEFAULT NULL,
    `correo` varchar(150) DEFAULT NULL,
    `domicilio` text DEFAULT NULL,
    `banco` varchar(100) DEFAULT NULL,
    `cuenta_clabe` varchar(30) DEFAULT NULL,
    `activo` tinyint(1) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci
---------------------------------------------------------------------------------------------------------------------------
NUEVAS VERSIONADAS POR FECHA Y HORA (
    SOLO PARA ANEXAR NUEVAS COSAS.NUNCA MODIFICAR NADA DE LO QUE HAY ANTES NI DESPUES NUEVOS SP O MEJORAS DEL MISMO QUEDAN AQUI COMO "MIGRACIÓNES"
)
---------------------------------------------------------------------------------------------------------------------------

/* 2026-01-27 19:15:00 - FIXES AND ADDITIONS FOR TRACKING PAYMENTS */

/* Missing Table: tracking_gastos */
CREATE TABLE IF NOT EXISTS `tracking_gastos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `super_category_id` varchar(50) DEFAULT NULL,
    `category_id` varchar(50) DEFAULT NULL,
    `subcategory_id` varchar(50) DEFAULT NULL,
    `concepto` text DEFAULT NULL,
    `monto` decimal(10, 2) DEFAULT NULL,
    `fecha_emision` date DEFAULT NULL,
    `archivo_ruta` varchar(255) DEFAULT NULL,
    `activo` tinyint(4) DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_tracking_profesionales_crear`;

CREATE PROCEDURE `sp_tracking_profesionales_crear`(
    IN _nombre_completo VARCHAR(255),
    IN _especialidad VARCHAR(100),
    IN _modalidad_fiscal VARCHAR(50),
    IN _monto_honorarios DECIMAL(10,2),
    IN _fecha_inicio DATE,
    IN _fecha_terminacion DATE,
    IN _domicilio TEXT,
    IN _telefono VARCHAR(20),
    IN _correo VARCHAR(100),
    IN _observaciones TEXT,
    IN _banco VARCHAR(50),
    IN _cuenta_clabe VARCHAR(20),
    IN _unidad_negocio_id INT
)
BEGIN
    INSERT INTO tracking_profesionales (
        nombre_completo, especialidad, modalidad_fiscal, monto_honorarios, fecha_inicio, fecha_terminacion,
        domicilio, telefono, correo, observaciones, banco, cuenta_clabe, unidad_negocio_id
    ) VALUES (
        _nombre_completo, _especialidad, _modalidad_fiscal, _monto_honorarios, _fecha_inicio, _fecha_terminacion,
        _domicilio, _telefono, _correo, _observaciones, _banco, _cuenta_clabe, _unidad_negocio_id
    );
    SELECT LAST_INSERT_ID() as id;
END;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_tracking_config_guardar`;

CREATE PROCEDURE `sp_tracking_config_guardar`(
    IN _json_data LONGTEXT
)
BEGIN
    INSERT INTO tracking_config (json_data) VALUES (_json_data);
END;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_tracking_gasto_crear`;

CREATE PROCEDURE `sp_tracking_gasto_crear`(
    IN _super_category_id VARCHAR(50),
    IN _category_id VARCHAR(50),
    IN _subcategory_id VARCHAR(50),
    IN _concepto TEXT,
    IN _monto DECIMAL(10,2),
    IN _fecha_emision DATE,
    IN _archivo_ruta VARCHAR(255)
)
BEGIN
    INSERT INTO tracking_gastos (
        super_category_id, category_id, subcategory_id, concepto, monto, fecha_emision, archivo_ruta
    ) VALUES (
        _super_category_id, _category_id, _subcategory_id, _concepto, _monto, _fecha_emision, _archivo_ruta
    );
    SELECT LAST_INSERT_ID() as id;
END;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_tracking_pagos_listado_v2`;

CREATE PROCEDURE `sp_tracking_pagos_listado_v2`(IN _activo TINYINT)
BEGIN
    SELECT 
        pg.*,
        pr.nombre_comercial as proveedor,
        pr.rfc as proveedor_rfc
    FROM tracking_pagos pg
    LEFT JOIN tracking_proveedores pr ON pg.proveedor_id = pr.id
    WHERE pg.activo = IFNULL(_activo, 1)
    ORDER BY pg.fecha_emision DESC;
END;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_tracking_pago_eliminar_v2`;

CREATE PROCEDURE `sp_tracking_pago_eliminar_v2`(IN _id INT, IN _origen VARCHAR(20))
BEGIN
    IF _origen = 'PROVEEDOR' THEN
        UPDATE tracking_pagos SET activo = 0 WHERE id = _id;
    ELSEIF _origen = 'NOMINA' THEN
        UPDATE tracking_nomina SET activo = 0 WHERE id = _id;
    ELSEIF _origen = 'GASTO' THEN
        UPDATE tracking_gastos SET activo = 0 WHERE id = _id;
    END IF;
    SELECT _id as id;
END;
---------------------------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_recuperar_info_hostorial_caja`;

CREATE PROCEDURE `sp_recuperar_info_hostorial_caja`(IN _corte_id INT)
BEGIN
    SELECT 
        cc.FECHA_FINAL,
        c.ID_CLIENTE AS CLIENTE_ID,
        c.NOMBRE_COMERCIAL,
        CASE
            WHEN t.ID_TICKET IS NULL AND c.ID_CLIENTE <> 1 THEN 'CRÉDITO'
            WHEN fp.DESCRIPCION = 'CORTESIA' THEN 'CORTESÍA'
            ELSE 'CONTADO'
        END AS FORMA_PAGO,
        IFNULL(fpt.MONTO, IFNULL(t.TOTAL, ct.TOTAL)) AS TOTAL
    FROM detalle_corte dc
    INNER JOIN corte_caja cc ON cc.ID_CORTE = dc.CORTE_ID
    INNER JOIN turnos tur ON tur.ID_TURNO = dc.TURNO_ID
    INNER JOIN clientes c ON c.ID_CLIENTE = tur.CLIENTE_ID
    LEFT JOIN tickets t ON t.TURNO_ID = tur.ID_TURNO AND t.ACTIVO = 1
    LEFT JOIN forma_pago_ticket fpt ON fpt.TICKET_ID = t.ID_TICKET
    LEFT JOIN formas_pago fp ON fp.ID_PAGO = fpt.PAGO_ID
    LEFT JOIN cargos_turno ct ON ct.TURNO_ID = dc.TURNO_ID AND ct.ACTIVO = 1
    WHERE dc.CORTE_ID = _corte_id AND dc.ACTIVO = 1;
END;

/* 2026-01-27 19:25:00 - FIX MISSING COLUMN IN PROVIDERS */
ALTER TABLE `tracking_proveedores`
ADD COLUMN `unidad_negocio_id` INT DEFAULT NULL AFTER `dias_credito`;
---------------------------------------------------------------------------------------------------------------------------