<x-filament-panels::page>
    <style>
        .body2 {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            box-sizing: border-box;
            text-align: center;
        }

        .container2 {
            width: 100%;
            max-width: 500px;
            margin: 5px;
        }

        .container2 h1 {
            color: #ffffff;
        }

        .section2 {
            background-color: #ffffff;
            padding: 50px 30px;
            border: 1.5px solid #b2b2b2;
            border-radius: 0.25em;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
        }

        #my-qr-reader {
            padding: 20px !important;
            border: 1.5px solid #b2b2b2 !important;
            border-radius: 8px;
        }

        #my-qr-reader img[alt="Info icon"] {
            display: none;
        }

        #my-qr-reader img[alt="Camera based scan"] {
            width: 100px !important;
            height: 100px !important;
        }

        .section2 button {
            padding: 10px 20px;
            border: 1px solid #b2b2b2;
            outline: none;
            border-radius: 0.25em;
            color: white;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            margin-bottom: 10px;
            background-color: #008000ad;
            transition: 0.3s background-color;
        }

        .section2 button:hover {
            background-color: #008000;
        }

        #html5-qrcode-anchor-scan-type-change {
            text-decoration: none !important;
            color: #1d9bf0;
        }

        .section2 video {
            width: 100% !important;
            border: 1px solid #b2b2b2 !important;
            border-radius: 0.25em;
        }
    </style>
    <div class="body2">
        <div class="container2">
            <h1>Scan QR Codes</h1>
            <div class="section2">
                <div id="my-qr-reader">
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode">
    </script>

    <script>
        var isScanning = true;

        function domReady(fn) {
            if (
                document.readyState === "complete" ||
                document.readyState === "interactive"
            ) {
                setTimeout(fn, 1000);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function() {

            // If found you qr code
            function onScanSuccess(decodeText, decodeResult) {
                try {
                    if (isScanning) {
                        new FilamentNotification()
                            .title('Berhasil scan QR Code')
                            .body('Membuka halaman yang diminta...')
                            .success()
                            .send();
                        window.open(decodeText, "_blank").focus();
                        isScanning = false;
                        setTimeout(() => {
                            isScanning = true;
                        }, 3000);
                    }
                } catch (error) {
                    if (isScanning) {
                        isScanning = false;
                        new FilamentNotification()
                            .title('Error scan QR Code')
                            .body('QR Code tidak valid')
                            .danger()
                            .send();
                        setTimeout(() => {
                            isScanning = true;
                        }, 3000);
                    }
                }
            }

            let htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader", {  
                    // tempat di mana scanner akan ditampilkan.
                    fps: 10,
                    qrbos: 250
                }
            );
            htmlscanner.render(onScanSuccess);
        });
    </script>
</x-filament-panels::page>