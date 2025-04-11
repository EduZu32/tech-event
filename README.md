# 🎉 Proyecto: Gestión de Eventos Tecnológicos

## 📌 Objetivo General

Desarrollar una aplicación web para gestionar eventos tecnológicos que permita:

- Autenticación de usuarios mediante archivo de texto.
- Gestión completa de eventos (CRUD) en MySQL.
- Interfaz moderna y responsive usando Bootstrap.

---

## 🧩 Componentes Principales

### 🔐 Autenticación de Usuarios

- Los usuarios se autentican a través del archivo `usuarios.txt`.
- Formato: `usuario:contraseña` (una por línea).
- Inicio y cierre de sesión implementado con `$_SESSION`.

### 📅 Gestión de Eventos

- Todos los eventos se almacenan en una única tabla `eventos` en la base de datos.
- Cada usuario ve únicamente sus propios eventos.
- Funcionalidades implementadas:
  - Crear evento ✅
  - Listar eventos ✅
  - Editar evento ✅
  - Eliminar evento ✅

---

## 🛠️ Estructura del Proyecto

```
tech-event/
│
├── css/
│   └── style.css            # Estilos personalizados
│
├── includes/
│   ├── db.php               # Conexión a MySQL (PDO)
│   ├── eventFunctions.php   # Funciones CRUD de eventos
│   ├── footer.php
│   └── header.php
│
├── logs/
│   └── error.log            # Registro de errores
│
├── index.php               # Login de usuario
├── dashboard.php           # Página de bienvenida tras iniciar sesión
├── events.php              # Gestión CRUD de eventos
├── logout.php              # Cierre de sesión
├── usuarios.txt            # Almacenamiento plano de usuarios
└── particles.json          # Configuración de animación de fondo
```

---

## 🧠 Base de Datos

```sql
CREATE DATABASE eventos_tech;
USE eventos_tech;

CREATE TABLE eventos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  fecha DATE NOT NULL,
  descripcion TEXT,
  lugar VARCHAR(100),
  capacidad INT,
  creado_por VARCHAR(50) NOT NULL
);
```

---

## 🛡️ Seguridad

- Validación de entradas del usuario en formularios.
- Consultas preparadas con `PDO` para evitar SQL Injection.
- Cierre de sesión con `session_destroy()`.

---

## 🖼️ Interfaz de Usuario

- Diseño responsive con Bootstrap 5.3.
- Login centrado con fondo animado (`particles.js`).
- Tabla para eventos + formulario integrado para crear o editar.
- Visualización en tarjetas (modo galería) en el dashboard.

---

## 🪵 Registro de Errores (Logs)

El sistema incluye un mecanismo básico para registrar errores y facilitar la depuración:

- Se utiliza `try...catch` en operaciones críticas (como consultas a la base de datos).
- Los errores capturados se almacenan en un archivo `logs/error.log`.
- Esto permite revisar errores sin comprometer la experiencia del usuario final.

### Ejemplo de implementación:

```php
try {
    // operación que puede fallar
} catch (Exception $e) {
    error_log($e->getMessage(), 3, "logs/error.log");
}
```

> 📁 Asegúrate de que el directorio `logs/` tenga permisos de escritura.

---

## 🙌 Autor

Desarrollado por EduZu 💻✨

---

## ✅ Estado

Proyecto finalizado y funcional 🚀
