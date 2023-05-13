
 OLYMPIC STORE


    1.-CONTEXTUALIZACIÓN

        Una aplicación web de gestión de una tienda de videojuegos donde la tienda tendrá  uno o más videojuegos a la venta con su respectiva visualización, los videojuegos pueden ser actualizados, siendo eliminados de la tienda o modificados, ya viene siendo el precio o descripción del producto.

        En la tienda tendremos clientes, los cuales podrán visualizar la  tienda de nuestra aplicación web, en ella podrán adquirir videojuegos y estos se almacenarán en la biblioteca de usuario.

        En la biblioteca de usuario se almacenarán videojuegos, cabe la posibilidad de no tener ningún videojuego dentro de ella y a la vez pudiendo tener más de un videojuego almacenada en ella, los videojuegos almacenados en la biblioteca de usuario se pueden actualizar, eliminando los videojuegos que ya no uses.

        De los usuarios queremos almacenar lo siguiente: ID del usuario , nickname, contraseña y su correo electrónico.
        De la biblioteca queremos almacenar lo siguiente: ID de biblioteca
        De los juegos queremos almacenar lo siguiente: ID del juego,  nombre del juego, la sección PEGI y una descripción de él.

    1.2.-Diagrama entidad relación

        Como podemos ver en este diseño conceptual, tenemos 4 entidades (Usuarios ,Bibliotecas, Bibliotecas_juegos y Juegos), a estas cuatro entidades le hemos añadido ciertos atributos a función de los requisitos de nuestro cliente, y a parte, algunos nuestros para poder tener una base de datos coherente.

    1.3.-Diseño lógico

        Juegos (ID_juegos , nombre, PEGI, descripcion)

        Bibliotecas (ID_biblioteca)

        Biblioteca_juegos (ID_biblioteca, ID_juego)

        ID_biblioteca es foreign key de la tabla biblioteca
        ID_juego es foreign key de la tabla videojuegos

        usuarios (ID_usuario, ID_biblioteca,  nombre, nickname)
        ID_biblioteca es foreign key de la tabla biblioteca

    1.4.-Modelo relacional

        En este modelo relacional podemos ver él método a seguir para nuestro cliente de nuestra base de datos con las tablas y las participaciones pertinentes y adecuadas para que todo sea funcional y sea upgradeable en un futuro en caso de querer expandir la base de datos y/o añadir o modificar alguna tabla. 

    2. Usuarios, privilegios y vistas


        Los usuarios pueden realizar diversas acciones, como leer datos, escribir datos, actualizar datos o eliminar datos, todo dependiendo de los privilegios que se les hayan otorgado. 

        Los privilegios pueden ser otorgados a nivel global, lo que significa que se aplican a todas las bases de datos en el sistema, o a nivel de base de datos o de tabla específica.

        En nuestro caso hemos añadido dos usuarios, uno es el usuario dependiente que sus privilegios son el poder de ver y modificar las vistas. 

        Y el segundo es el de olympicadmin que vendría siendo el usuario que tiene privilegios globales de la base de datos de olympicstore, puede insertar, modificar, eliminar, actualizar, vamos todo lo que uno pueda imaginar en la modificación de nuestra base de datos. 

        Es importante tener en cuenta que no se le pueden otorgar unos permisos muy generales a todos los usuarios ya que puede comprometer la seguridad e integridad de la misma base de datos.  

        Las vistas son representaciones virtuales de una o varias tablas que se define mediante una consulta SQL almacenada en la base de datos.

        En nuestro caso hemos almacenado dos vistas, una de administración para usuarios con el nombre de adminsitracion_usuarios y la otra para los juegos que tiene cada usuario con el nombre de juegos_usuarios. 

        En esta vista podemos observar el nombre, nickname y el identificador de usuario de la tabla usuarios, el usuario dependiente podrá verla y modificar,  eliminar o añadir según convenga. 

        En esta vista lo que podemos observar es el identificador de usuario, su nickname, el ID_juego, el nombre del juego y el PEGI. 

