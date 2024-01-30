
-- Creamos la base de datos
	CREATE DATABASE dwes;
	USE dwes;
	
-- Creamos las tablas
	CREATE TABLE FAMILIA (
		COD VARCHAR( 6 ) NOT NULL ,
		NOMBRE VARCHAR( 200 ) NOT NULL ,
		PRIMARY KEY ( COD )
	);
	
	CREATE TABLE TIENDA (
		COD INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		NOMBRE VARCHAR( 100 ) NOT NULL ,
		TLF VARCHAR( 13 ) NULL
	);

	CREATE TABLE PRODUCTO (
		COD VARCHAR( 12 ) NOT NULL ,
		NOMBRE VARCHAR( 200 ) NULL ,
		NOMBRE_CORTO VARCHAR( 50 ) NOT NULL UNIQUE,
		DESCRIPCION TEXT NULL ,
		PVP DECIMAL( 10, 2 ) NOT NULL ,
		FAMILIA VARCHAR( 6 ) NOT NULL ,
		PRIMARY KEY ( COD ) ,
		FOREIGN KEY (FAMILIA) REFERENCES FAMILIA (COD) ON UPDATE CASCADE
	);

	CREATE TABLE STOCK (
		PRODUCTO VARCHAR( 12 ) NOT NULL ,
		TIENDA INT NOT NULL ,
		UNIDADES INT NOT NULL ,
		PRIMARY KEY ( PRODUCTO , TIENDA ),
		FOREIGN KEY (TIENDA) REFERENCES TIENDA (COD) ON UPDATE CASCADE,
		FOREIGN KEY (PRODUCTO) REFERENCES PRODUCTO (COD) ON UPDATE CASCADE
	);
	
-- Creamos el usuario
CREATE USER 'user_dwes' IDENTIFIED BY 'userUSER2';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, EXECUTE ON *.* TO 'user_dwes'@'%';




-- Insertamos los datos

USE DWES;

INSERT INTO TIENDA (COD, NOMBRE, TLF) VALUES
	(1, 'CENTRAL', '600100100'),
	(2, 'SUCURSAL1', '600100200'),
	(3, 'SUCURSAL2', NULL);

INSERT INTO FAMILIA (COD, NOMBRE) VALUES
	('CAMARA', 'Cámaras digitales'),
	('CONSOL', 'Consolas'),
	('EBOOK', 'Libros electrónicos'),
	('IMPRES', 'Impresoras'),
	('MEMFLA', 'Memorias flash'),
	('MP3', 'Reproductores MP3'),
	('MULTIF', 'Equipos multifunción'),
	('NETBOK', 'Netbooks'),
	('ORDENA', 'Ordenadores'),
	('PORTAT', 'Ordenadores portátiles'),
	('ROUTER', 'Routers'),
	('SAI', 'Sistemas de alimentación ininterrumpida'),
	('SOFTWA', 'Software'),
	('TV', 'Televisores'),
	('VIDEOC', 'Videocámaras'),
	('INSTRUM','Instrumentos');
	
