# Sistema de Gestión de Personal del Ateneo

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

Sistema web para la gestión del personal con diferentes niveles de acceso.

## 🚀 Características principales

### 👨‍💻 Para usuarios

- Visualización del personal del ateneo
- Sistema de filtrado avanzado
- Interfaz intuitiva y responsiva

### 👨‍💼 Para administradores

- CRUD completo de empleados
  - Añadir nuevos empleados
  - Editar información existente
  - Eliminar empleados
- Sistema de autenticación

## 📦 Instalación

1. Clonar el repositorio:

```bash
git clone https://github.com/ASANCHEZ-16-DEV/manage_contacts_app.git
cd manage_contacts_app
```

1. Configurar la base de datos:

   mysql -u root -p < directorio.sql
3. Configurar las credenciales en:

/includes/conexion.php


## 🛠️ Estructura del proyecto

manage-contacts-app/
├── admin/
│   ├── add_employee.php
│   ├── edit_employee.php
│   ├── login.php
│   ├── logout.php
│   ├── indexadminpanel.php
│   └── css/
│       ├── admin-style.css
│       ├── styles.css
│       └── w3.css
├── includes/
│   ├── auth.php
│   └── conexion.php
├── index.php
├── footer.html
└── directorio.sql


## 🔒 Credenciales de prueba (admin)

* Usuario: admin
* Contraseña: password (cambiar en producción)


## 📄 Documentación técnica

### Páginas principales

| Archivo     | Descripción                            |
| ----------- | --------------------------------------- |
| index.php   | Página principal con tabla de personal |
| footer.html | Pie de página común                   |

### Panel de administración

| Archivo           | Dependencias | Descripción               |
| ----------------- | ------------ | -------------------------- |
| login.php         | auth.php     | Autenticación de usuarios |
| add_employee.php  | conexion.php | Añadir empleados          |
| edit_employee.php | conexion.php | Editar empleados           |
| logout.php        | -            | Cerrar sesión             |

### Includes

| Archivo      | Descripción                 |
| ------------ | ---------------------------- |
| auth.php     | Gestión de sesiones y roles |
| conexion.php | Conexión a MariaDB          |
