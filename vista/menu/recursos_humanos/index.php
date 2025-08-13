<?php
    include "../../variables.php";
    $menu = "Recursos Humanos";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>Recursos Humanos | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    // Permisos de Recursos Humanos
    var rhRegVac = <?php echo empty($_SESSION['permisos']['rhRegVac']) ? 0 : $_SESSION['permisos']['rhRegVac']; ?>;
    var rhEditVac = <?php echo empty($_SESSION['permisos']['rhEditVac']) ? 0 : $_SESSION['permisos']['rhEditVac']; ?>;
    var rhEliVac = <?php echo empty($_SESSION['permisos']['rhEliVac']) ? 0 : $_SESSION['permisos']['rhEliVac']; ?>;
    var rhAprVac = <?php echo empty($_SESSION['permisos']['rhAprVac']) ? 0 : $_SESSION['permisos']['rhAprVac']; ?>;
    var rhRegPub = <?php echo empty($_SESSION['permisos']['rhRegPub']) ? 0 : $_SESSION['permisos']['rhRegPub']; ?>; // NUEVO PERMISO
    var rhGesPost = <?php echo empty($_SESSION['permisos']['rhGesPost']) ? 0 : $_SESSION['permisos']['rhGesPost']; ?>; // NUEVO PERMISO AÚN INACTIVO
    var rhGesCand = <?php echo empty($_SESSION['permisos']['rhGesCand']) ? 0 : $_SESSION['permisos']['rhGesCand']; ?>; // NUEVO PERMISO

    // Mantener permisos existentes de inventario (por compatibilidad)
    var edit = <?php echo empty($_SESSION['permisos']['rhRegVac']) ? 0 : $_SESSION['permisos']['rhRegVac']; ?>;
    var supr = <?php echo empty($_SESSION['permisos']['invEliArt']) ? 0 : $_SESSION['permisos']['invEliArt']; ?>;
    var editEntradas = <?php echo empty($_SESSION['permisos']['invRegEnt']) ? 0 : $_SESSION['permisos']['invRegEnt']; ?>;
    var invVerTrans = <?php echo (isset($_SESSION['permisos']['invVerTrans']) && $_SESSION['permisos']['invVerTrans'] == 1) ? 1 : 0; ?>;

    // Objeto de permisos actualizado para recursos humanos
    var userPermissions = {
        canEdit: edit === 1,
        canDelete: supr === 1,
        canEditEntradas: editEntradas === 1,
        canViewTransactions: invVerTrans === 1,
        // Permisos específicos de RH
        canRegisterVacancy: rhRegVac === 1,
        canEditVacancy: rhEditVac === 1,
        canDeleteVacancy: rhEliVac === 1,
        canApproveVacancy: rhAprVac === 1,
        canRegisterPublication: rhRegPub === 1, // NUEVO PERMISO
        canManageApplicant: rhGesPost === 1, // NUEVO PERMISO INACTIVO
        canManageCandidate: rhGesCand === 1 // NUEVO PERMISO
    };

    // Array de permisos para compatibilidad con el código existente
    window.userPermissions = [];
    if (rhRegVac === 1) window.userPermissions.push('rhRegVac');
    if (rhEditVac === 1) window.userPermissions.push('rhEditVac');
    if (rhEliVac === 1) window.userPermissions.push('rhEliVac');
    if (rhAprVac === 1) window.userPermissions.push('rhAprVac');
    if (rhRegPub === 1) window.userPermissions.push('rhRegPub'); // NUEVO PERMISO
    if (rhGesPost === 1) window.userPermissions.push('rhGesPost'); // NUEVO PERMISO INACTIVO
    if (rhGesCand === 1) window.userPermissions.push('rhGesCand'); // NUEVO PERMISO
    

    // Variables globales para uso en otros scripts
    window.userId = <?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 0; ?>;
    window.tienePermisoRegVac = rhRegVac === 1;
    window.tienePermisoRegPub = rhRegPub === 1; // NUEVA VARIABLE
    window.tienePermisoGesPost = rhGesPost === 1; // NUEVA VARIABLE INACTIVA
    window.tienePermisoGesCand = rhGesCand === 1; // NUEVA VARIABLE

    console.log('Usuario ID:', window.userId);
    console.log('Permisos RH Array:', window.userPermissions);
    console.log('Puede registrar vacantes:', window.tienePermisoRegVac);
    console.log('Puede registrar publicaciones:', window.tienePermisoRegPub);
    // console.log('Puede gestionar postulantes:', window.tienePermisoGesPost);
    console.log('Puede gestionar candidatos:', window.tienePermisoGesCand);
    console.log('Objeto userPermissions:', userPermissions);

    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {
            menu: menu
        }, function(html) {
            validar = true;
            $("#body-controlador").html(html);
        });
    }
</script>
</html>