INSERT INTO PRODUCTO (COD, NOMBRE, NOMBRE_CORTO, DESCRIPCION, PVP, FAMILIA) VALUES 
	('3DSNG', NULL, 'Nintendo 3DS negro', 'Consola portátil de Nintendo que permitirá disfrutar de efectos 3D sin necesidad de gafas especiales, e incluirá retrocompatibilidad con el software de DS y de DSi.', '270.00', 'CONSOL'),
	('ACERAX3950', NULL, 'Acer AX3950 I5-650 4GB 1TB W7HP', 'Características:\r\n\r\nSistema Operativo : Windows® 7 Home Premium Original\r\n\r\nProcesador / Chipset\r\nNúmero de Ranuras PCI: 1\r\nFabricante de Procesador: Intel\r\nTipo de Procesador: Core i5\r\nModelo de Procesador: i5-650\r\nNúcleo de Procesador: Dual-core\r\nVelocidad de Procesador: 3,20 GHz\r\nCaché: 4 MB\r\nVelocidad de Bus: No aplicable\r\nVelocidad HyperTransport: No aplicable\r\nInterconexión QuickPathNo aplicable\r\nProcesamiento de 64 bits: Sí\r\nHyperThreadingSí\r\nFabricante de Chipset: Intel\r\nModelo de Chipset: H57 Express\r\n\r\nMemoria\r\nMemoria Estándar: 4 GB\r\nMemoria Máxima: 8 GB\r\nTecnología de la Memoria: DDR3 SDRAM\r\nEstándar de Memoria: DDR3-1333/PC3-10600\r\nNúmero de Ranuras de Memoria (Total): 4\r\nLector de tarjeta memoria: Sí\r\nSoporte de Tarjeta de Memoria: Tarjeta CompactFlash (CF)\r\nSoporte de Tarjeta de Memoria: MultiMediaCard (MMC)\r\nSoporte de Tarjeta de Memoria: Micro Drive\r\nSoporte de Tarjeta de Memoria: Memory Stick PRO\r\nSoporte de Tarjeta de Memoria: Memory Stick\r\nSoporte de Tarjeta de Memoria: CF+\r\nSoporte de Tarjeta de Memoria: Tarjeta Secure Digital (SD)\r\n\r\nStorage\r\nCapcidad Total del Disco Duro: 1 TB\r\nRPM de Disco Duro: 5400\r\nTipo de Unidad Óptica: Grabadora DVD\r\nCompatibilidad de Dispositivo Óptico: DVD-RAM/±R/±RW\r\nCompatibilidad de Medios de Doble Capa: Sí', '410.00', 'ORDENA'),
	('ARCLPMP32GBN', NULL, 'Archos Clipper MP3 2GB negro', 'Características:\r\n\r\nAlmacenamiento Interno Disponible en 2 GB*\r\nCompatibilidad Windows o Mac y Linux (con soporte para almacenamiento masivo)\r\nInterfaz para ordenador USB 2.0 de alta velocidad\r\nBattería2 11 horas música\r\nReproducción Música3 MP3\r\nMedidas Dimensiones: 52mm x 27mm x 12mm, Peso: 14 Gr', '26.70', 'MP3'),
	('BRAVIA2BX400', NULL, 'Sony Bravia 32IN FULLHD KDL-32BX400', 'Características:\r\n\r\nFull HD: Vea deportes películas y juegos con magníficos detalles en alta resolución gracias a la resolución 1920x1080.\r\n\r\nHDMI®: 4 entradas (3 en la parte posterior, 1 en el lateral)\r\n\r\nUSB Media Player: Disfrute de películas, fotos y música en el televisor.\r\n\r\nSintonizador de TV HD MPEG-4 AVC integrado: olvídese del codificador y acceda a servicios de TV que incluyen canales HD con el sintonizador DVB-T y DVB-C integrado con decodificador MPEG4 AVC (dependiendo del país y sólo con operadores compatibles)\r\n\r\nSensor de luz: ajusta automáticamente el brillo según el nivel de la iluminación ambiental para que pueda disfrutar de una calidad de imagen óptima sin consumo innecesario de energía.\r\n\r\nBRAVIA Sync: controle su sistema de cine en casa o de audio y video con un solo mando a distancia\r\n\r\nEnergy Saving Switch: active el interruptor y ayude a ahorrar energía.\r\n\r\nNúmero de conexiones de HDMI®: 4\r\n\r\nNúmero de conexiones de USB 2.0: 1\r\n\r\nEntrada de PC (D-Sub): 1\r\n\r\nEntrada de video compuesto: 1\r\n\r\nEntrada de componente (Y/Pb/Pr): 1\r\n\r\nEntrada de audio: 1\r\n\r\nSalida de audio digital: 1\r\n\r\nSalida de audio: 1\r\n\r\nSalida de auriculares: 1\r\n\r\nNúmero de ranuras para tarjetas: 1\r\n\r\nControl de energía\r\nFuente de alimentación: 220 - 240 V, 50/60 Hz\r\n\r\nConsumo energético en espera: 0.19 W\r\n\r\nConsumo de energía: 102 W\r\n\r\nConsumo energético (inactivo): 0.25 W', '480.00', 'TV'),
	('CANON550D', NULL, 'Canon EOS 550D', 'La EOS 550D reúne todas las características que esperarías en una cámara réflex digital y muchas más que harán que tu fotografía creativa y de grabación de vídeos sea mucho mejor.\r\n\r\nResolución del sensor: 18 Megapíxeles\r\nTipo de sensor: CMOS\r\nTamaño del sensor: 22.3 x 14.9 mm\r\nProcesador de imagen: DIGIC 4\r\nISO (mín.): 100\r\nISO (máx.): 6.400 (H: 12.800)\r\nAutofoco: 9 puntos\r\nDisparos continuos: 3.7 fps\r\nPantalla LCD: 3 pulgadas\r\nGrabación de vídeo: Full HD\r\nTamaño: 128.8 x 97.3 x 62 mm\r\nPeso (sólo el cuerpo): 475 g', '670.00', 'CAMARA'),
	('COFFRETKEYBOARD', NULL, 'Coffret Keyboard', 'El Coffret Keyboard es un conjunto de piano con una apariencia impresionante y elegante que ofrece una experiencia de juego única. Con una estructura de alta calidad y teclas ponderadas, este teclado asegura una reproducción realista del sonido de un piano de cola. Además, viene con una variedad de funciones y sonidos incorporados que permiten a los músicos personalizar su música según sus preferencias.', '890.00', 'INSTRUM'),
	('DELLINSP14R', NULL, 'Dell Inspiron 14R', 'Características:\r\n\r\nProcesador: Intel Core i3\r\nVelocidad del procesador: 2.1 GHz\r\nNúmero de núcleos: Dual-Core\r\nTamaño de pantalla: 14 pulgadas\r\nResolución de pantalla: 1366 x 768\r\nRAM: 4 GB\r\nTamaño de disco duro: 500 GB\r\nTarjeta gráfica: Intel HD Graphics 3000\r\nSistema operativo: Windows 7 Home Premium\r\nPeso: 2.2 kg', '470.00', 'PORTAT'),
	('LUMIXTZ10', NULL, 'Panasonic Lumix TZ10', 'Características:\r\n\r\nPíxeles efectivos: 12,1 megapíxeles\r\nTipo de sensor: CCD de 1/2,33 pulgadas / 12,7 x 9,7 mm\r\nZoom óptico: 12x\r\nPantalla: LCD de 3 pulgadas\r\nEstabilizador de imagen óptico\r\nGrabación de vídeo en alta definición: 720p\r\n\r\nOtras características:\r\n\r\nGPS incorporado\r\nModo de disparo en 3D\r\nCarcasa metálica', '320.00', 'CAMARA'),
	('SAMSUNGUE40D5500', NULL, 'Samsung UE40D5500 LED TV', 'Características:\r\n\r\nFrecuencia de actualización: 100 Hz\r\nTamaño de la pantalla: 40 pulgadas\r\nResolución: 192ufx1080 píxeles\r\nRelación de aspecto: 16:9\r\nConexiones: HDMI, USB, SCART, Ethernet\r\nTecnología de retroiluminación: LED\r\nSintonizador de TV digital: DVB-C, DVB-T', '630.00', 'TV'),
	('SONYPS3SLIM', NULL, 'Sony PlayStation 3 Slim 120 GB', 'Características:\r\n\r\nDisco duro de 120 GB\r\n2x USB\r\nSalida HDMI: Sí\r\nReproducción de Blu-ray: Sí\r\nConexión a Internet: Sí\r\nProcesador Cell Broadband Engine\r\nCaché: 512 KB L2 + 256 MB\r\nRAM: 256 MB XDR Main RAM + 256 MB GDDR3 VRAM\r\nGPU: RSX 550 MHz\r\n\r\nTamaño: 290 x 65 x 290 mm\r\nPeso: 3.2 kg', '280.00', 'CONSOL'),
	('WIIREDMINI', NULL, 'Wii Remote Plus Mini', 'Características:\r\n\r\nColor: Rojo\r\nConectividad: Wireless\r\nPlataformas de juego soportadas: Nintendo Wii\r\nTecnología de control para juegos: Acelerómetro\r\nNúmero de botones: 8\r\nNúmero de botones de control remoto: 1', '35.00', 'CONSOL');
	

INSERT INTO STOCK (PRODUCTO, TIENDA, UNIDADES) VALUES 
	('3DSNG', 1, 50),
	('ACERAX3950', 1, 30),
	('ARCLPMP32GBN', 1, 100),
	('BRAVIA2BX400', 1, 20),
	('CANON550D', 1, 10),
	('ACERAX3950', 2, 40),
	('COFFRETKEYBOARD', 2, 15),
	('DELLINSP14R', 2, 25),
	('LUMIXTZ10', 2, 30),
	('SAMSUNGUE40D5500', 2, 18),
	('CANON550D', 3, 5),
	('COFFRETKEYBOARD', 3, 10),
	('DELLINSP14R', 3, 20),
	('LUMIXTZ10', 3, 15),
	('WIIREDMINI', 1, 40),
	('SONYPS3SLIM', 1, 8),
	('SONYPS3SLIM', 2, 12),
	('WIIREDMINI', 2, 25),
	('WIIREDMINI', 3, 15);



