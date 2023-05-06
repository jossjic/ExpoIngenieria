-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: TC2005B_401_5
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ADMIN`
--

DROP TABLE IF EXISTS `ADMIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ADMIN` (
  `adm_correo` varchar(100) NOT NULL,
  `adm_nombre` varchar(100) DEFAULT NULL,
  `adm_apellido` varchar(100) DEFAULT NULL,
  `adm_pass` varchar(100) DEFAULT NULL,
  `adm_master` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`adm_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADMIN`
--

LOCK TABLES `ADMIN` WRITE;
/*!40000 ALTER TABLE `ADMIN` DISABLE KEYS */;
INSERT INTO `ADMIN` VALUES ('a01736671@tec.mx','José JuanADM','Irene Ceravntes','jossprueba12356',1),('adm@expo.mx','Admin','H3BFQEWWREF','1234',1),('rafaadm@tec.mx','José Rafael','Aguilar Mejía','eladminmaster1234',1);
/*!40000 ALTER TABLE `ADMIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ALUMNO`
--

DROP TABLE IF EXISTS `ALUMNO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ALUMNO` (
  `a_matricula` varchar(9) DEFAULT NULL,
  `a_nombre` varchar(100) DEFAULT NULL,
  `a_apellido` varchar(100) DEFAULT NULL,
  `a_correo` varchar(100) NOT NULL,
  PRIMARY KEY (`a_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ALUMNO`
--

LOCK TABLES `ALUMNO` WRITE;
/*!40000 ALTER TABLE `ALUMNO` DISABLE KEYS */;
INSERT INTO `ALUMNO` VALUES ('12345678','José','Cervantes','0@tec.mx'),('A01234567','asdasd','asdasd','0JHSBD@tec.mx'),('A012345','Arturo','Gutierrez','A012345@tec.mx'),('A01730640','Hedguhar','Domínguez González','A01730640@tec.mx'),('A00345678','Ana','Rodríguez','ana.rodriguez@example.com'),('A01345678','ASDADSA3ERF','ASDASDASF','ejemplovideo@tec.mx'),('A01736671','José Juan','Irene Cervantes','jossjic_03@hotmail.com'),('A00123456','Juan','Pérez','juan.perez@example.com'),('A00234567','Luis','Martínez','luis.martinez@example.com'),('A00987654','María','González','maria.gonzalez@example.com'),('A00543210','Pedro','Sánchez','pedro.sanchez@example.com'),('A29131433','Rigoberto','Arngo Graza','rigogod@opera.com');
/*!40000 ALTER TABLE `ALUMNO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ANUNCIO`
--

DROP TABLE IF EXISTS `ANUNCIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ANUNCIO` (
  `an_id` int NOT NULL AUTO_INCREMENT,
  `an_titulo` varchar(100) DEFAULT NULL,
  `an_contenido` text,
  `an_grupo` int DEFAULT NULL,
  `an_fecha` datetime DEFAULT NULL,
  `adm_correo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`an_id`),
  KEY `adm_correo` (`adm_correo`),
  CONSTRAINT `ANUNCIO_ibfk_1` FOREIGN KEY (`adm_correo`) REFERENCES `ADMIN` (`adm_correo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANUNCIO`
--

LOCK TABLES `ANUNCIO` WRITE;
/*!40000 ALTER TABLE `ANUNCIO` DISABLE KEYS */;
INSERT INTO `ANUNCIO` VALUES (1,'Próxima reunión de proyecto','La reunión de proyecto se llevará a cabo el próximo lunes a las 10:00am en la sala de juntas.',1,'2023-05-01 10:00:00','rafaadm@tec.mx'),(2,'Cambio de horario de clases','A partir de la próxima semana, las clases de los miércoles se llevarán a cabo de 2:00pm a 4:00pm.',2,'2023-05-02 14:00:00','rafaadm@tec.mx'),(3,'Convocatoria para voluntarios','Se solicitan voluntarios para apoyar en el evento de caridad que se llevará a cabo en dos semanas. Interesados favor de contactar al coordinador del evento.',3,'2023-05-05 12:00:00','a01736671@tec.mx'),(4,'Suspensión de actividades','Se informa que debido a la contingencia climática, las actividades académicas y administrativas se suspenderán el día de mañana.',4,'2023-05-06 00:00:00','a01736671@tec.mx'),(5,'Feliz día del trabajo','El equipo de administración les desea un feliz día del trabajo a todos los colaboradores de la universidad.',1,'2023-05-01 09:00:00','adm@expo.mx');
/*!40000 ALTER TABLE `ANUNCIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORIA`
--

DROP TABLE IF EXISTS `CATEGORIA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CATEGORIA` (
  `ca_id` int NOT NULL AUTO_INCREMENT,
  `ca_nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIA`
--

LOCK TABLES `CATEGORIA` WRITE;
/*!40000 ALTER TABLE `CATEGORIA` DISABLE KEYS */;
INSERT INTO `CATEGORIA` VALUES (1,'Facultad de Ciencias'),(2,'Facultad de Humanidades'),(3,'Facultad de Ingeniería'),(4,'Facultad de Economía'),(5,'Facultad de Artes y Diseño');
/*!40000 ALTER TABLE `CATEGORIA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COLABORADOR`
--

DROP TABLE IF EXISTS `COLABORADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `COLABORADOR` (
  `co_correo` varchar(100) NOT NULL,
  `co_nomina` varchar(9) DEFAULT NULL,
  `co_nombre` varchar(100) DEFAULT NULL,
  `co_apellido` varchar(100) DEFAULT NULL,
  `co_pass` varchar(100) DEFAULT NULL,
  `co_es_jurado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COLABORADOR`
--

LOCK TABLES `COLABORADOR` WRITE;
/*!40000 ALTER TABLE `COLABORADOR` DISABLE KEYS */;
INSERT INTO `COLABORADOR` VALUES ('ana@example.com',NULL,'Ana','González','password123',1),('augusto@gmail.com','A01736346','Augusto','Gómez Maxil','1234',0),('carlos@example.com','000000003','Carlos','Martínez','123456',0),('jose@example.com','000000005','José','Sánchez','password',0),('juan@example.com','','Juan','Pérez','secreto123',1),('luisa@example.com','123456789','Luisa','Fernández','clave123',1),('rigoa@tec.mx','2123123','Rigoberto','Aguilar','12345',0),('rosario@tec.mx','l000','pepe','lolo','l000',0);
/*!40000 ALTER TABLE `COLABORADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EDICION`
--

DROP TABLE IF EXISTS `EDICION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EDICION` (
  `ed_id` int NOT NULL AUTO_INCREMENT,
  `ed_nombre` varchar(100) DEFAULT NULL,
  `ed_fecha_inicio` datetime DEFAULT NULL,
  `ed_fecha_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`ed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EDICION`
--

LOCK TABLES `EDICION` WRITE;
/*!40000 ALTER TABLE `EDICION` DISABLE KEYS */;
INSERT INTO `EDICION` VALUES (1,'Edición de Verano','2023-05-01 00:00:00','2023-06-01 00:00:00'),(2,'Edición de Otoño','2023-09-01 00:00:00','2023-11-30 23:59:59'),(3,'Edición de Primavera','2024-02-01 00:00:00','2024-04-30 23:59:59'),(4,'Edición de Invierno','2023-12-01 00:00:00','2024-01-31 23:59:59'),(5,'Edición de Vacaciones','2023-12-20 00:00:00','2024-01-05 23:59:59');
/*!40000 ALTER TABLE `EDICION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EDICION_COLABORADOR`
--

DROP TABLE IF EXISTS `EDICION_COLABORADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EDICION_COLABORADOR` (
  `ed_id` int DEFAULT NULL,
  `co_correo` varchar(100) DEFAULT NULL,
  KEY `ed_id` (`ed_id`),
  KEY `co_correo` (`co_correo`),
  CONSTRAINT `EDICION_COLABORADOR_ibfk_1` FOREIGN KEY (`ed_id`) REFERENCES `EDICION` (`ed_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `EDICION_COLABORADOR_ibfk_2` FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR` (`co_correo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EDICION_COLABORADOR`
--

LOCK TABLES `EDICION_COLABORADOR` WRITE;
/*!40000 ALTER TABLE `EDICION_COLABORADOR` DISABLE KEYS */;
INSERT INTO `EDICION_COLABORADOR` VALUES (1,'juan@example.com'),(1,'ana@example.com'),(2,'carlos@example.com'),(2,'luisa@example.com'),(3,'jose@example.com'),(1,'augusto@gmail.com');
/*!40000 ALTER TABLE `EDICION_COLABORADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ETAPA`
--

DROP TABLE IF EXISTS `ETAPA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ETAPA` (
  `et_id` int NOT NULL AUTO_INCREMENT,
  `et_nombre` varchar(100) DEFAULT NULL,
  `et_fecha_inicio` datetime DEFAULT NULL,
  `et_fecha_fin` datetime DEFAULT NULL,
  `ed_id` int DEFAULT NULL,
  PRIMARY KEY (`et_id`),
  KEY `ed_id` (`ed_id`),
  CONSTRAINT `ETAPA_ibfk_1` FOREIGN KEY (`ed_id`) REFERENCES `EDICION` (`ed_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ETAPA`
--

LOCK TABLES `ETAPA` WRITE;
/*!40000 ALTER TABLE `ETAPA` DISABLE KEYS */;
INSERT INTO `ETAPA` VALUES (1,'Etapa 1','2023-05-01 00:00:00','2023-05-31 23:59:59',1),(2,'Etapa 2','2023-06-01 00:00:00','2023-06-30 23:59:59',1),(3,'Etapa 3','2023-07-01 00:00:00','2023-07-31 23:59:59',1),(4,'Etapa 4','2023-08-01 00:00:00','2023-08-31 23:59:59',1),(5,'Etapa 5','2023-09-01 00:00:00','2023-09-30 23:59:59',1),(6,'Etapa 1','2023-05-01 00:00:00','2023-05-31 23:59:59',2),(7,'Etapa 2','2023-06-01 00:00:00','2023-06-30 23:59:59',2),(8,'Etapa 3','2023-07-01 00:00:00','2023-07-31 23:59:59',2),(9,'Etapa 4','2023-08-01 00:00:00','2023-08-31 23:59:59',2),(10,'Etapa 5','2023-09-01 00:00:00','2023-09-30 23:59:59',3),(11,'Etapa 1','2023-05-01 00:00:00','2023-05-31 23:59:59',3),(12,'Etapa 2','2023-06-01 00:00:00','2023-06-30 23:59:59',3),(13,'Etapa 3','2023-07-01 00:00:00','2023-07-31 23:59:59',3),(14,'Etapa 4','2023-08-01 00:00:00','2023-08-31 23:59:59',3),(15,'Etapa 5','2023-09-01 00:00:00','2023-09-30 23:59:59',3);
/*!40000 ALTER TABLE `ETAPA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EVALUACION`
--

DROP TABLE IF EXISTS `EVALUACION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EVALUACION` (
  `co_correo` varchar(100) DEFAULT NULL,
  `p_id` int DEFAULT NULL,
  `ev_criterio_1` int DEFAULT NULL,
  `ev_criterio_2` int DEFAULT NULL,
  `ev_criterio_3` int DEFAULT NULL,
  `ev_criterio_4` int DEFAULT NULL,
  `ev_criterio_5` int DEFAULT NULL,
  `ev_retro` text,
  `ev_cancelada` tinyint(1) DEFAULT NULL,
  KEY `p_id` (`p_id`),
  KEY `co_correo` (`co_correo`),
  CONSTRAINT `EVALUACION_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `PROYECTO` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `EVALUACION_ibfk_2` FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR` (`co_correo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EVALUACION`
--

LOCK TABLES `EVALUACION` WRITE;
/*!40000 ALTER TABLE `EVALUACION` DISABLE KEYS */;
INSERT INTO `EVALUACION` VALUES ('ana@example.com',1,3,2,4,1,3,'Buen trabajo en general, pero es necesario mejorar en el criterio 2',0),('ana@example.com',2,4,4,4,4,4,'Excelente trabajo en todos los criterios',0),('luisa@example.com',3,2,3,3,3,1,'Necesita mejorar en los criterios 1 y 5',0),('luisa@example.com',4,1,1,2,2,2,'Requiere mejoras importantes en todos los criterios',1),('luisa@example.com',5,4,3,4,3,4,'Excelente trabajo en general, pero es necesario mejorar en el criterio 2',0),('juan@example.com',3,4,1,3,4,4,'sdfasoidfkljasndkjfnaslkdfjbaslkjfdnb',0);
/*!40000 ALTER TABLE `EVALUACION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MAPA`
--

DROP TABLE IF EXISTS `MAPA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MAPA` (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_url` varchar(100) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MAPA`
--

LOCK TABLES `MAPA` WRITE;
/*!40000 ALTER TABLE `MAPA` DISABLE KEYS */;
/*!40000 ALTER TABLE `MAPA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NIVEL`
--

DROP TABLE IF EXISTS `NIVEL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `NIVEL` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NIVEL`
--

LOCK TABLES `NIVEL` WRITE;
/*!40000 ALTER TABLE `NIVEL` DISABLE KEYS */;
INSERT INTO `NIVEL` VALUES (1,'Concepto (Nivel TRL o SRL 1-3)'),(2,'Prototipo baja resolución o pruebas controladas (Nivel TRL o SRL 4-6)'),(3,'Producto terminado (Nivel TRL o SRL 7-9)');
/*!40000 ALTER TABLE `NIVEL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROYECTO`
--

DROP TABLE IF EXISTS `PROYECTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROYECTO` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_nombre_clave` varchar(100) DEFAULT NULL,
  `p_nombre` varchar(100) DEFAULT NULL,
  `p_descripcion` text,
  `n_id` int DEFAULT NULL,
  `p_estado` varchar(100) DEFAULT NULL,
  `p_pass` varchar(100) DEFAULT NULL,
  `p_video` varchar(100) DEFAULT NULL,
  `p_poster` varchar(100) DEFAULT NULL,
  `p_ult_modif` datetime DEFAULT NULL,
  `ca_id` int DEFAULT NULL,
  `ed_id` int DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_nombre_clave` (`p_nombre_clave`),
  KEY `ed_id` (`ed_id`),
  KEY `ca_id` (`ca_id`),
  KEY `n_id` (`n_id`),
  CONSTRAINT `PROYECTO_ibfk_1` FOREIGN KEY (`ed_id`) REFERENCES `EDICION` (`ed_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PROYECTO_ibfk_2` FOREIGN KEY (`ca_id`) REFERENCES `CATEGORIA` (`ca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PROYECTO_ibfk_3` FOREIGN KEY (`n_id`) REFERENCES `NIVEL` (`n_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTO`
--

LOCK TABLES `PROYECTO` WRITE;
/*!40000 ALTER TABLE `PROYECTO` DISABLE KEYS */;
INSERT INTO `PROYECTO` VALUES (1,'proyecto1','Proyecto 1','Descripción del proyecto 1',2,'En progreso','123456','https://drive.google.com/file/d/1QogWuB8owADYErTrLSeXaH7ltzTW5pTp/view?usp=sharing','https://drive.google.com/file/d/1m_Kaaqp0hQ_q5WgbQKNQY67eMJqonjQ4/view?usp=sharing','2023-05-01 22:21:53',3,1),(2,'proyecto2','Proyecto 2','Descripción del proyecto 2',1,'Finalizado','abcdef','https://drive.google.com/file/d/1QogWuB8owADYErTrLSeXaH7ltzTW5pTp/view?usp=sharing','https://drive.google.com/file/d/1m_Kaaqp0hQ_q5WgbQKNQY67eMJqonjQ4/view?usp=sharing','2023-05-01 22:21:53',2,1),(3,'proyecto3','Proyecto 3','Descripción del proyecto 3',2,'En progreso','qwerty','https://drive.google.com/file/d/1QogWuB8owADYErTrLSeXaH7ltzTW5pTp/view?usp=sharing','https://drive.google.com/file/d/1m_Kaaqp0hQ_q5WgbQKNQY67eMJqonjQ4/view?usp=sharing','2023-05-01 22:21:53',1,2),(4,'proyecto4','Proyecto 4','Descripción del proyecto 4',3,'En revisión','mypass','https://drive.google.com/file/d/1QogWuB8owADYErTrLSeXaH7ltzTW5pTp/view?usp=sharing','https://drive.google.com/file/d/1m_Kaaqp0hQ_q5WgbQKNQY67eMJqonjQ4/view?usp=sharing','2023-05-01 22:21:53',2,2),(5,'proyecto5','Proyecto 5','Descripción del proyecto 5',1,'En progreso','password123','https://drive.google.com/file/d/1QogWuB8owADYErTrLSeXaH7ltzTW5pTp/view?usp=sharing','https://drive.google.com/file/d/1m_Kaaqp0hQ_q5WgbQKNQY67eMJqonjQ4/view?usp=sharing','2023-05-01 22:21:53',3,2),(6,'proyecto_1','Proyecto 1','Esta es la descripción del proyecto 1',1,'Registrado','1234',NULL,NULL,'2023-05-04 14:00:55',1,NULL),(7,'hipo','El mejor proyecto del mundo','    holAkwedbkhjfdbe2jkhfdhw2jbk erjhfejwhf\r\ne\r\nf\r\nwe\r\nf\r\nwef\r\new\r\nfew\r\nwef\r\nfew\r\newf\r\nwef\r\nfwe\r\nwefw\r\nef\\																																		',3,'Registrado','1234','https://drive.google.com/file/d/1czzW4b_mv3xlLbih5D5CG1uEkWPsY-7z/view?usp=sharing','https://drive.google.com/file/d/1czzW4b_mv3xlLbih5D5CG1uEkWPsY-7z/view?usp=sharing','2023-05-03 21:28:00',3,NULL),(8,'12345',NULL,NULL,NULL,'Registrado','1234',NULL,NULL,NULL,NULL,NULL),(12,'VIDEO',NULL,NULL,NULL,'Registrado','123456',NULL,NULL,NULL,NULL,1),(13,'aaa','aa','aa',1,'Registrado','1234','https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing',NULL,'2023-05-04 15:21:45',1,1),(14,'EJEMPLOVIDEO','PROYECTO DE PRUEBA','AKJSDKAJSNDKJSANDKFJNASKJDNFADSF',2,'Aceptado','12345678','https://drive.google.com/file/d/1IFoqkM8n6DZqydegtCFJ5WdGO7Z3pUjV/view?usp=sharing','https://drive.google.com/file/d/1czzW4b_mv3xlLbih5D5CG1uEkWPsY-7z/view?usp=sharing','2023-05-04 14:21:37',2,1),(15,'proyecto_prueba_1','Proyecto prueba 1','Descripción de proyecto de prueba 1',1,'Registrado','1234','https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing','https://drive.google.com/file/d/1FJCKYH6bbg1EKo7r36pQY67k5AfVY56K/view?usp=sharing','2023-05-04 15:28:19',1,1),(16,'proyecto_prueba_2','Proyecto prueba 2','Esta es la descripción del proyecto 2',1,'Registrado','1234',NULL,NULL,'2023-05-04 15:27:15',3,1),(17,'proyecto_test','Proyecto test','Descripción test',1,'Registrado','1234','https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing','https://drive.google.com/file/d/1FJCKYH6bbg1EKo7r36pQY67k5AfVY56K/view?usp=sharing','2023-05-04 15:32:01',3,1),(18,'proyecto_test_1','Proyecto Test 1','Descripción 2',1,'Registrado','1234','https://drive.google.com/file/d/1zna5luHn-cdM1Cyqkoz8M0sQixjVCqbY/view?usp=sharing','https://drive.google.com/file/d/1FJCKYH6bbg1EKo7r36pQY67k5AfVY56K/view?usp=sharing','2023-05-04 16:03:14',3,1),(19,'pp',NULL,NULL,NULL,'Registrado','1234',NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `PROYECTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROYECTO_ALUMNO`
--

DROP TABLE IF EXISTS `PROYECTO_ALUMNO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROYECTO_ALUMNO` (
  `a_correo` varchar(100) DEFAULT NULL,
  `p_id` int DEFAULT NULL,
  KEY `a_correo` (`a_correo`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `PROYECTO_ALUMNO_ibfk_1` FOREIGN KEY (`a_correo`) REFERENCES `ALUMNO` (`a_correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PROYECTO_ALUMNO_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `PROYECTO` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTO_ALUMNO`
--

LOCK TABLES `PROYECTO_ALUMNO` WRITE;
/*!40000 ALTER TABLE `PROYECTO_ALUMNO` DISABLE KEYS */;
INSERT INTO `PROYECTO_ALUMNO` VALUES ('jossjic_03@hotmail.com',1),('jossjic_03@hotmail.com',1),('juan.perez@example.com',2),('ana.rodriguez@example.com',3),('maria.gonzalez@example.com',4),('pedro.sanchez@example.com',5),('0@tec.mx',7),('ejemplovideo@tec.mx',14),('A01730640@tec.mx',15),('A012345@tec.mx',17);
/*!40000 ALTER TABLE `PROYECTO_ALUMNO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROYECTO_DOCENTE`
--

DROP TABLE IF EXISTS `PROYECTO_DOCENTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROYECTO_DOCENTE` (
  `p_id` int DEFAULT NULL,
  `co_correo` varchar(100) DEFAULT NULL,
  KEY `co_correo` (`co_correo`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `PROYECTO_DOCENTE_ibfk_1` FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR` (`co_correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PROYECTO_DOCENTE_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `PROYECTO` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTO_DOCENTE`
--

LOCK TABLES `PROYECTO_DOCENTE` WRITE;
/*!40000 ALTER TABLE `PROYECTO_DOCENTE` DISABLE KEYS */;
INSERT INTO `PROYECTO_DOCENTE` VALUES (1,'carlos@example.com'),(2,'juan@example.com'),(3,'carlos@example.com'),(4,'juan@example.com'),(5,'juan@example.com'),(7,'ana@example.com'),(14,'carlos@example.com'),(17,'ana@example.com'),(18,'ana@example.com');
/*!40000 ALTER TABLE `PROYECTO_DOCENTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROYECTO_JURADO`
--

DROP TABLE IF EXISTS `PROYECTO_JURADO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROYECTO_JURADO` (
  `p_id` int DEFAULT NULL,
  `co_correo` varchar(100) DEFAULT NULL,
  KEY `p_id` (`p_id`),
  KEY `co_correo` (`co_correo`),
  CONSTRAINT `PROYECTO_JURADO_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `PROYECTO` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PROYECTO_JURADO_ibfk_2` FOREIGN KEY (`co_correo`) REFERENCES `COLABORADOR` (`co_correo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTO_JURADO`
--

LOCK TABLES `PROYECTO_JURADO` WRITE;
/*!40000 ALTER TABLE `PROYECTO_JURADO` DISABLE KEYS */;
INSERT INTO `PROYECTO_JURADO` VALUES (2,'carlos@example.com'),(1,'juan@example.com'),(4,'carlos@example.com'),(3,'juan@example.com');
/*!40000 ALTER TABLE `PROYECTO_JURADO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-04 18:35:12
