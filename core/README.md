# 📌 **Estructura de Archivos Core**

--- 
**Nota:** Si se agrega una nueva carpeta a la estructura de directorios, por favor, asegúrese de actualizar este archivo `README.md` con una explicación sobre su propósito y cómo debe ser utilizada para mantener la documentación del proyecto clara y actualizada.

---

## 📂 **Estructura de Directorios**
    ├──assets             Archivos estáticos y multimedia 
    │  └──archivos        
    ├──includes           Montadores de archivos scripts
    │   └──archivos.php     
    ├──helpers            Funciones auxiliares reutilizables 
    │  └──{categoría}/    
    │     └──archivos.js  
    ├──modules            Módulos específicos (pueden ser precargados si es necesario) 
    │  └──{módulo}/       
    │     └──archivo.*
    └──requests           Centraliza todas las peticiones AJAX o Fetch 
       └──{categoría}/    
          └──archivos.js
---

# 📌 **Estructura de Archivos Core**

Esta carpeta centraliza la lógica funcional y reutilizable del sitio web, con el objetivo de mantener un código más limpio, modular y organizado.

---

## 📂 **Estructura de Directorios**

### ├── `/assets/`
**Archivos estáticos y multimedia**  
Contiene todos los recursos estáticos utilizados en el sitio web, como archivos CSS, imágenes y medios (audio y video).

- `archivos/`: Carpeta destinada a archivos adicionales de recursos estáticos.

---

### ├── `/includes/`
**Montadores de archivos scripts**  
Almacena archivos PHP que se encargan de incluir o montar otros archivos esenciales para el sitio web.

- `archivos.php`: Archivo para incluir los scripts necesarios para el funcionamiento del sistema.

---

### ├── `/helpers/`
**Funciones auxiliares reutilizables**  
Esta carpeta contiene todas las funciones comunes que pueden ser reutilizadas en el sitio. Pueden ser funciones para formatear fechas, validar formularios, entre otras.

- `{categoría}/`: Subcarpeta que puede organizar los helpers según su funcionalidad.
- `archivos.js`: Funciones de utilidad en formato JS que pueden ser reutilizadas en diferentes partes del proyecto.

---

### ├── `/modules/`
**Módulos específicos**  
Contiene módulos que agrupan funcionalidades más específicas del sitio. Cada módulo tiene su propia carpeta y archivos correspondientes.

- `{módulo}/`: Cada subcarpeta agrupa archivos que corresponden a un módulo determinado.
- `archivo.*`: Archivos específicos para cada módulo, como JavaScript o PHP, dependiendo de la necesidad.

---

### ├── `/requests/`
**Centraliza todas las peticiones AJAX o Fetch**  
En esta carpeta se encuentran todos los archivos que gestionan las peticiones a la API o interacciones con el backend a través de AJAX o Fetch.

- `{categoría}/`: Carpeta que organiza las peticiones por categorías, por ejemplo, `usuarios`, `productos`, etc.
- `archivos.js`: Archivos JS que gestionan las solicitudes de datos desde el cliente hacia el servidor.

---