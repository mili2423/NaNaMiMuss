// Clase para definir productos. obj, prop, met
class Producto {
  //molde o plantilla para crear varios objetos con las mismas propiedades
  constructor( //ejecuta automáticamente
    id,
    nombre,
    precio,
    imagenes,
    categoria,
    descripcion,
    especificaciones,
    subcategoria, //se le asigna
    opcion
  ) {
    this.id = id;
    this.nombre = nombre;
    this.precio = precio;
    this.imagenes = imagenes; // Array de imágenes
    this.categoria = categoria;
    this.descripcion = descripcion;
    this.especificaciones = especificaciones;
    this.subcategoria = subcategoria; // Array de strings
    this.opcion = opcion;
  }
}

// Lista de productos+
//er utilizado en otros módulos o archivos del programa
export const productos = [
  //
  new Producto(
    1,
    "Vestido de Fiesta verde esmeralda",
    85000,
    [
      "NanaMimus/trajes/vestidoverde2.jpg",
      "NanaMimus/trajes/vestidoverde.jpg",
      "NanaMimus/trajes/vestido5.jpg",
    ],
    "Trajes",
    "Vestido elegante verde esmeralda con detalles de encaje.",

    ["Talle: S, M, L", "Color: Verde esmeralda", "Material: Satén"]
  ),
  new Producto(
    2,
    "Ramo de Rosas Tejidas",
    7000,
    [
      "NanaMimus/flores/rosa3_azul.jpg",
      "NanaMimus/flores/flore1_rojo.jpg",
      "NanaMimus/flores/flore3_violeta.jpg",
    ],
    "Flores",
    "Ramo tejido a mano en lana de alta calidad. Ramo de 3 flores.",
    ["Altura: 25cm", "Hecho a mano"],
    "Flores ",
    ["Azul", "Rojo", "Violeta"]
  ),
  new Producto(
    3,
    "Margaritas de colores tejida",
    6000,
    ["NanaMimus/flores/mar5.jpg"],
    "Flores",
    "Margaritas tejido a mano en lana de alta calidad.",
    [
      "Altura: 25cm",
      "Hecho a mano",
      "Colores disponibles: Azul, Violeta, Rojo, Blanco, Rosa",
    ],
    "Flores ",
    ["Rojo", "Verde", "Azul"]
  ),

  new Producto(
    4,
    "Llavero de Girasol tejido",
    4000,
    [
      "NanaMimus/flores/gi2.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Flores",
    "LLavero tejido a mano en lana de alta calidad.",
    ["Altura: 14cm", "Hecho a mano", "Colores disponibles: Amarillo"]
  ),
  new Producto(
    5,
    "Babero de tela de toalla",
    15000,
    [
      "NanaMimus/bebe/bb.jpeg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Bebes",
    "Ramo tejido a mano en lana de alta calidad.",
    [
      "Altura: 25cm",
      "Hecho a mano",
    ],  "Bebe ",
    ["Flores", "Pajarito", "Negro","Animalitos"]
  ),
  new Producto(
    6,
    "Conjunto de Jardinero con un body",
    18000,
    [
      "NanaMimus/bebe/b.jpeg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Bebes",
    "Ramo tejido a mano en lana de alta calidad.",
    [
      "Altura: 25cm",
      "Hecho a mano",
      "Colores disponibles: Rojo, Blanco, Amarillo",
    ]
  ),
  new Producto(
    7,
    "Moño a Cuadros",
    4000,
    [
      "NanaMimus/moños/m1.jpg",
      // "NanaMimus/moños/m2.jpg",
      // "NanaMimus/moños/m3.jpg",
    ],
    "Accesorio",
    "Moños Grandes a Cuadros.",
    [
      "Altura: 15cm",
      "Hecho a mano",
     
    ]    ,  "mono ",
    ["Azul", "Rojo", "Negro","Naranja","Rosa", "Cremita"]
  ),
  new Producto(
    8,
    "Disfraz de Minnie Mouse",
    18000,
    [
      "NanaMimus/disfraz/d3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz para niños. Medidas al privado",
    ["Talle: 1 maximo", "Hecho a mano"]
  ),
  new Producto(
    9,
    "Vestido de fiesta azul",
    45000,
    [
      "NanaMimus/trajes/ve4.jpg",
      "NanaMimus/trajes/vestidoazul1.jpg",
      "NanaMimus/trajes/vestido7.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta azul. Confeccionamos todos los talles",
    ["Talle: S, M, L", "Color: Azul intenso", "Material: Satén"]
  ),
  new Producto(
    10,
    "Tulipan en Maseta",
    6000,
    [
      "NanaMimus/flores/tuli_rojo.jpg",
      "NanaMimus/flores/tuli_rosa.PNG",
      "NanaMimus/flores/tuli_cremita.jpg",
      "NanaMimus/flores/tuli_amarillo.jpg",
      "NanaMimus/flores/tuli_violeta.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Flores",
    "Tulipan en maceta tejido a mano en lana de alta calidad.",
    ["Altura: 15cm", "Hecho a mano"],
    "Flores",
    ["Rojo", "Rosa", "Cremita", "Amarillo", "Violeta"]
  ),
  new Producto(
    11,
    "Ramo de Tulipanes",
    9000,
    [
      "NanaMimus/flores/tuli2_amarillo.jpg",
      "NanaMimus/flores/flore6_rosa.jpg",
      "NanaMimus/flores/flore5_violeta.jpg",
    ],
    "Flores",
    "Ramo de tulipan tejido a mano en lana de alta calidad. Ramo de 3 Tulipanes.",
    ["Altura: 25cm", "Hecho a mano"],
    "Flores",
    ["Amarillo", "Rosa", "Violeta"]
  ),
  new Producto(
    12,
    "Vestido de fiesta Negro",
    39000,
    [
      "NanaMimus/trajes/vestidonegro.jpg",
      "NanaMimus/trajes/vestido8.jpg",
      "NanaMimus/trajes/vestidonegro2.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Negro. Estilo strapless",
    ["Talle: S, M, L", "Color: Negro intenso", "Material: Satén"]
  ),
  // new Producto(
  //   13,
  //   "Margarita Tejida",
  //   10000,
  //   ["NanaMimus/flores/mar.jpg", "NanaMimus/flores/flore7.jpg"],
  //   "Flores",
  //   "Ramo de Margarita tejido a mano en lana de alta calidad. Ramo de 3 Margaritas.",
  //   ["Altura: 20cm", "Hecho a mano", "Colores disponibles: Blanco"]
  // ),
  new Producto(
    14,
    "Ramo de Rosas",
    14000,
    [
      "NanaMimus/flores/rosa_amarillo.jpg",
      "NanaMimus/flores/ramo1_rosa.jpg",
      "NanaMimus/flores/ramo_azul.jpg",
    ],
    "Flores",
    "Ramo tejido a mano en lana de alta calidad. Ramo de 3 flores.",
    ["Altura: 25cm", "Hecho a mano"],
    "Flores",
    ["Amarillo", "Rosa", "Azul"]

    // "Margaritas"
  ),
  new Producto(
    15,
    "Ramo de Lavanda",
    11000,
    ["NanaMimus/flores/la.jpg", "NanaMimus/flores/flore9.jpg"],
    "Flores",
    "Ramo tejido a mano en lana de alta calidad. Ramo de 8 lavandas.",
    ["Altura: 25cm", "Hecho a mano", "Colores disponibles: Rosa y Violeta"]
  ),
  new Producto(
    16,
    "Babero",
    10000,
    [
      "NanaMimus/bebe/WhatsApp Image 2025-03-14 at 11.38.09 AM (1).jpeg",
    ],
    "Bebes",
    "Babero de tela de toalla",
    ["Altura: 25cm", "Hecho a mano", "Consultar diseños"],
      "Flores ",
    ["Autos", "Animales", "Raton"]
  ),
  new Producto(
    17,
    "Saquito de Lana",
    14000,
    [
      "NanaMimus/bebe/bebebe.jpeg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Bebes",
    "Ramo tejido a mano en lana de alta calidad.",
    [
      "Altura: 25cm",
      "Hecho a mano",
      "Colores disponibles: Rojo, Blanco, Amarillo",
    ]
  ),
  new Producto(
    18,
    "Vestido de fiesta rojo",
    55000,
    [
      "NanaMimus/trajes/vestido10.jpg",
      "NanaMimus/trajes/vestido11.jpg",
      "NanaMimus/trajes/vestido12.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Rojo, con tirantes y tajo em la pierna. ",
    ["Talle: S, M, L", "Color: Rojo", "Material: Satén"]
  ),
  new Producto(
    19,
    "Vestido de fiesta Violeta",
    36000,
    [
      "NanaMimus/trajes/vestido27.jpg",
      "NanaMimus/trajes/vestido28.jpg",
      "NanaMimus/trajes/vestido26.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Violeta, con escote en V.",
    ["Talle: S, M, L", "Color: Violeta", "Material: Satén"]
  ),
  new Producto(
    20,
    "Vestido de fiesta dorado",
    48000,
    [
      "NanaMimus/trajes/vestido13.jpg",
      "NanaMimus/trajes/vestido14.jpg",
      "NanaMimus/trajes/vestido19.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Dorado, con distintos estilos.",
    ["Talle: S, M, L", "Color: Violeta", "Material: Satén"]
  ),
  new Producto(
    21,
    "Vestido de fiesta rosa",
    25000,
    [
      "NanaMimus/trajes/vestido20.jpg",
      "NanaMimus/trajes/vestido21.jpg",
      "NanaMimus/trajes/vestido22.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Rosa, con falda larga.",
    ["Talle: S, M, L", "Color: Rosa claro", "Material: Satén"]
  ),
  new Producto(
    22,
    "Vestido de fiesta plateado",
    30000,
    [
      "NanaMimus/trajes/vestido23.jpg",
      "NanaMimus/trajes/vestido24.jpg",
      "NanaMimus/trajes/vestido25.jpg",
    ],
    "Trajes",
    "Vestido elegante de fiesta Plateado, con escote en V.",
    ["Talle: S, M, L", "Color: Plateado", "Material: Satén"]
  ),
  new Producto(
    23,
    "Saquito y Jardieno",
    18000,
    [
      "NanaMimus/bebe/bebe1_saquito.jpg",
      "NanaMimus/bebe/bebe2.jpg",
    ],
    "Bebes",
    "tejido a mano.",
    [
      "Altura: 80cm maximo",
      "Hecho a mano",
    ],
      "Trajes ",
    ["Saquito con jardinero de oso", "Camperita con jardinero "]
  ),

  new Producto(
    24,
    "Moño Grande",
    7000,
    [
      "NanaMimus/moños/m2.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Accesorio",
    "Moño liso  ",
    ["Altura: 20cm", "Hecho a mano", ],
      "mono ",
    ["Rojo","Rosa"]
   
  ),
  new Producto(
    30,
    "Turbante",
    7000,
    [
      "NanaMimus/moños/m3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Accesorio",
    "Con Moño blanco con perlitas. Medidas al privado ",
    ["Altura: 40cm Maximo", "Hecho a mano", "Colores disponibles: Rosa"]
  ),
  new Producto(
    31,
    "Moños pequeños",
    3000,
    [
      "NanaMimus/moños/mono2.jpg",
    ],
    "Accesorio",
    "Moños pequeños de gomita. Paquete de 5 ",
    ["Altura: 10cm", "Hecho a mano", ],
      "mono ",
    ["Rosa", "Rojo", "Plateado"]
  ),
  new Producto(
    32,
    "Vincha de Moños",
    7000,
    [
      "NanaMimus/moños/mono3.jpg",
      "NanaMimus/moños/mono4.jpg",
      "NanaMimus/moños/mono5.jpg",
    ],
    "Accesorio",
    "vincha con moño pequeño",
    [
      "Altura: 10cm",
      "Hecho a mano", ] ,
        "mono ",
    ["Azul", "Celeste y Blanco", "Rojo"]
  
  ),

  new Producto(
    34,
    "Disfraz de Piter Pan",
    13000,
    [
      "NanaMimus/disfraz/d6.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz de niño. Talle al privado",
    ["Talle: 1 max", "Hecho a mano"]
  ),
  new Producto(
    35,
    "Disfraz Olaf",
    14000,
    [
      "NanaMimus/disfraz/d2.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz solo para niños. Talles al privado",
    ["Talle: 1 max", "Hecho a mano"]
  ),
  new Producto(
    36,
    "Disfraz de Mimo",
    10000,
    [
      "NanaMimus/disfraz/ddd.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz de niño. Talles al privado",
    ["Altura: 1 max", "Hecho a mano"]
  ),
  new Producto(
    37,
    "Disfraz de Super Man",
    18000,
    [
      "NanaMimus/disfraz/d7.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz de niño. Talles al privado",
    ["Talle: 1 max", "Hecho a mano"]
  ),
  new Producto(
    38,
    "Disfraz de Pirata",
    15000,
    [
      "NanaMimus/disfraz/d8.jpg",
      // "NanaMimus/flores/rosa3.jpg",
      // "NanaMimus/flores/rosa3.jpg",
    ],
    "Disfraz",
    "Disfraz de niño. Talles al privado",
    ["Altura: 1 max", "Hecho a mano"]
  ),

  new Producto(
    40,
    "Traje elegante",
    30000,
    [
      "NanaMimus/trajes/traje1.jpg",
      "NanaMimus/trajes/traje2.jpg",
      "NanaMimus/trajes/traje3.jpg",
    ],
    "Trajes",
    "Traje elegante, con distintos estilos.",
    ["Talle: S, M, L", "Color: azul", "Material: Satén"]
  ),
];
window.productos = productos;
