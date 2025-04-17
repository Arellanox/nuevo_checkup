<?php
$url = $_POST['url'];
$nombreArchivo = $_POST['nombreArchivo'];


?>

<div id="adobe-dc-view" style="height:100%"></div>

<script type="text/javascript">
    document.addEventListener("adobe_dc_view_sdk.ready", function() {
        var clientId = isLocalHost ? '3867b556792e429084f3e9253d3ea45c' : 'cd0a5ec82af74d85b589bbb7f1175ce3';
        let adobeDCView = new AdobeDC.View({
            clientId: clientId,
            divId: "adobe-dc-view"
        });
        adobeDCView.previewFile({
            content: {
                location: {
                    url: "<?php echo $url; ?>"
                }
            },
            metaData: {
                fileName: "<?php echo $nombreArchivo; ?>"
            }
        }, {});
    });
</script>