<div class="dropdown">
    <a class="dropdown-toggle" id="dropExtTelefonos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-telephone-fill"></i> Ext.
    </a>
    <style>
        #dropExtTelefonos::before {
            border: 0px
        }
    </style>
    <?php
    if (
        $menu != 'procedencia' &&
        $_SESSION['id_cliente'] == 15
    ) :
        include 'include/extensiones.html';
    endif;
    ?>
</div>
<!-- <a class="" id="" role="button">
    <i class="bi bi-calendar3"></i> Agenda.
</a> -->