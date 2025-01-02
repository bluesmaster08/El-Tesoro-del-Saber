
# El Tesoro del Saber

**El Tesoro del Saber** es un sistema web diseñado para gestionar una biblioteca mediante funcionalidades CRUD (Crear, Leer, Actualizar, Eliminar). Este proyecto está desarrollado con PHP, PDO, Bootstrap y utiliza una base de datos MySQL.

---

## Características principales

1. **Gestión de usuarios:**
   - Registro de usuarios (clientes y administradores).
   - Autenticación segura mediante cifrado de contraseñas.

2. **Gestión de pedidos:**
   - Registro de nuevos pedidos de libros.
   - Consulta, modificación y eliminación de pedidos.

3. **Interfaz amigable y responsiva:**
   - Utilización de Bootstrap para un diseño adaptable a dispositivos móviles y de escritorio.

4. **Conexión segura a la base de datos:**
   - Implementación de sentencias preparadas con PDO para evitar inyecciones SQL.

---

## Estructura del proyecto

### Archivos principales
- `index.php`: Página principal del sistema.
- `login.php`: Sistema de inicio de sesión.
- `registro.php`: Registro de usuarios.
- `consultar_pedidos.php`: Consulta de pedidos.
- `modificar_pedido.php`: Modificación de pedidos.
- `eliminar_pedido.php`: Eliminación de pedidos.

### Directorios
- **`css/`**: Archivos de estilos (Bootstrap y personalizados).
- **`js/`**: Archivos JavaScript para funcionalidades dinámicas.
- **`IMG/`**: Recursos gráficos, como íconos y logos.
- **`include/`**: Archivos de conexión y configuración de la base de datos.

---

## Requisitos previos

- Servidor web compatible con PHP (recomendado: XAMPP o WAMP).
- MySQL para la base de datos.
- Navegador web moderno.

---

## Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/bluesmaster08/El-Tesoro-del-Saber.git
   ```

2. **Configurar la base de datos:**
   - Importa el archivo `include/base_datos.sql` en tu servidor MySQL.

3. **Configurar la conexión a la base de datos:**
   - Edita `include/conn_BD.php` con las credenciales de tu base de datos.

4. **Iniciar el servidor:**
   - Coloca el proyecto en la carpeta `htdocs` (para XAMPP) o `www` (para WAMP).
   - Accede al sistema desde tu navegador: `http://localhost/El-Tesoro-del-Saber/`

---

## Tecnologías utilizadas

- **PHP**: Lenguaje de backend.
- **PDO**: Para conexiones seguras a la base de datos.
- **Bootstrap**: Diseño responsivo y estilizado.
- **MySQL**: Gestión de la base de datos.

---

## Contribuciones

Contribuciones, sugerencias y mejoras son bienvenidas. Por favor, abre un _issue_ o envía un _pull request_.

---

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

## Autor

Desarrollado por [bluesmaster08](https://github.com/bluesmaster08).
