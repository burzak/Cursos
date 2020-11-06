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