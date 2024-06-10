DROP DATABASE IF EXISTS `misrecetas`;

CREATE DATABASE misrecetas;

USE misrecetas;

CREATE TABLE `recetas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tipo` enum(
        'Plato principal',
        'Entrante',
        'Postre'
    ) NOT NULL,
    `nombre` varchar(255) NOT NULL,
    `fecha_creacion` date NOT NULL,
    `imagen` varchar(255) DEFAULT NULL,
    `dificultad` enum(
        'No se ha especificado la dificultad',
        'Muy fácil',
        'Fácil',
        'Normal',
        'Difícil',
        'Muy difícil'
    ) NOT NULL,
    `explicacion` text DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `recetas` (
        `id`,
        `tipo`,
        `nombre`,
        `fecha_creacion`,
        `imagen`,
        `dificultad`,
        `explicacion`
    )
VALUES (
        1,
        'Plato principal',
        'Crema de zanahoria y mango con brocheta de langostinos',
        '2024-06-10',
        'crema_de_zanahoria_y_mango_con_brocheta_de_langostinos_101444ec_1200x1200.jpg',
        'Fácil',
        'Ingredientes:\r\n\r\n1 manojo de zanahorias 1 kg, aproximadamente\r\n2 mangos maduros\r\n1 penca de apio\r\n12 langostinos\r\nTallos de cebollino\r\nAceite de oliva\r\nPimienta blanca molida\r\nSal\r\n\r\n1. Prepara las verduras y la fruta\r\nRaspa las zanahorias y lávalas; reserva una y trocea las demás. Pela los dos mangos y retírales el hueso; reserva medio y trocea el resto.\r\n\r\n2. Cuece las zanahorias\r\nLimpia la penca de apio, eliminando las hebras, lávala y trocéala. Pasa el apio a una cazuela, con los trozos de zanahoria, cúbrelos con agua y cuécelos hasta que las verduras estén tiernas.\r\n\r\n3. Corta en cubitos\r\nCorta el medio mango y la zanahoria reservados en cubitos del mismo tamaño, para decorar la sopa al final, y déjalos en la nevera.\r\n\r\n4. Dora los langostinos\r\nPela los langostinos, insértalos en brochetas, de 3 en 3 y ásalos en una plancha caliente untada con aceite. Salpimienta.\r\n\r\n5. Tritura las verduras\r\nEscurre las hortalizas cuando se templen y reserva su agua. Luego, tritúralas, junto con el mango troceado, mientras vas añadiendo agua hasta que la sopa tenga la textura deseada. Salpimienta y reserva en la nevera.\r\n\r\n6. Emplata y sirve\r\nReparte la sopa fría en cuencos y añade los dados de zanahoria y mango reservados. Decora con el cebollino, lavado y picado, y un hilo de aceite, y coloca encima las brochetas de langostino.'
    ),
    (
        2,
        'Postre',
        'Tarta de chocolate con cerezas y avellanas',
        '2024-06-10',
        'tarta-de-avellanas-y-cerezas_00000000_240531101744_1200x1200.jpg',
        'Normal',
        'Ingredientes\r\n\r\n80 gramos de chocolate negro\r\n100 gramos de mantequilla\r\n70 gramos de azúcar\r\n3 huevos\r\n1 yema de huevo\r\n250 gramos de cerezas\r\n50 gramos de avellanas\r\n70 gramos de harina\r\n4 gramos de levadura en polvo\r\n140 gramos de chocolate en perlas\r\n200 gramos de mermelada de frambuesa\r\n\r\n1. Tritura las cerezas\r\nLavar las cerezas, retirarles los rabitos y los huesos, y triturarlas. Repelar las avellanas y triturarlas también.\r\n\r\n2. Funde el chocolate\r\nTrocear el chocolate y derretirlo al baño maría. Agregarle la mantequilla fundida y el azúcar, y mezclar con varillas. Incorporar  los huevos, de uno en uno, y la yema, sin dejar de remover.\r\n\r\n2. Funde el chocolate\r\n3. Remueve la mezcla\r\nAñadir las cerezas y las avellanas trituradas, la harina y la levadura, y seguir removiendo hasta que la mezcla sea homogénea. Reservar 15 minutos en la nevera.\r\n\r\n4. Hornea con las perlas de chocolate\r\nPrecalentar el horno a 180º. Verter la masa en un molde, repartir por encima las perlas de chocolate, hornear 45 minutos y dejar enfriar.\r\n\r\n5. Decora la tarta\r\nLlevar la nata a ebullición. Fundir el chocolate al baño maría, mezclarlo con la nata y dejar enfriar. Cortar el bizcocho por la mitad, rellenarlo con la mermelada templada y cubrirlo con casi toda la crema anterior. Adornarlo con las cerezas lavadas y ligeramente bañadas en chocolate.'
    ),
    (
        3,
        'Plato principal',
        'Huevos al plato con verduras y jamón',
        '2022-07-21',
        'huevos-al-plato-con-verduras_27d46316_800x800.jpg',
        'Muy fácil',
        'Ingredientes\r\n\r\n4 huevos\r\n2 pimientos rojos\r\n150 gramos de judías verdes\r\n2 cebollas\r\n1 diente de ajo\r\n8 lonchas de jamón serrano\r\n50 mililitros de caldo de verduras\r\nAceite de oliva\r\nPimentón\r\nSal\r\nPimienta\r\n\r\n1. Asa y pela los pimientos\r\nLimpia los pimientos, lávalos y ásalos 50 minutos en el horno precalentado a 200º. Tápalos, deja que se templen y retírales la piel y las semillas. Córtalos en tiras, reservando los jugos que suelten. \r\n\r\n1. Asa y pela los pimientos\r\n2. Cuece las judías\r\nLava y despunta las judías. Trocéalas, cuécelas al vapor 8 minutos (deben quedar un poco al dente) y escúrrelas.\r\n\r\n2. Cuece las judías\r\n3. Rehoga la cebolla\r\nPela la cebolla y el ajo y pícalos. Rehoga la primera 10 minutos en 3 cucharadas de aceite. Añade el ajo, rehoga 2 minutos y agrega las judías, el pimiento con sus jugos de cocción y el caldo. Cuece 5 minutos y salpimienta.\r\n\r\n4. Casca un huevo y hornea\r\nReparte el jamón en cazuelitas refractarias, añade el sofrito y casca 1 huevo en el centro. Salpimienta, espolvorea con pimentón y hornea 10 minutos a 180º, hasta que las claras se cuajen y las yemas queden líquidas.'
    ),
    (
        4,
        'Entrante',
        'Calamares rellenos con salsa a la sidra',
        '2024-02-05',
        'paso_a_paso_para_hacer_calamares_con_salsa_a_la_sidra_resultado_final_5f3c8b15_1200x1200.jpg',
        'Difícil',
        'Ingredientes\r\n\r\n12 calamares medianos\r\n1 cebolla\r\n200 gramos de carne picada de cerdo\r\n1 manzana amarilla o verde\r\n1 huevo\r\n1 ramita de perejil\r\n100 gramos de harina\r\n1 pimiento verde italiano\r\n200 mililitros de tomate triturado\r\n200 mililitros de sidra\r\nTallos de cebollino\r\nSal\r\nPimienta\r\nAceite de oliva\r\n\r\n1. Prepara el relleno\r\nLimpia los calamares, retirándoles la pluma, los ojos, las vísceras y el pico. Luego, lávalos con agua fría, por dentro y por fuera, y escúrrelos. A continuación, separa de los cuerpos los tentáculos y las aletas, y pícalos. Pela la cebolla y los ajos, y pícalos también, muy menudos.\r\n\r\n2. Sofríe los tentáculos y las aletas\r\nColoca una sartén con un fondo de aceite en el fuego y caliéntala. Añade los tentáculos y las aletas de los calamares, y sofríelos unos minutos. Agrega entonces la mitad del ajo y de la cebolla, y rehógalos, removiendo, hasta que la cebolla esté transparente.\r\n\r\n3. Mezclalos con la carne picada\r\nLava la manzana, sécala y corta la pulpa en daditos. Luego, mézclalos, en un cuenco, con la carne, el huevo y el perejil, lavado y picado. Añade el sofrito anterior y remueve hasta integrarlo. Riega todo con un hilo de aceite, salpimienta y mezcla bien.\r\n\r\n4. Rellena los calamares\r\nIntroduce esta masa en una manga pastelera con boquilla ancha y lisa, y rellena los calamares, sin llegar hasta el borde.\r\n\r\n5. Enharínalos y fríelos\r\nCierra las aberturas de los calamares con palillos, para que no se salga el relleno, y enharínalos. Luego, fríelos en una sartén con abundante aceite, hasta que se doren por todos lados, y déjalos escurrir sobre papel de cocina.\r\n\r\n6. Elabora la salsa\r\nLimpia el pimiento, lávalo, pícalo y rehógalo en una sartén con aceite, junto con el ajo y la cebolla restantes. Pasados 5 minutos, añade el tomate triturado y los calamares, y deja reducir hasta la mitad. Vierte la sidra y cocina 30 minutos a fuego suave. Rectifica de sal.\r\n\r\n7. Sirve los calamares\r\nRetira los palillos a los calamares rellenos y sírvelos con la salsa y los tallos de cebollino, lavados y secos.'
    ),
    (
        5,
        'Plato principal',
        'Lasaña de secreto ibérico con queso',
        '2024-03-14',
        'lasana-de-secreto-iberico-con-queso_00000000_231027122807_1200x1200.jpg',
        'Muy difícil',
        'Ingredientes\r\n\r\n2 secretos de cerdo ibérico\r\n4 chalotas\r\n80 gramos de frutos secos variados\r\n100 gramos de queso en lonchas\r\n2 manzanas\r\n20 gramos de azúcar\r\n1 vaso de caldo\r\n½ vasito de licor de bellota\r\nAceite\r\nSal\r\n\r\n1. Carameliza los frutos secos\r\nPela los frutos secos y pícalos. Limpia la chalota y pícala también muy fina. Sofríela en una sartén con un fondo de aceite hasta que esté blandita. Incorpora los frutos secos y, cuando se doren, agrega el azúcar y deja caramelizar. Añade el licor y el caldo caliente, sazona y deja reducir.\r\n\r\n2. Descorazona la manzana\r\nLava las manzanas y sécalas con papel de cocina. Descorazónalas, pártelas por la mitad y córtalas en láminas finas. Dóralas en una sartén con unas gotas de aceite y retíralas.\r\n\r\n3. Dora la carne\r\nLimpia el secreto de cerdo y dóralo también en una plancha engrasada con aceite un par de minutos por ambos lados.\r\n\r\n4. Monta la lasaña\r\nCorta luego los secretos en filetes del mismo tamaño. Monta la lasaña alternando la carne con una capa de manzana y otra de queso y terminando con una de carne. Repártelas en los platos y sírvelas enseguida, bien calientes y regadas con la salsa de frutos secos y licor de bellota preparada.'
    ),
    (
        6,
        'Entrante',
        'Pasta en nidos con anchoas, tomate, aceitunas y alcaparras',
        '2024-06-10',
        'nidos-de-cintas-con-anchoas_00000000_240529152235_1200x1200.jpg',
        'Normal',
        'Ingredientes\r\n\r\n400 gramos de cintas de pasta\r\n2 dientes de ajo\r\n1 cayena\r\n150 gramos de aceitunas negras deshuesadas\r\n12 anchoas\r\n2 cucharaditas de alcaparras\r\n500 gramos de tomates\r\n1 ramita de tomillo\r\nAceite de oliva\r\nSal\r\n\r\n1. Escalda el tomate\r\nLavar los tomates, hacerles dos cortes en forma de cruz en la base y escaldarlos 1 minuto en agua salada. Escurrirlos y refrescarlos con agua fría. Pelarlos y cortarlos en dados.\r\n\r\n2. Haz la salsa en el mortero\r\nPelar los ajos y picarlos. Enjuagar las aceitunas y las alcaparras, y escurrirlas; cortar las primeras en aros. Escurrir también las anchoas de su aceite; reservar la mitad enteras y trocear las demás. Disponer estas en el mortero, con los ajos, y machacar los dos.\r\n\r\n3. Cocina el majado\r\nCalentar 3 cucharadas de aceite en una cazuela. Incorporar el majado anterior y sofreírlo 1 minuto. Añadir las aceitunas, las alcaparras y la cayena lavada, remover y rehogar 1 minuto. Incorporar el tomate, cocer 15 minutos a fuego suave y ajustar el punto de sal.\r\n\r\n4. Cuece la pasta\r\nCocer la pasta en agua salada el tiempo indicado en el envase para que quede al dente y escurrirla.\r\n\r\n5. Forma los nidos\r\nDistribuirla en platos, formando nidos, y repartir por encima la salsa. Decorar con las anchoas reservadas y el tomillo lavado y picado, y servir.'
    );

CREATE TABLE usuarios (
    email VARCHAR(255) PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);