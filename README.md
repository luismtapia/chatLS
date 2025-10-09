# Chat Lince Space

_Descripción General del Proyecto_

Chat Lince Space es una aplicación web dinámica desarrollada para facilitar la interacción y gestión de usuarios en un entorno privado. Funciona como un sistema de gestión de usuarios y comunidad, con una fuerte orientación hacia la seguridad, roles y privilegios, es una plataforma donde los usuarios pueden interactuar, acceder a funcionalidades específicas basadas en su nivel de permiso y mantener un perfil personal.
Este proyecto utiliza una arquitectura de desarrollo Full-Stack (backend y frontend) con PHP como núcleo principal.

## 🛠️ Tecnologías y Entorno de Desarrollo


| Componente | Tecnología | Rol Principal en el Proyecto | Archivos/Módulos Relacionados |
| :--- | :--- | :--- | :--- |
| **Backend** (Lógica Servidor) | **PHP** | Lógica de negocio, procesamiento de datos, gestión de sesiones y seguridad. | `seguridad.php`, `administrador.php`, `log_in.php`, **Todos** los archivos `.php` |
| **Gestión de Dependencias** | **Composer** | Administra las librerías y paquetes externos de PHP para un código más eficiente y escalable. | `composer.json`, `composer.lock` |
| **Clases de Lógica** | **PHP Orientado a Objetos (POO)** | Encapsula la lógica central del proyecto (ej. gestión de usuarios, base de datos). | `lynxspace.class.php` |
| **Frontend** (Estructura) | **HTML5** | Estructura el contenido y las interfaces de usuario. | Implícito en todos los `.php` |
| **Frontend** (Estilos) | **CSS3** | Da diseño y presentación visual a la plataforma, creando una interfaz atractiva. | Carpeta `css/` |
| **Almacenamiento** | **MySQL / Base de Datos** | Almacenamiento persistente de datos de usuarios, roles, privilegios e historial. | Implícito (requiere **XAMPP**) |
| **Servidor Local** | **XAMPP / Apache** | Entorno de desarrollo local esencial para ejecutar PHP y gestionar la base de datos. | **Localhost** |
| **Archivos Multimedia** | **Carpetas** | Almacenamiento de recursos visuales y archivos subidos por los usuarios (fotos de perfil, etc.). | `image/`, `uploads/` |

---




## Funcionalidades Clave

### 1. Sistema de Autenticación y Perfil
- `log_in.php, log_out.php, sign_in.php`: Gestión de inicio de sesión, cierre de sesión y registro de nuevos usuarios.
- `editar_perfil.php`: Permite a los usuarios modificar su información personal.
- `amigos.php`: Funcionalidad clave de interacción social (listado, adición o gestión de contactos).


### 2. Seguridad y Administración de Usuarios (ACL)
Este es un enfoque muy sólido del proyecto, lo que lo hace más que un simple chat.
- `administrador.php, admi_seguridad.php`: Paneles de administración para el control total del sistema.
- `seguridad.php`: Módulos para verificación de seguridad y acceso.
- `editar_rol.php, nuevo_rol.php`: Creación y modificación de Roles (ej. Administrador, Moderador, Usuario Estándar).
- `editar_privilegio.php, nuevo_privilegio.php`, borrar_privilegio.php`: Asignación y gestión de Privilegios (permisos granulares para acciones específicas).
- `editar_rol_usuario.php, borrar_rol_usuario.php`: Módulos para asignar Roles a usuarios específicos.

### 3. Comunicación y Utilidades
- `correo.php`: Integración de envío de correos electrónicos (notificaciones, restablecimiento de contraseña, etc.).
- `printpdf.php`: Capacidad de generar reportes o documentos en formato PDF.


## 🎯 Objetivos Principales del Proyecto
1. Proveer una plataforma social/comunitaria (`amigos.php, historial.php`).
1. Garantizar la seguridad y el control de acceso mediante un sistema robusto de Roles y Privilegios.
1. Ofrecer herramientas administrativas completas para gestionar el contenido y los usuarios del sistema.
