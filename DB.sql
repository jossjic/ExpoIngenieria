-- Creacion de Tablas--
CREATE TABLE `EDICION` (
  `ed_id` INT NOT NULL AUTO_INCREMENT,
  `ed_nombre` VARCHAR(100),
  `ed_fecha_inicio` DATETIME,
  `ed_fecha_fin` DATETIME,
  PRIMARY KEY (`ed_id`)
);

CREATE TABLE `CATEGORIA` (
  `ca_id` INT  NOT NULL AUTO_INCREMENT,
  `ca_nombre` VARCHAR(100),
  PRIMARY KEY (`ca_id`)
);

CREATE TABLE `NIVEL` (
  `n_id` INT  NOT NULL AUTO_INCREMENT,
  `n_nombre` VARCHAR(100),
  PRIMARY KEY (`n_id`)
);

CREATE TABLE `PROYECTO` (
  `p_id` INT NOT NULL AUTO_INCREMENT,
  `p_nombre_clave` VARCHAR(100) UNIQUE,
  `p_nombre` VARCHAR(100),
  `p_descripcion` TEXT,
  `n_id` INT,
  `p_estado` VARCHAR(100),
  `p_pass` VARCHAR(100),
  `p_video` VARCHAR(100),
  `p_poster` VARCHAR(100),
  `p_ult_modif` DATETIME,
  `ca_id` INT,
  `ed_id` INT,
  PRIMARY KEY (`p_id`),
  FOREIGN KEY (`ed_id`) REFERENCES `EDICION`(`ed_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`ca_id`) REFERENCES `CATEGORIA`(`ca_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`n_id`) REFERENCES `NIVEL`(`n_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE

);

CREATE TABLE `COLABORADOR` (
  `co_correo` VARCHAR(100) NOT NULL,
  `co_nomina` VARCHAR(9),
  `co_nombre` VARCHAR(100),
  `co_apellido` VARCHAR(100),
  `co_pass` VARCHAR(100),
  `co_es_jurado` BOOLEAN,
  PRIMARY KEY (`co_correo`)
);

CREATE TABLE `PROYECTO_COLABORADOR` (
  `p_id` INT,
  `co_correo` VARCHAR(100),
  FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR`(`co_correo`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`p_id`) REFERENCES `PROYECTO`(`p_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE ADMIN (
  `adm_correo` VARCHAR(100) NOT NULL,
  `adm_nombre` VARCHAR(100),
  `adm_apellido` VARCHAR(100),
  `adm_pass` VARCHAR(100),
  `adm_master` BOOLEAN,
  PRIMARY KEY (`adm_correo`)
);

CREATE TABLE `ANUNCIO` (
  `an_id` INT NOT NULL AUTO_INCREMENT,
  `an_titulo` VARCHAR(100),
  `an_contenido` TEXT,
  `an_grupo` INT,
  `an_fecha` DATETIME,
  `adm_correo` VARCHAR(100),
  PRIMARY KEY (`an_id`),
  FOREIGN KEY (`adm_correo`) REFERENCES ADMIN(`adm_correo`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE `EVALUACION` (
  `co_correo` VARCHAR(100),
  `p_id` INT,
  `ev_criterio_1` INT,
  `ev_criterio_2` INT,
  `ev_criterio_3` INT,
  `ev_criterio_4` INT,
  `ev_criterio_5` INT,
  `ev_retro` TEXT,
  `ev_cancelada` BOOLEAN,
  FOREIGN KEY (`p_id`) REFERENCES `PROYECTO`(`p_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR`(`co_correo`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE ALUMNO (
  `a_matricula` VARCHAR(9) NOT NULL,
  `a_nombre` VARCHAR(100),
  `a_apellido` VARCHAR(100),
  `a_correo` VARCHAR(100),
  PRIMARY KEY (`a_matricula`)
);

CREATE TABLE `ETAPA` (
  `et_id` INT NOT NULL AUTO_INCREMENT,
  `et_nombre` VARCHAR(100),
  `et_fecha_inicio` DATETIME,
  `et_fecha_fin` DATETIME,
  `ed_id` INT,
  PRIMARY KEY (`et_id`),
  FOREIGN KEY (`ed_id`) REFERENCES `EDICION`(`ed_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE `EDICION_COLABORADOR` (
  `ed_id` INT,
  `co_correo` VARCHAR(100),
  FOREIGN KEY (`ed_id`) REFERENCES `EDICION`(`ed_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR`(`co_correo`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE `PROYECTO_ALUMNO` (
  `a_matricula` VARCHAR(9),
  `p_id` INT,
  FOREIGN KEY (`a_matricula`) REFERENCES ALUMNO(`a_matricula`)
	ON DELETE CASCADE
ON UPDATE CASCADE,
  FOREIGN KEY (`p_id`) REFERENCES `PROYECTO`(`p_id`)
	ON DELETE CASCADE
ON UPDATE CASCADE
);

-- Creacion de Tablas--

-- Inserción de Datos--



INSERT INTO ADMIN(`adm_correo`, `adm_nombre`, `adm_apellido`, `adm_pass`, `adm_master`) VALUES ('rafaadm@tec.mx','José Rafael','Aguilar Mejía','eladminmaster1234',1);
INSERT INTO ADMIN(`adm_correo`, `adm_nombre`, `adm_apellido`, `adm_pass`, `adm_master`) VALUES ('a01736671@tec.mx','José JuanADM','Irene Ceravntes','jossprueba1234',true);
INSERT INTO ADMIN(`adm_correo`, `adm_nombre`, `adm_apellido`, `adm_pass`, `adm_master`) VALUES ('adm@expo.mx','Admin','H3BFQEWWREF','1234',true);

INSERT INTO ALUMNO(`a_matricula`, `a_nombre`, `a_apellido`, `a_correo`) VALUES ('A01736671','José JuanAL','Irene Cervantes','jossjic_03@hotmail.com');
INSERT INTO ALUMNO(`a_matricula`, `a_nombre`, `a_apellido`, `a_correo`) VALUES ('A29131433','Rigoberto','Arngo Graza','rigogod@opera.com');
INSERT INTO ALUMNO (a_matricula, a_nombre, a_apellido, a_correo) VALUES ('A00123456', 'Juan', 'Pérez', 'juan.perez@example.com');
INSERT INTO ALUMNO (a_matricula, a_nombre, a_apellido, a_correo) VALUES ('A00987654', 'María', 'González', 'maria.gonzalez@example.com');
INSERT INTO ALUMNO (a_matricula, a_nombre, a_apellido, a_correo) VALUES ('A00543210', 'Pedro', 'Sánchez', 'pedro.sanchez@example.com');
INSERT INTO ALUMNO (a_matricula, a_nombre, a_apellido, a_correo) VALUES ('A00345678', 'Ana', 'Rodríguez', 'ana.rodriguez@example.com');
INSERT INTO ALUMNO (a_matricula, a_nombre, a_apellido, a_correo) VALUES ('A00234567', 'Luis', 'Martínez', 'luis.martinez@example.com');

INSERT INTO EDICION (ed_nombre, ed_fecha_inicio, ed_fecha_fin) VALUES ('Edición de Verano', '2023-06-01 00:00:00', '2023-08-31 23:59:59');
INSERT INTO EDICION (ed_nombre, ed_fecha_inicio, ed_fecha_fin) VALUES ('Edición de Otoño', '2023-09-01 00:00:00', '2023-11-30 23:59:59');
INSERT INTO EDICION (ed_nombre, ed_fecha_inicio, ed_fecha_fin) VALUES ('Edición de Primavera', '2024-02-01 00:00:00', '2024-04-30 23:59:59');
INSERT INTO EDICION (ed_nombre, ed_fecha_inicio, ed_fecha_fin) VALUES ('Edición de Invierno', '2023-12-01 00:00:00', '2024-01-31 23:59:59');
INSERT INTO EDICION (ed_nombre, ed_fecha_inicio, ed_fecha_fin) VALUES ('Edición de Vacaciones', '2023-12-20 00:00:00', '2024-01-05 23:59:59');

INSERT INTO CATEGORIA (ca_nombre) VALUES ('Facultad de Ciencias');
INSERT INTO CATEGORIA (ca_nombre) VALUES ('Facultad de Humanidades');
INSERT INTO CATEGORIA (ca_nombre) VALUES ('Facultad de Ingeniería');
INSERT INTO CATEGORIA (ca_nombre) VALUES ('Facultad de Economía');
INSERT INTO CATEGORIA (ca_nombre) VALUES ('Facultad de Artes y Diseño');

INSERT INTO NIVEL (n_nombre) VALUES ('Concepto (Nivel TRL o SRL 1-3)');
INSERT INTO NIVEL (n_nombre) VALUES ('Prototipo baja resolución o pruebas controladas (Nivel TRL o SRL 4-6)');
INSERT INTO NIVEL (n_nombre) VALUES ('Producto terminado (Nivel TRL o SRL 7-9)');

INSERT INTO COLABORADOR (co_correo, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES ('juan@example.com', 'Juan', 'Pérez', 'secreto123', false);
INSERT INTO COLABORADOR (co_correo, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES ('ana@example.com', 'Ana', 'González', 'password123', true);
INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES ('carlos@example.com', '000000003', 'Carlos', 'Martínez', '123456', false);
INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES ('luisa@example.com', '000000004', 'Luisa', 'Fernández', 'clave123', true);
INSERT INTO COLABORADOR (co_correo, co_nomina, co_nombre, co_apellido, co_pass, co_es_jurado) VALUES ('jose@example.com', '000000005', 'José', 'Sánchez', 'password', false);

INSERT INTO ANUNCIO (an_titulo, an_contenido, an_grupo, an_fecha, adm_correo) VALUES ('Próxima reunión de proyecto', 'La reunión de proyecto se llevará a cabo el próximo lunes a las 10:00am en la sala de juntas.', 1, '2023-05-01 10:00:00', 'rafaadm@tec.mx');
INSERT INTO ANUNCIO (an_titulo, an_contenido, an_grupo, an_fecha, adm_correo) VALUES ('Cambio de horario de clases', 'A partir de la próxima semana, las clases de los miércoles se llevarán a cabo de 2:00pm a 4:00pm.', 2, '2023-05-02 14:00:00', 'rafaadm@tec.mx');
INSERT INTO ANUNCIO (an_titulo, an_contenido, an_grupo, an_fecha, adm_correo) VALUES ('Convocatoria para voluntarios', 'Se solicitan voluntarios para apoyar en el evento de caridad que se llevará a cabo en dos semanas. Interesados favor de contactar al coordinador del evento.', 3, '2023-05-05 12:00:00', 'a01736671@tec.mx');
INSERT INTO ANUNCIO (an_titulo, an_contenido, an_grupo, an_fecha, adm_correo) VALUES ('Suspensión de actividades', 'Se informa que debido a la contingencia climática, las actividades académicas y administrativas se suspenderán el día de mañana.', 4, '2023-05-06 00:00:00', 'a01736671@tec.mx');
INSERT INTO ANUNCIO (an_titulo, an_contenido, an_grupo, an_fecha, adm_correo) VALUES ('Feliz día del trabajo', 'El equipo de administración les desea un feliz día del trabajo a todos los colaboradores de la universidad.', 1, '2023-05-01 09:00:00', 'adm@expo.mx');

INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 1', '2023-05-01 00:00:00', '2023-05-31 23:59:59', 1);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 2', '2023-06-01 00:00:00', '2023-06-30 23:59:59', 1);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 3', '2023-07-01 00:00:00', '2023-07-31 23:59:59', 1);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 4', '2023-08-01 00:00:00', '2023-08-31 23:59:59', 1);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 5', '2023-09-01 00:00:00', '2023-09-30 23:59:59', 1);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 1', '2023-05-01 00:00:00', '2023-05-31 23:59:59', 2);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 2', '2023-06-01 00:00:00', '2023-06-30 23:59:59', 2);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 3', '2023-07-01 00:00:00', '2023-07-31 23:59:59', 2);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 4', '2023-08-01 00:00:00', '2023-08-31 23:59:59', 2);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 5', '2023-09-01 00:00:00', '2023-09-30 23:59:59', 3);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 1', '2023-05-01 00:00:00', '2023-05-31 23:59:59', 3);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 2', '2023-06-01 00:00:00', '2023-06-30 23:59:59', 3);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 3', '2023-07-01 00:00:00', '2023-07-31 23:59:59', 3);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 4', '2023-08-01 00:00:00', '2023-08-31 23:59:59', 3);
INSERT INTO `ETAPA` (`et_nombre`, `et_fecha_inicio`, `et_fecha_fin`, `ed_id`) VALUES ('Etapa 5', '2023-09-01 00:00:00', '2023-09-30 23:59:59', 3);

INSERT INTO PROYECTO (p_nombre_clave, p_nombre, p_descripcion, n_id, p_estado, p_pass, p_video, p_poster, p_ult_modif, ca_id, ed_id) VALUES ('proyecto1', 'Proyecto 1', 'Descripción del proyecto 1', 2, 'En progreso', '123456', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'https://www.example.com/proyecto1.jpg', NOW(), 3, 1);
INSERT INTO PROYECTO (p_nombre_clave, p_nombre, p_descripcion, n_id, p_estado, p_pass, p_video, p_poster, p_ult_modif, ca_id, ed_id) VALUES ('proyecto2', 'Proyecto 2', 'Descripción del proyecto 2', 1, 'Finalizado', 'abcdef', 'https://www.youtube.com/watch?v=3tmd-ClpJxA', 'https://www.example.com/proyecto2.jpg', NOW(), 2, 1);
INSERT INTO PROYECTO (p_nombre_clave, p_nombre, p_descripcion, n_id, p_estado, p_pass, p_video, p_poster, p_ult_modif, ca_id, ed_id) VALUES ('proyecto3', 'Proyecto 3', 'Descripción del proyecto 3', 2, 'En progreso', 'qwerty', 'https://www.youtube.com/watch?v=9g3--WYH8SY', 'https://www.example.com/proyecto3.jpg', NOW(), 1, 2);
INSERT INTO PROYECTO (p_nombre_clave, p_nombre, p_descripcion, n_id, p_estado, p_pass, p_video, p_poster, p_ult_modif, ca_id, ed_id) VALUES ('proyecto4', 'Proyecto 4', 'Descripción del proyecto 4', 3, 'En revisión', 'mypass', 'https://www.youtube.com/watch?v=y6120QOlsfU', 'https://www.example.com/proyecto4.jpg', NOW(), 2, 2);
INSERT INTO PROYECTO (p_nombre_clave, p_nombre, p_descripcion, n_id, p_estado, p_pass, p_video, p_poster, p_ult_modif, ca_id, ed_id) VALUES ('proyecto5', 'Proyecto 5', 'Descripción del proyecto 5', 1, 'En progreso', 'password123', 'https://www.youtube.com/watch?v=mWRsgZuwf_8', 'https://www.example.com/proyecto5.jpg', NOW(), 3, 2);

INSERT INTO `EVALUACION` (`co_correo`, `p_id`, `ev_criterio_1`, `ev_criterio_2`, `ev_criterio_3`, `ev_criterio_4`, `ev_criterio_5`, `ev_retro`, `ev_cancelada`) VALUES
('ana@example.com', 1, 3, 2, 4, 1, 3, 'Buen trabajo en general, pero es necesario mejorar en el criterio 2', 0),
('ana@example.com', 2, 4, 4, 4, 4, 4, 'Excelente trabajo en todos los criterios', 0),
('luisa@example.com', 3, 2, 3, 3, 3, 1, 'Necesita mejorar en los criterios 1 y 5', 0),
('luisa@example.com', 4, 1, 1, 2, 2, 2, 'Requiere mejoras importantes en todos los criterios', 1),
('luisa@example.com', 5, 4, 3, 4, 3, 4, 'Excelente trabajo en general, pero es necesario mejorar en el criterio 2', 0);

INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A29131433', 1);
INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A00234567', 1);
INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A00345678', 2);
INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A00234567', 3);
INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A29131433', 4);
INSERT INTO PROYECTO_ALUMNO (a_matricula, p_id) VALUES ('A00234567', 5);

INSERT INTO `PROYECTO_COLABORADOR` (`p_id`, `co_correo`)
VALUES 
(1, 'carlos@example.com'),
(2, 'juan@example.com'),
(3, 'carlos@example.com'),
(4, 'juan@example.com'),
(5, 'juan@example.com');

INSERT INTO EDICION_COLABORADOR (ed_id, co_correo) VALUES (1, 'juan@example.com');
INSERT INTO EDICION_COLABORADOR (ed_id, co_correo) VALUES (1, 'ana@example.com');
INSERT INTO EDICION_COLABORADOR (ed_id, co_correo) VALUES (2, 'carlos@example.com');
INSERT INTO EDICION_COLABORADOR (ed_id, co_correo) VALUES (2, 'luisa@example.com');
INSERT INTO EDICION_COLABORADOR (ed_id, co_correo) VALUES (3, 'jose@example.com');


-- Inserción de Datos--