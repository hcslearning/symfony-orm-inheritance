# symfony-orm-inheritance
Aprendiendo sobre herencia en Doctrine.

## Notas
1. Las propiedades de la Superclass deben ser "protected" y no "private"
2. La Superclass puede ser Abstract y es recomendado
3. La clase puede estar un Namespace distinto al de Entity
4. Las clases Embeddables también sirven para evitar duplicacion
5. Se puede usar el método mágico __call() para facilitar las llamadas a la clase embebida

## Requerimientos
1. Un cliente puede tener registradas muchas direcciones (direccion, numero, comuna)
2. El cliente puede cambiar sus datos: rut, nombre, apellido, telefono
3. Al realizar un pedido
