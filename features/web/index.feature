# language: es
Característica: Pagina principal
  Para poder ver la pagina principal
  Como cualquier usuario no logead
  Tengo que ser capaz de entrar a la home de la pagina

  Escenario: Puedo entrar a la home de la aplicacion
    Dado estoy en la página de inicio
    Entonces debo ver "Bienvenidos a cursos"
  
  Escenario: Entro al home y puedo ver el menu con los links
    Dado estoy en la página de inicio
    Entonces debo ver "Listado de cursos" en el elemento "#menu-cursos"
    Y debo ver "Agregar pedido" en el elemento "#agregar-pedido"
    Y debo ver "Listado de pedidos" en el elemento "#menu-pedidos"
    Y debo ver "Agregar Curso" en el elemento "#agregar-curso"

  Escenario: Entro al link Listado de pedidos
    Dado estoy en la página de inicio 
    Cuando sigo "Listado de pedidos" 
    Entonces debo ver "Bienvenidos a pedidos"

  Escenario: Entro al link Agregar Pedido
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Pedido"
    Entonces debo ver "formulario de pedidos"
  
  Escenario: Entro al link Listado de cursos
    Dado estoy en la página de inicio
    Cuando sigo "Listado de cursos"
    Entonces debo ver "Nombre"
  
  Escenario: Entro al link Agregar Curso
    Dado estoy en la página de inicio
    Cuando sigo "Agregar Curso"
    Entonces debo ver "Nombre" 
    Y debo ver un elemento "#content > form > input[type=text]:nth-child(2)"


    



