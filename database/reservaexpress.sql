-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 11:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservaexpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE `alumno` (
  `id` int(10) UNSIGNED NOT NULL,
  `carrera` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE `carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(5, 'Analista de Sistemas'),
(1, 'Ingeniería Electromecánica'),
(6, 'Ingeniería en Sistemas'),
(9, 'Licenciatura en Administración'),
(18, 'Licenciatura en Comunicación Audiovisual'),
(2, 'Licenciatura en Higiene y Seguridad en el Trabajo'),
(14, 'Licenciatura en Trabajo Social'),
(11, 'Licenciatura en Turismo'),
(13, 'Profesorado en Matemática'),
(16, 'Profesorado para la Educación Primaria'),
(17, 'Profesorado Universitario en Ciencias de la Educación'),
(7, 'Tecnicatura Universitaria en Desarrollo Web'),
(10, 'Tecnicatura Universitaria en Gestión de Organizaciones'),
(3, 'Tecnicatura Universitaria en Petróleo'),
(15, 'Tecnicatura Universitaria en Recursos Naturales Renovables Orientación Frutihortícola'),
(8, 'Tecnicatura Universitaria en Redes de Computadoras'),
(4, 'Tecnicatura Universitaria en Seguridad e Higiene en el Trabajo'),
(12, 'Tecnicatura Universitaria en Turismo');

-- --------------------------------------------------------

--
-- Table structure for table `ejemplares`
--

CREATE TABLE `ejemplares` (
  `id` int(10) UNSIGNED NOT NULL,
  `material` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fechaBaja` datetime DEFAULT NULL,
  `usuarioBaja` int(10) UNSIGNED DEFAULT NULL,
  `razonBaja` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(10) UNSIGNED NOT NULL,
  `ISBN` varchar(17) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `edicion` int(2) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `disciplina` varchar(255) NOT NULL,
  `cantEjemplares` int(3) NOT NULL,
  `estado` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `ISBN`, `titulo`, `autor`, `edicion`, `editorial`, `disciplina`, `cantEjemplares`, `estado`) VALUES
