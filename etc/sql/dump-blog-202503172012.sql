-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Geral'),(2,'Ciência'),(3,'Tecnologia'),(4,'Saúde'),(5,'Negócios'),(6,'Economia e Finanças'),(7,'Estilo de Vida'),(8,'Política');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_comment_id` int(11) NOT NULL DEFAULT 0,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `registered_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_ref_comment` (`ref_comment_id`),
  KEY `index_post_id` (`post_id`),
  KEY `index_user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,0,1,1,'Esse é o primeiro comentário!','2025-03-14 02:36:41'),(2,1,1,1,'Resposta ao primeiro comentário','2025-03-14 02:36:41'),(3,1,1,1,'Segundo comentário resposta','2025-03-14 02:36:41'),(4,0,2,1,'Olá! Primeiro a comentar :)','2025-03-14 02:38:08');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('src\\migrations\\Version20240916132747','2025-03-14 02:35:53',9),('src\\migrations\\Version20240916140524','2025-03-14 02:35:53',4),('src\\migrations\\Version20240916141422','2025-03-14 02:35:53',16),('src\\migrations\\Version20240916143742','2025-03-14 02:35:53',15),('src\\migrations\\Version20240922012732','2025-03-14 02:35:53',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `title` varchar(1000) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `registered_at` datetime NOT NULL,
  `status` enum('draft','hidden','ok') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  KEY `index_views` (`views`),
  KEY `index_user_id` (`user_id`),
  KEY `index_category_id` (`category_id`),
  KEY `index_registered` (`registered_at`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,4,6,'Revolução e Futuro da Medicina','Tecnologia na Saúde','A tecnologia tem desempenhado um papel fundamental na evolução da área da saúde, proporcionando diagnósticos mais precisos, tratamentos mais eficazes e melhor qualidade de vida para a população. Com o avanço da inteligência artificial, da telemedicina e de dispositivos conectados, a medicina se tornou mais acessível, eficiente e personalizada. \nCom a digitalização da saúde, os pacientes ganham mais autonomia no cuidado com seu bem-estar. Aplicativos permitem o controle de medicamentos, plataformas de saúde digital armazenam históricos médicos, e os exames podem ser compartilhados entre profissionais em tempo real, agilizando diagnósticos e tratamentos.\n\nAlém disso, a tecnologia tem um papel fundamental na medicina preventiva, ajudando a identificar fatores de risco antes que uma doença se desenvolva. Dessa forma, é possível reduzir custos hospitalares e melhorar a expectativa de vida da população.\n\nApesar dos inúmeros benefícios, a integração da tecnologia na saúde também traz desafios. A privacidade dos dados médicos, a dependência de sistemas digitais e a necessidade de regulamentação são questões que exigem atenção. Além disso, é fundamental garantir que as inovações tecnológicas estejam disponíveis para toda a população, evitando desigualdades no acesso à saúde.\n\nA tecnologia está transformando a área da saúde, tornando-a mais eficiente, acessível e inovadora. Com o avanço constante das pesquisas e do desenvolvimento de novas soluções, o futuro da medicina será cada vez mais personalizado e preventivo. O equilíbrio entre inovação, ética e acessibilidade será essencial para garantir que todos possam se beneficiar dos avanços tecnológicos na saúde.\n\n\n\n\n\n\n\n','2025-03-14 02:37:18','ok'),(2,1,2,10,'O Método Científico','Investir em ciência é investir no futuro','A ciência se baseia no método científico, um processo estruturado que envolve a formulação de hipóteses, a realização de experimentos e a análise de resultados. Esse método garante que o conhecimento adquirido seja confiável e possa ser replicado por outros pesquisadores. É graças a essa abordagem rigorosa que a humanidade conseguiu avanços como vacinas, eletricidade, computadores e viagens espaciais.','2025-03-14 02:37:24','ok'),(3,1,3,4,'Transformando o Mundo Moderno','O Impacto da Tecnologia no Cotidiano: Os avanços tecnológicos continuam a abrir novos horizontes. Áreas como biotecnologia, inteligência artificial e computação quântica prometem revoluções que podem impactar profundamente a humanidade. ','A tecnologia sempre esteve presente na história da humanidade. Desde a invenção da roda e do fogo até a criação da eletricidade e dos computadores, cada avanço trouxe mudanças significativas para a sociedade. No século XXI, a tecnologia evolui em um ritmo acelerado, influenciando todos os setores, como saúde, transporte, comunicação e educação. Hoje, a tecnologia está integrada ao nosso dia a dia de maneiras inimagináveis há algumas décadas. Os smartphones conectam bilhões de pessoas instantaneamente, a inteligência artificial automatiza tarefas e a computação em nuvem permite o armazenamento de dados em larga escala. Além disso, a internet das coisas (IoT) transforma objetos comuns em dispositivos inteligentes, tornando nossas casas, cidades e empresas mais eficientes.','2025-03-14 02:37:30','ok'),(6,1,4,1,'Publicacao 04','Subtítulo da publicação 04','Conteúdo da publicação 04.','2025-03-17 20:06:36','ok'),(7,1,5,2,'Publicacao 05','Subtítulo da publicação 05','Conteúdo da publicação 05.','2025-03-17 20:06:41','ok'),(8,1,6,3,'Publicacao 06','Subtítulo da publicação 06','Conteúdo da publicação 06.','2025-03-17 20:06:47','ok'),(9,1,7,4,'Publicacao 07','Subtítulo da publicação 07','Conteúdo da publicação 07.','2025-03-17 20:04:51','ok'),(10,1,8,5,'Publicacao 08','Subtítulo da publicação 08','Conteúdo da publicação 08.','2025-03-17 20:04:51','ok'),(11,1,1,6,'Publicacao 09','Subtítulo da publicação 09','Conteúdo da publicação 09.','2025-03-17 20:04:51','ok'),(12,1,2,1,'Publicacao 10','Subtítulo da publicação 10','Conteúdo da publicação 10.','2025-03-17 20:04:51','ok'),(13,1,3,2,'Publicacao 11','Subtítulo da publicação 11','Conteúdo da publicação 11.','2025-03-17 20:04:51','ok'),(14,1,4,4,'Publicacao 12','Subtítulo da publicação 12','Conteúdo da publicação 12.','2025-03-17 20:04:51','ok'),(15,1,5,5,'Publicacao 13','Subtítulo da publicação 13','Conteúdo da publicação 13.','2025-03-17 20:04:51','ok'),(16,1,6,6,'Publicacao 14','Subtítulo da publicação 14','Conteúdo da publicação 14.','2025-03-17 20:04:51','ok'),(17,1,7,15,'Publicacao 15','Subtítulo da publicação 15','Conteúdo da publicação 15.','2025-03-17 20:04:51','ok'),(18,1,8,23,'Publicacao 16','Subtítulo da publicação 16','Conteúdo da publicação 16.','2025-03-17 20:04:51','ok'),(19,1,1,10,'Publicacao 17','Subtítulo da publicação 17','Conteúdo da publicação 17.','2025-03-17 20:04:51','ok'),(20,1,2,6,'Publicacao 18','Subtítulo da publicação 18','Conteúdo da publicação 18.','2025-03-17 20:04:51','ok'),(21,1,3,4,'Publicacao 19','Subtítulo da publicação 19','Conteúdo da publicação 19.','2025-03-17 20:04:51','ok'),(22,1,4,10,'Publicacao 20','Subtítulo da publicação 20','Conteúdo da publicação 20.','2025-03-17 20:04:51','ok'),(23,1,5,67,'Publicacao 21','Subtítulo da publicação 21','Conteúdo da publicação 21.','2025-03-17 20:04:51','ok'),(24,1,6,34,'Publicacao 22','Subtítulo da publicação 22','Conteúdo da publicação 22.','2025-03-17 20:04:51','ok'),(25,1,7,22,'Publicacao 23','Subtítulo da publicação 23','Conteúdo da publicação 23.','2025-03-17 20:04:51','ok'),(26,1,8,14,'Publicacao 24','Subtítulo da publicação 24','Conteúdo da publicação 24.','2025-03-17 20:04:51','ok'),(27,1,1,41,'Publicacao 25','Subtítulo da publicação 25','Conteúdo da publicação 25.','2025-03-17 20:04:51','ok'),(28,1,2,21,'Publicacao 26','Subtítulo da publicação 26','Conteúdo da publicação 26.','2025-03-17 20:04:51','ok'),(29,1,3,1,'Publicacao 27','Subtítulo da publicação 27','Conteúdo da publicação 27.','2025-03-17 20:04:51','ok');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(150) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vitor','Lopes','dev@mail.com','123456',1,'2025-03-17 19:57:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'blog'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-17 20:12:17
