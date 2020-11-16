# language: es
Característica: Agregar Pedido
  Para poder agregar un pedido 
  Como cualquier usuario no logead
  Tengo que ser capaz de rellenar el formulario

  Escenario: Registrando Pedido
    Dado estoy en "/pedidos/create"
    Y relleno "email" con "nicolas@algo"
    Y relleno "texto" con "tdd"
    Cuando presiono "registrar"
    Entonces debo ver "Thank you por registrar este request"