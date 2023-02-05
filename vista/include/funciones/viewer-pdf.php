<?php
$url = $_POST['url'];
$nombreArchivo = $_POST['nombreArchivo'];

?>

<div id="adobe-dc-view"></div>
<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script type="text/javascript">
    document.addEventListener("adobe_dc_view_sdk.ready", function() {
        var adobeDCView = new AdobeDC.View({
            clientId: "cd0a5ec82af74d85b589bbb7f1175ce3",
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