(1, '978-950-07-6717-0', 'Cien años de soledad', 'Gabriel García Márquez', 1, 'Sudamericana', 'Ficción', 0, 0),
(2, '978-987-88-8777-7', '1984', 'George Orwell', 3, 'Debolsillo', 'Ciencia Ficción', 0, 0),
(3, '978-987-1502-97-4', 'El principito', 'Antoine de Saint-Exupéry', 5, 'Salamandra', 'Literatura Infantil', 0, 0),
(4, '978-987-738-620-2', 'Don Quijote de la Mancha', 'Miguel de Cervantes', 2, 'Espasa Calpe', 'Clásicos', 0, 0),
(5, '978-987-503-677-2', 'Crimen y castigo', 'Fiodor Dostoievski', 4, 'Anaya', 'Novela', 0, 0),
(6, '978-987-3743-17-7', 'Ulises', 'James Joyce', 1, 'Alfaguara', 'Ficción', 0, 0),
(7, '978-987-47523-1-4', 'Los miserables', 'Victor Hugo', 6, 'Penguin Clásicos', 'Clásicos', 0, 0),
(8, '978-950-07-6720-0', 'El amor en los tiempos del cólera', 'Gabriel García Márquez', 2, 'Penguin Clásicos', 'Ficción', 0, 0),
(9, '978-987-800-178-4', 'Harry Potter y la piedra filosofal', 'J.K. Rowling', 1, 'Salamandra', 'Fantasía', 0, 0),
(10, '978-987-609-593-8', 'Matar un ruiseñor', 'Harper Lee', 3, 'HarperCollins', 'Novela', 0, 0),
(11, '978-987-812-020-1', 'Los juegos del hambre', 'Suzanne Collins', 1, 'Roca Editorial', 'Ciencia Ficción', 0, 0),
(12, '978-950-49-5544-3', 'El código Da Vinci', 'Dan Brown', 2, 'Planeta', 'Misterio', 0, 0),
(13, '978-987-4178-23-7', 'Los hombres me explican cosas', 'Rebecca Solnit', 1, 'Capitán Swing', 'Ensayo', 0, 0),
(14, '978-987-605-899-5', 'La sombra del viento', 'Carlos Ruiz Zafón', 4, 'Planeta', 'Ficción', 0, 0),
(15, '978-987-3650-20-8', 'La carretera', 'Cormac McCarthy', 3, 'Alfaguara', 'Ficción', 0, 0),
(16, '978-987-725-441-9', 'Los pilares de la tierra', 'Ken Follett', 5, 'Debolsillo', 'Histórica', 0, 0),
(17, '978-987-780-263-4', 'El psicoanalista', 'John Katzenbach', 2, 'Ediciones B', 'Suspense', 0, 0),
(18, '978-950-07-5771-3', 'El nombre de la rosa', 'Umberto Eco', 3, 'Debolsillo', 'Histórica', 0, 0),
(19, '978-987-8266-77-0', 'Rayuela', 'Julio Cortázar', 1, 'Alianza Editorial', 'Ficción', 0, 0),
(20, '978-987-8367-47-7', 'La odisea', 'Homero', 4, 'Ediciones Cátedra', 'Clásicos', 0, 0),
(21, '978-987-670-758-9', 'La insoportable levedad del ser', 'Milan Kundera', 2, 'Tusquets Editores', 'Ficción', 0, 0),
(22, '978-987-822-095-6', 'El perfume', 'Patrick Süskind', 4, 'Seix Barral', 'Ficción', 0, 0),
(23, '978-849-464-532-7', 'Mujer en punto cero', 'Nawal El Saadawi', 1, 'Ediciones Cátedra', 'Ficción', 0, 0),
(24, '978-987-725-114-2', 'Siddhartha', 'Hermann Hesse', 5, 'RBA Libros', 'Filosofía', 0, 0),
(25, '978-843-221-710-4', 'La ciudad de los prodigios', 'Eduardo Mendoza', 2, 'Seix Barral', 'Histórica', 0, 0),
(26, '978-847-223-225-9', 'La insostenible levedad del ser', 'Milan Kundera', 3, 'Anagrama', 'Ficción', 0, 0),
(27, '978-950-820-005-1', 'El caballero de la armadura oxidada', 'Robert Fisher', 4, 'Obelisco', 'Autoayuda', 0, 0),
(28, '978-987-738-587-8', 'Los detectives salvajes', 'Roberto Bolaño', 2, 'Anagrama', 'Ficción', 0, 0),
(29, '978-842-067-888-7', 'Yo soy Malala', 'Malala Yousafzai', 1, 'Alianza Editorial', 'Biografía', 0, 0),
(30, '978-950-07-5575-7', 'Ficciones', 'Jorge Luis Borges', 4, 'Emece Editores', 'Ficción', 0, 0),
(31, '978-849-407-454-7', 'La niña que nunca cometía errores', 'Mark Pett', 2, 'Juventud', 'Infantil', 0, 0),
(32, '978-987-1544-35-6', 'La inmortalidad', 'Milan Kundera', 3, 'Anagrama', 'Ficción', 0, 0),
(33, '978-950-04-0645-1', 'La muerte y la brújula', 'Jorge Luis Borges', 1, 'Alianza Editorial', 'Misterio', 0, 0),
(34, '978-849-992-622-3', 'Sapiens: De animales a dioses', 'Yuval Noah Harari', 2, 'Debate', 'Historia', 0, 0),
(35, '978-987-609-052-0', 'Cosmos', 'Carl Sagan', 3, 'Planeta', 'Ciencia', 0, 0),
(36, '978-950-03-7401-9', 'El retrato de Dorian Gray', 'Oscar Wilde', 1, 'Austral', 'Clásicos', 0, 0),
(37, '978-950-547-273-4', 'La naranja mecánica', 'Anthony Burgess', 2, 'Alianza Editorial', 'Ciencia Ficción', 0, 0),
(38, '978-987-47984-1-1', 'El lobo estepario', 'Hermann Hesse', 3, 'Debolsillo', 'Ficción', 0, 0),
(39, '978-987-3693-95-3', 'Veinticuatro horas en la vida de una mujer', 'Stefan Zweig', 2, 'Acantilado', 'Ficción', 0, 0),
(40, '978-987-3650-20-9', 'La carretera', 'Cormac McCarthy', 4, 'Alfaguara', 'Ficción', 0, 0),
(41, '978-987-04-0955-7', 'La región más transparente', 'Carlos Fuentes', 1, 'Fondo de Cultura Económica', 'Ficción', 0, 0),
(42, '978-843-221-701-2', 'El misterio de la cripta embrujada', 'Eduardo Mendoza', 3, 'Seix Barral', 'Misterio', 0, 0),
(43, '978-987-738-587-9', 'Los detectives salvajes', 'Roberto Bolaño', 1, 'Anagrama', 'Ficción', 0, 0),
(44, '978-987-725-103-6', 'El juego de Ripper', 'Isabel Allende', 2, 'Plaza & Janés', 'Misterio', 0, 0),
(45, '978-987-738-009-5', 'Rayuela', 'Julio Cortázar', 1, 'Alianza Editorial', 'Ficción', 0, 0),
(46, '978-950-07-6719-4', 'El otoño del patriarca', 'Gabriel García Márquez', 2, 'Debolsillo', 'Ficción', 0, 0),
(47, '978-987-4178-23-6', 'Los hombres me explican cosas', 'Rebecca Solnit', 4, 'Capitán Swing', 'Ensayo', 0, 0),
(48, '978-987-566-382-4', 'La catedral del mar', 'Ildefonso Falcones', 2, 'Grijalbo', 'Histórica', 0, 0),
(49, '978-987-822-017-8', 'El laberinto de los espíritus', 'Carlos Ruiz Zafón', 1, 'Planeta', 'Ficción', 0, 0),
(50, '978-987-725-598-0', 'La casa de los espíritus', 'Isabel Allende', 3, 'Debolsillo', 'Ficción', 0, 0),
(51, '978-987-725-441-0', 'Los pilares de la tierra', 'Ken Follett', 4, 'Debolsillo', 'Histórica', 0, 0),
(52, '978-987-605-899-6', 'La sombra del viento', 'Carlos Ruiz Zafón', 5, 'Planeta', 'Ficción', 0, 0),
(53, '978-950-04-4271-8', 'La uruguaya', 'Pedro Mairal', 1, 'Anagrama', 'Ficción', 0, 0),
(54, '978-987-800-012-1', 'Harry Potter y el prisionero de Azkaban', 'J.K. Rowling', 4, 'Salamandra', 'Fantasía', 0, 0),
(55, '978-987-812-022-5', 'Los juegos del hambre: Sinsajo', 'Suzanne Collins', 3, 'Roca Editorial', 'Ciencia Ficción', 0, 0),
(56, '978-987-822-037-6', 'Cazadores de sombras: Ciudad de hueso', 'Cassandra Clare', 2, 'Planeta', 'Fantasía', 0, 0),
(57, '978-987-580-885-0', 'El código Da Vinci', 'Dan Brown', 1, 'Planeta', 'Misterio', 0, 0),
(58, '978-987-8435-95-4', 'La chica del tren', 'Paula Hawkins', 4, 'Planeta', 'Suspense', 0, 0),
(59, '978-950-699-003-9', 'El juego de Ender', 'Orson Scott Card', 2, 'Ediciones B', 'Ciencia Ficción', 0, 0),
(60, '978-987-822-071-0', 'La elegancia del erizo', 'Muriel Barbery', 1, 'Anagrama', 'Ficción', 0, 0),
(61, '978-849-464-532-8', 'Mujer en punto cero', 'Nawal El Saadawi', 3, 'Ediciones Cátedra', 'Ficción', 0, 0),
(62, '978-987-609-177-0', 'Los juegos del hambre: En llamas', 'Suzanne Collins', 1, 'Roca Editorial', 'Ciencia Ficción', 0, 0),
(63, '978-950-732-454-3', 'La chica que soñaba con una cerilla y un bidón de gasolina', 'Stieg Larsson', 2, 'Destino', 'Suspense', 0, 0),
(64, '978-987-725-165-4', 'Desayuno en Tiffany\'s', 'Truman Capote', 1, 'Anagrama', 'Ficción', 0, 0),
(65, '978-950-28-1169-7', 'La mujer en la ventana', 'A.J. Finn', 2, 'Planeta', 'Suspense', 0, 0),
(66, '978-987-628-342-7', 'Harry Potter y la cámara secreta', 'J.K. Rowling', 3, 'Salamandra', 'Fantasía', 0, 0),
(67, '978-987-718-210-1', 'El retrato de Dorian Gray', 'Oscar Wilde', 1, 'Austral', 'Clásicos', 0, 0),
(68, '978-987-8941-74-5', 'El psicoanalista', 'John Katzenbach', 4, 'Ediciones B', 'Suspense', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`id`, `nombre`) VALUES
(1, 'Acondicionamiento de Gas'),
(2, 'Álgebra'),
(3, 'Análisis Matemático I'),
(4, 'Análisis Matemático II'),
(5, 'Análisis Matemático III'),
(6, 'Análisis y Diseño de Software'),
(7, 'Análisis y Producción del Discurso'),
(8, 'Arquitectura de Computadoras'),
(9, 'Arquitectura Web'),
(10, 'Arquitecturas de Computadoras'),
(11, 'Arquitecturas de Software'),
(12, 'Aspectos de Formación Técnico-Profesional'),
(13, 'Aspectos Profesionales'),
(14, 'Bases de Datos'),
(15, 'Cálculo Numérico'),
(16, 'Centrales y Redes'),
(17, 'Ciencia, Universidad y Sociedad'),
(18, 'Combustibles'),
(19, 'Contaminación y Gestión Ambiental'),
(20, 'Desarrollo de Aplicaciones Web'),
(21, 'Desarrollo de Software para la Web'),
(22, 'Diseño de Interfaces de Usuario'),
(23, 'Diseño de Puestos de Trabajo'),
(24, 'Economía y Organización Empresarial'),
(25, 'Economía y Organización Industrial'),
(26, 'Electrónica Básica'),
(27, 'Electrónica y Automatización'),
(28, 'Electrotecnia y Mediciones Eléctricas'),
(29, 'Electrotecnia y Principios de Máquinas Eléctricas'),
(30, 'Energía Eólica'),
(31, 'Energías Renovables'),
(32, 'Equipos e Instalaciones para Movimiento y Transporte de Cargas y Personal'),
(33, 'Ergonomía'),
(34, 'Ergosicología y Relaciones Humanas'),
(35, 'Estadística I'),
(36, 'Estadística II'),
(37, 'Estática'),
(38, 'Estructuras de Datos'),
(39, 'Ética y Ejercicio Profesional'),
(40, 'Física I'),
(41, 'Física II'),
(42, 'Fundamentos de Ciencias de la Computación'),
(43, 'Fundamentos de Informática'),
(44, 'Geología I'),
(45, 'Gestión de Calidad de Software Sistemas en Tiempo Real'),
(46, 'Gestión de las Organizaciones'),
(47, 'Gestión de Proyectos de Software'),
(48, 'Higiene Laboral'),
(49, 'Inferencia Estadística'),
(50, 'Informática'),
(51, 'Ingeniería Legal'),
(52, 'Instalaciones Civiles e Industriales'),
(53, 'Instalaciones de Superficie'),
(54, 'Instalaciones Eléctricas'),
(55, 'Instalaciones Eléctricas y Mantenimiento de Plantas Industriales'),
(56, 'Introducción al Conocimiento Científico'),
(57, 'Laboratorio de Bases de Datos'),
(58, 'Laboratorio de Desarrollo de Software'),
(59, 'Laboratorio de Programación'),
(60, 'Laboratorio de Redes'),
(61, 'Laboratorio Web I'),
(62, 'Laboratorio Web II'),
(63, 'Legislación Laboral'),
(64, 'Lenguajes de Programación'),
(65, 'Manejo, Almacenamiento, Transporte y Distribución del Hidrógeno'),
(66, 'Mantenimiento'),
(67, 'Mantenimiento Industrial'),
(68, 'Máquinas Eléctricas'),
(69, 'Máquinas Hidráulicas'),
(70, 'Máquinas Térmicas'),
(71, 'Matemática'),
(72, 'Matemática Discreta'),
(73, 'Matemática I'),
(74, 'Matemática II'),
(75, 'Mecánica de los Fluidos'),
(76, 'Mecánica Racional'),
(77, 'Mecanismos y Elementos de Máquina'),
(78, 'Medicina Laboral'),
(79, 'Metodología de la Investigación'),
(80, 'Metodología Estadística'),
(81, 'Modelos y Simulación'),
(82, 'Organización de las Computadoras'),
(83, 'Organización Industrial I - Producción'),
(84, 'Perforación, Terminación y Reparación de Pozos'),
(85, 'Plantas de Petróleo'),
(86, 'Procesos de Desarrollo de Software'),
(87, 'Producción'),
(88, 'Producción de Hidrógeno por Electrólisis'),
(89, 'Programación'),
(90, 'Programación Orientada a Objetos'),
(91, 'Programación Web Avanzada'),
(92, 'Protección contra Incendios'),
(93, 'Protección contra Radiaciones'),
(94, 'Proyecto de Desarrollo Web'),
(95, 'Proyecto de Redes I'),
(96, 'Proyecto de Redes II'),
(97, 'Psicología Laboral'),
(98, 'Química General'),
(99, 'Química I'),
(100, 'Química II'),
(101, 'Química Inorgánica'),
(102, 'Recuperación Asistida'),
(103, 'Redes II: Redes de Área Local'),
(104, 'Redes III: Niveles de Red Aplicación'),
(105, 'Redes IV: Dispositivos de Redes'),
(106, 'Redes y Telecomunicaciones'),
(107, 'Requerimientos de Software'),
(108, 'Reservorios'),
(109, 'Resistencia de Materiales'),
(110, 'Resolución de Problemas y Algoritmos'),
(111, 'Ruidos y Vibraciones'),
(112, 'Seguridad en Ámbitos Hospitalarios y en la Industria Pesquera'),
(113, 'Seguridad en Industrias Extractivas'),
(114, 'Seguridad en la Actividad Agropecuaria'),
(115, 'Seguridad en la Construcción'),
(116, 'Seguridad en la Web'),
(117, 'Seguridad en Redes'),
(118, 'Seguridad, Higiene y Ambiente'),
(119, 'Seguridad, Higiene y Gestión Ambiental'),
(120, 'Seminario de Elaboración de Tesis'),
(121, 'Seminario de Tecnología de Redes'),
(122, 'Seminario de Tecnología de Redes II'),
(123, 'Seminario de Tecnologías Web'),
(124, 'Sistemas de Representación'),
(125, 'Sistemas Integrados de Gestión'),
(126, 'Sistemas Inteligentes Artificiales'),
(127, 'Sistemas Operativos'),
(128, 'Sistemas Operativos Distribuidos'),
(129, 'Sociología del Trabajo'),
(130, 'Taller de Mediciones Aplicadas a Redes'),
(131, 'Taller de Sistemas Operativos Aplicados'),
(132, 'Tecnología Mecánica'),
(133, 'Termodinámica Materiales'),
(134, 'Termodinámica, Máquinas y Motores Térmicos'),
(135, 'Tópicos Avanzados de Bases de Datos'),
(136, 'Tópicos de Cálculo Avanzado y Numérico'),
(137, 'Topografía I'),
(138, 'Toxicología'),
(139, 'Uso del Hidrógeno'),
(140, 'Validación y Verificación de Software'),
(141, 'Ventilación, Iluminación y Carga Térmica');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio` int(10) UNSIGNED NOT NULL,
  `ejemplar` int(10) UNSIGNED NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaVencimiento` datetime NOT NULL,
  `fechaDevolucion` datetime DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `id` int(10) UNSIGNED NOT NULL,
  `materia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `socio`
--

CREATE TABLE `socio` (
  `id` int(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fechaAlta` datetime NOT NULL DEFAULT current_timestamp(),
  `tipoSocio` int(10) UNSIGNED NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `dni` int(8) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `tipoUsuario` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fechaAlta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`);

--
-- Indexes for table `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD PRIMARY KEY (`id`,`material`),
  ADD KEY `material` (`material`),
  ADD KEY `usuarioBaja` (`usuarioBaja`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ejemplar` (`ejemplar`),
  ADD KEY `socio` (`socio`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia` (`materia`);

--
-- Indexes for table `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuenta` (`cuenta`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indexes for table `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `cuenta` (`cuenta`),
  ADD KEY `tipoUsuario` (`tipoUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ejemplares`
--
ALTER TABLE `ejemplares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socio`
--
ALTER TABLE `socio`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD CONSTRAINT `material` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `usuarioBaja` FOREIGN KEY (`usuarioBaja`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `ejemplar` FOREIGN KEY (`ejemplar`) REFERENCES `ejemplares` (`id`),
  ADD CONSTRAINT `socio` FOREIGN KEY (`socio`) REFERENCES `socio` (`id`);

--
-- Constraints for table `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `materia` FOREIGN KEY (`materia`) REFERENCES `materias` (`id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `tipoUsuario` FOREIGN KEY (`tipoUsuario`) REFERENCES `tipousuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
