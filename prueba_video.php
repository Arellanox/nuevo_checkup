<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cámara del dispositivo (OOP)</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</head>

<body>
    <!-- <div>
        <button id="boton-camara">Tomar foto</button>
        <select id="dispositivos"></select>
    </div>
    <video id="video"></video>
    <canvas id="canvas"></canvas>
    <img id="foto" style="display: none;"> -->

    <!-- HTML markup -->
    <select id="device-select"></select>
    <button id="start-button">Start camera</button>
    <button id="stop-button" disabled>Stop camera</button>
    <button id="photo-button" disabled>Take photo</button>
    <video id="video" width="640" height="360"></video>
    <img src="" id="photo-preview" alt="">


    <script>
        class Camera {
            constructor(videoElement) {
                this.video = videoElement;
                this.stream = null;
                this.deviceId = null;
            }

            async start() {
                const constraints = {
                    video: {
                        deviceId: this.deviceId ? {
                            exact: this.deviceId
                        } : undefined,
                        width: {
                            min: 640,
                            ideal: 720,
                            max: 1080
                        },
                        height: {
                            min: 480,
                            ideal: 720,
                            max: 1080
                        }
                    }
                };

                try {
                    this.stream = await navigator.mediaDevices.getUserMedia(constraints);
                    this.video.srcObject = this.stream;
                    await this.video.play();
                } catch (err) {
                    console.error('Failed to start camera', err);
                    throw err;
                }
            }

            stop() {
                if (this.stream) {
                    this.stream.getTracks().forEach(track => track.stop());
                    this.stream = null;
                    this.video.srcObject = null;
                }
            }

            takePhoto() {
                const canvas = document.createElement('canvas');
                canvas.width = this.video.videoWidth;
                canvas.height = this.video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(this.video, 0, 0);
                const dataUrl = canvas.toDataURL('image/png');
                return dataUrl;
            }

            setDeviceId(deviceId) {
                this.deviceId = deviceId;
                if (this.stream) {
                    this.stop();
                    this.start();
                }
            }

            async getDevices() {
                const devices = await navigator.mediaDevices.enumerateDevices();
                const cameras = devices.filter(device => device.kind === 'videoinput');
                return cameras;
            }
        }



        $(document).ready(async function() {
            const videoElement = $('#video')[0];
            const startButton = $('#start-button');
            const stopButton = $('#stop-button');
            const photoButton = $('#photo-button');
            const deviceSelect = $('#device-select');

            const camera = new Camera(videoElement);
            const cameras = await camera.getDevices();
            cameras.forEach(camera => {
                deviceSelect.append(`<option value="${camera.deviceId}">${camera.label}</option>`);
            });

            deviceSelect.change(function() {
                const deviceId = $(this).val();
                camera.setDeviceId(deviceId);
            });

            startButton.click(async function() {
                await camera.start();
                startButton.attr('disabled', true);
                stopButton.attr('disabled', false);
                photoButton.attr('disabled', false);
            });

            stopButton.click(function() {
                camera.stop();
                startButton.attr('disabled', false);
                stopButton.attr('disabled', true);
                photoButton.attr('disabled', true);
            });

            photoButton.click(function() {
                const dataUrl = camera.takePhoto();
                $('#photo-preview').attr('src', dataUrl);
            });
        });
    </script>
</body>

</html>