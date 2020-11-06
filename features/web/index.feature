# language: es
Característica: Pagina principal
  Para poder ver la pagina principal
  Como cualquier usuario no logead
  Tengo que ser capaz de entrar a la home de la pagina

  Escenario: Puedo entrar a la home de la aplicacion
    Dado estoy en la página de inicio
    Entonces debo ver "Bienvenidos"
    
  Escenario: Estoy en la home y veo un menu
    Dado voy a la página de inicio
    Entonces debo ver "Inicio"
    Y debo ver "Listado de pedidos"
    Y debo ver "Listado de cursos"
  
  Escenario: Estoy en la home y veo un menu
    Dado sigo "Listado de pedidos"
    Entonces debo ver "Email"
    Y debo ver "Descripción"
    Y debo ver "Activo"
  
  Escenario: Estoy en la home y veo un menu
    Dado sigo "Listado de cursos"
    Entonces debo ver "Nombre"
    Y debo ver "Descripción"
    Y debo ver "Duración"
    Y debo ver "Editar"

  Escenario: Estoy en la home y veo un menu
    Dado sigo "Agregar Pedido"
    Entonces debo ver un elemento "form"
    Y debo ver "Email"
    Y debo ver "Descripcion"
    Y debo ver "Activo"

  Escenario: Estoy en la home y veo un menu
    Dado sigo "Agregar Curso"
    Entonces debo ver un elemento "form"
    Y debo ver "Descripcion"
    Y debo ver "Duracion"
    Y debo ver "Nombre"
  
  Escenario: Estoy en agregar pedido y relleno el formulario
    Dado estoy en "/pedidos/add"
    Cuando relleno "email" con "pepito@gmail.com"
    Y relleno "texto" con "Among us"
    Y marco "activo"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"
    Y voy a "/pedidos/"
    Y debo ver "pepito@gmail.com"
    Y debo ver "Among us"
    Y debo ver "1" 

  Escenario: Estoy en agregar curso y relleno el formulario
    Dado estoy en "/cursos/add"
    Cuando relleno "nombre" con "Among Us"
    Y relleno "descripcion" con "Quiero ser el traidor"
    Y relleno "duracion" con "el tiempo que sea necesario"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"
    Y voy a "/cursos/"
    Y debo ver "Among Us"
    Y debo ver "Quiero ser el traidor"
    Y debo ver "el tiempo que sea necesario"

  Escenario: Puedo ver el menu
    Dado estoy en la página de inicio
    Entonces debo ver "Listado de cursos"
    Y debo ver "Listado de pedidos"
 
  Escenario: Puedo ir al listado de pedidos
    Dado estoy en la página de inicio
    Cuando sigo "Listado de pedidos"
    Entonces debo ver "Email"
    Y debo ver "Descripción"
    Y debo ver "Activo"
 
  Escenario: Puedo ver el formulario de pedido
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Pedido"
    Entonces debo ver "Email"
    Y debo ver "Descripcion"
    Y debo ver "Activo"
 
  Escenario: Puedo registrar y ver un pedido
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Pedido"
    Y relleno "email" con "uno@uno.com"
    Y relleno "texto" con "among us"
    Y marco "activo"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"
    Y sigo "Volver al listado"
    Y debo ver "uno@uno.com"
    Y debo ver "among us"
 
  Escenario: Puedo ir al listado de cursos
    Dado estoy en la página de inicio
    Cuando sigo "Listado de cursos"
    Entonces debo ver "Nombre"
    Y debo ver "Descripción"
    Y debo ver "Duración"
    Y debo ver "Editar"
 
  Escenario: Puedo ver el formulario de curso
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Curso"
    Entonces debo ver "Descripcion"
    Y debo ver "Duracion"
 
  Escenario: Puedo registrar y ver un curso
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Curso"
    Y relleno "nombre" con "Curso"
    Y relleno "descripcion" con "una descripcion"
    Y relleno "duracion" con "3h"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"
    Y sigo "Volver al listado"
    Y debo ver "Curso"
    Y debo ver "una descripcion"
    Y debo ver "3h"
 
  Escenario: Puedo editar un curso agregado
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Curso"
    Y relleno "nombre" con "Curso"
    Y relleno "descripcion" con "una descripcion"
    Y relleno "duracion" con "3h"
    Y presiono "Registrar"
    Y sigo "Volver al listado"
    Y sigo "Editar"
    Y relleno "nombre" con "Curso 2"
    Y relleno "descripcion" con "una descripcion 2"
    Y relleno "duracion" con "3h +2h"
    Y presiono "Actualizar"
    Entonces debo ver "Todo editado okaaa"
    Y sigo "Volver al listado"
    Y debo ver "Curso 2"
    Y debo ver "una descripcion 2"
    Y debo ver "3h +2h"

Escenario: Puedo ver el link del listado de pedidos
    Dado estoy en la página de inicio
    Entonces el elemento "#menu-pedidos" debe contener "Listado de pedidos"
 
  Escenario: Puedo ver el listado de pedidos
    Dado estoy en la página de inicio
    Cuando sigo "menu-pedidos"
    Entonces el elemento "thead" debe contener "Email"
    Y el elemento "thead" debe contener "Descripción"
    Y el elemento "thead" debe contener "Activo"
 
  Escenario: Puedo ver el link de agregar un pedido
    Dado estoy en la página de inicio
    Entonces el elemento "#agregar-pedido" debe contener "Agregar"
 
  Escenario: Puedo ver formulario de agregar pedido
    Dado estoy en la página de inicio
    Cuando sigo "agregar-pedido"
    Entonces el elemento "form" debe contener "Email"
    Y el elemento "form" debe contener "Descripcion"
    Y el elemento "form" debe contener "Activo"
 
  Escenario: Rellenar el formulario de agregar pedido
    Dado estoy en "/pedidos/add"
    Cuando relleno con "holaaa@holaaa.com" a "email"
    Y relleno con "saludos xd" a "texto"
    Y marco "activo"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"
 
  Escenario: Puedo ver el link del listado de cursos
    Dado estoy en la página de inicio
    Entonces el elemento "#menu-cursos" debe contener "Listado de cursos"
 
  Escenario: Puedo ver el listado de cursos
    Dado estoy en la página de inicio
    Cuando sigo "menu-cursos"
    Entonces el elemento "thead" debe contener "Nombre"
    Y el elemento "thead" debe contener "Descripción"
    Y el elemento "thead" debe contener "Duración"
    Y el elemento "thead" debe contener "Editar"
 
  Escenario: Puedo ver el link de agregar un curso
    Dado estoy en la página de inicio
    Entonces el elemento "#agregar-curso" debe contener "Agregar"
 
  Escenario: Puedo ver formulario de agregar curso
    Dado estoy en la página de inicio
    Cuando sigo "agregar-curso"
    Entonces el elemento "form" debe contener "Nombre"
    Y el elemento "form" debe contener "Descripcion"
    Y el elemento "form" debe contener "Duracion"
 
 
  Escenario: Rellenar el formulario de agregar curso
    Dado estoy en "/cursos/add"
    Cuando relleno con "jasinto" a "nombre"
    Y relleno con "saludos xd" a "descripcion"
    Y relleno con "2hs" a "duracion"
    Y presiono "Registrar"
    Entonces debo ver "Todo okaaa"