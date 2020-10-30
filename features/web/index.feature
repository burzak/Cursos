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

  Escenario: Estoy en la home y puedo darle click al menu de cursos
    Dado estoy en la página de inicio
    Cuando sigo "menu-cursos"
    Entonces debo ver "Listado de cursos"
    Y debo ver "Id Curso"
    Y debo ver "Nombre"
    Y debo ver "Descripción"
    Y debo ver "Agregar"

  Escenario: Puedo ver el formulario para crear cursos
    Dado estoy en "/cursos"
    Cuando sigo "Agregar"
    Entonces debo ver "Formulario de curso"
    Y debo ver "Nombre"
    Y debo ver "Descripción"
    Y debo ver un elemento "form > input[value=Continuar]"
    Y debo ver "Volver a listado"

  Escenario: Puedo crear un curso
    Dado estoy en "/cursos"
    Y sigo "Agregar"
    Cuando relleno "name" con "curso desde behat"
    Y relleno "description" con "descripcion desde behat"
    Y presiono "Continuar"
    Entonces debo ver "Todo joya!"
    Y debo ver "Volver a listado"
    Y debo ver "curso desde behat"
    Y debo ver "descripcion desde behat"