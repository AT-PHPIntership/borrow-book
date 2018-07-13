var _scannerIsRunning = false;
function order_by_occurrence(arr) {
    var counts = {};
    arr.forEach(function(value){
        if(!counts[value]) {
          counts[value] = 0;
        }
            counts[value]++;
        });

        return Object.keys(counts).sort(function(curKey,nextKey) {
            return counts[curKey] < counts[nextKey];
    });
}

function startScanner() {
    Quagga.onDetected(function(result) {
        var last_code = result.codeResult.code;
        code = last_code;
        $.ajax({
            type: "POST",
            url: 'admin/books/read-barcode',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { barcode: code },
            success: function(data) {
                if (typeof data !== 'undefined' && data.length > 0) {
                    Quagga.stop();
                    id = data[0]['id'];
                    window.location.href = 'admin/books/' + id;
                } else {
                    $('.alert-danger').show();
                    $('.alert-danger').text('Book not exist!');
                }
            }
        });
    });
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#scanner-container'),
            constraints: {
                width: 480,
                height: 320,
                facingMode: "environment"
            },
        },
        decoder: {
            readers: [
                "ean_reader",
            ],
            debug: {
                showCanvas: true,
                showPatches: true,
                showFoundPatches: true,
                showSkeleton: true,
                showLabels: true,
                showPatchLabels: true,
                showRemainingPatchLabels: true,
                boxFromPatches: {
                    showTransformed: true,
                    showTransformedBox: true,
                    showBB: true
                }
            }
        },

    }, function (err) {
        if (err) {
            return
        }
        Quagga.start();

        // Set flag to is running
        _scannerIsRunning = true;
    });

    Quagga.onProcessed(function (result) {
        var drawingCtx = Quagga.canvas.ctx.overlay,
        drawingCanvas = Quagga.canvas.dom.overlay;

        if (result) {
            if (result.boxes) {
                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                result.boxes.filter(function (box) {
                    return box !== result.box;
                }).forEach(function (box) {
                    Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                });
            }

            if (result.box) {
                Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
            }

            if (result.codeResult && result.codeResult.code) {
                Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
            }
        }
    });
}


// Start/stop scanner
document.getElementById("btn").addEventListener("click", function () {
    if (_scannerIsRunning) {
        Quagga.stop();
    } else {
        startScanner();
    }
}, false);
