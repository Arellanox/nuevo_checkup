// Al cargar la página, solo muestra el menú principal
        document.addEventListener("DOMContentLoaded", function () {
            // Oculta los módulos al inicio
            document.getElementById("modulos-rrhh").style.display = "none";

            // Oculta el botón de registrar vacante al inicio
            ocultarBotonVacante();

            // Muestra el menú principal
            document.getElementById("tab-menu").style.display = "";
            
            // Oculta todos los módulos
            document.querySelectorAll('.content-module').forEach(module => {
                module.style.display = 'none';
            });
        });
        
        // Cuando el usuario haga clic en una opción del menú
        document.querySelectorAll("#menu-grid a").forEach(function (link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                
                // Oculta el menú principal
                document.getElementById("tab-menu").style.display = "none";
                
                // Muestra la sección de módulos
                document.getElementById("modulos-rrhh").style.display = "block";
                
                // Oculta todos los módulos
                document.querySelectorAll('.content-module').forEach(module => {
                    module.style.display = 'none';
                });
                
                // Muestra el módulo seleccionado
                const targetModule = this.getAttribute('data-target');
                document.getElementById(targetModule).style.display = 'block';

                // Mostrar u ocultar el botón de vacante según el módulo
                if (targetModule === "moduloRequisicion") {
                    mostrarBotonVacante();
                } else {
                    ocultarBotonVacante();
                }
            });
        });
        // Funcionalidad para volver al menú principal
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btnVolver')) {
            e.preventDefault();

            // Oculta el botón de registrar vacante
            ocultarBotonVacante();
            
            // Oculta la sección de módulos
            document.getElementById("modulos-rrhh").style.display = "none";
            
            // Muestra el menú principal
            document.getElementById("tab-menu").style.display = "block";
        }
    });

        // Funciones para mostrar/ocultar el botón
        function mostrarBotonVacante() {
            const btn = document.getElementById("btnRegistrarVacante");
            if (btn) btn.style.display = "inline-block";
        }
        function ocultarBotonVacante() {
            const btn = document.getElementById("btnRegistrarVacante");
            if (btn) btn.style.display = "none";
        }