$(document).ready(function () {
    // Initialize variables
    let logoImage = null;
    let logoUrl = $('#logoPreview').is(':visible') ? $('#logoPreview').attr('src') : null;
    let qrCodeStyling = null;

    // Initialize the form display and generate QR code on page load
    initializeFormDisplay();
    generateQRCode();

    // Toggle between logo and text options
    $('select[name="logoType"]').on('change', function () {
        if ($(this).val() === 'logo') {
            $('#logoOptions').show();
            $('#textOptions').hide();
        } else {
            $('#logoOptions').hide();
            $('#textOptions').show();
        }
        generateQRCode();
    });

    // Logo upload handler
    $('#logoUpload').on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                logoUrl = e.target.result;
                logoImage = new Image();
                logoImage.onload = function () {
                    $('#logoPreview').attr('src', logoUrl).show();
                    generateQRCode();
                }
                logoImage.src = logoUrl;
            }
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, clear the logo
            logoImage = null;
            logoUrl = null;
            $('#logoPreview').hide();
            generateQRCode();
        }
    });

    // Handle QR type selection change
    $('#qrtype').on('change', function () {
        const qrType = $(this).val();

        // Hide all specific areas first
        $('.dineinArea').addClass('hidden');
        $('.wifiArea').addClass('hidden');
        $('#data').closest('.form-group').show();

        // Show the appropriate area based on selection
        if (qrType === 'dinein') {
            $('.dineinArea').removeClass('hidden');
            $('#data').closest('.form-group').hide();
        } else if (qrType === 'wifi') {
            $('.wifiArea').removeClass('hidden');
            $('#data').closest('.form-group').hide();
        }

        // Update QR code when type changes
        generateQRCode();
    });

    // Function to set up initial form display
    function initializeFormDisplay() {
        console.log("Initializing form display...");
        const qrType = $('#qrtype').val();

        // Hide all specific areas first
        $('.dineinArea').addClass('hidden');
        $('.wifiArea').addClass('hidden');

        // Show the appropriate area based on selection
        if (qrType === 'dinein') {
            $('.dineinArea').removeClass('hidden');
            $('#data').closest('.form-group').hide();
        } else if (qrType === 'wifi') {
            $('.wifiArea').removeClass('hidden');
            $('#data').closest('.form-group').hide();
        } else {
            $('#data').closest('.form-group').show();
        }

        // Initialize logo/text options
        const logoType = $('select[name="logoType"]').val();
        if (logoType === 'logo') {
            $('#logoOptions').show();
            $('#textOptions').hide();
        } else {
            $('#logoOptions').hide();
            $('#textOptions').show();
        }
    }

    // Improved QR Code Generation Function
    function generateQRCode() {
        console.log("Generating QR code...");

        // Remove existing QR code
        $('#qrCode').empty();

        // Get the QR type with fallback
        const qrType = $('#qrtype').val() || 'qr';

        // Get all necessary values with fallbacks
        const width = parseInt($('#width').val()) || 300;
        const height = parseInt($('#height').val()) || 300;
        const margin = parseInt($('#margin').val()) || 7;
        const dotsColor = $('#dotsColor').val() || '#800080';
        const dotsStyle = $('#dotsStyle').val() || 'square';
        const cornersSquareColor = $('#cornersSquareColor').val() || '#000000';
        const cornersSquareStyle = $('#cornersSquareStyle').val() || 'square';
        const backgroundColor = $('#backgroundColor').val() || '#ffffff';

        // Determine the data for the QR code based on type
        let qrData = '';

        try {
            if (qrType === 'qr') {
                // Regular QR - use the data URL input
                qrData = $('#data').val() || base_url;
                $('#qrCode').attr('data-url', qrData);
            } else if (qrType === 'dinein') {
                // Dine-in QR - create URL with table ID
                const tableId = $('select[name="table_no"]').val();
                const username = $('input[name="username"]').val();
                const clang = $('meta[name="app-language"]').attr('content');

                qrData = `${base_url}${username}?table=${tableId}&lang=${clang}`;
                $('#qrCode').attr('data-url', qrData);
            } else if (qrType === 'wifi') {
                // WiFi QR - format according to WiFi standards
                const ssid = $('#ssid').val().trim() || ''; // Remove spaces at the beginning and end
                const password = $('#password').val().trim() || '';
                const security = $('#wifisecurity').val().toUpperCase().trim() || 'WPA'; // Ensure uppercase for compatibility

                // If security is 'nopass', remove the password field
                qrData = (security === 'NOPASS') ?
                    `WIFI:S:${encodeURIComponent(ssid)};T:nopass;;` :
                    `WIFI:S:${encodeURIComponent(ssid)};T:${security};P:${encodeURIComponent(password)};;`;
                $('#qrCode').attr('data-url', qrData);
            }

            // Base QR code options
            const qrCodeOptions = {
                width: width,
                height: height,
                data: qrData,
                margin: margin,
                type: 'canvas',
                dotsOptions: {
                    color: dotsColor,
                    type: dotsStyle
                },
                cornersSquareOptions: {
                    color: cornersSquareColor,
                    type: cornersSquareStyle
                },
                backgroundOptions: {
                    color: backgroundColor
                }
            };

            console.log("QR Options:", JSON.stringify({
                width: width,
                height: height,
                margin: margin,
                dotsStyle: dotsStyle,
                cornersSquareStyle: cornersSquareStyle
            }));

            // Get center type (logo or text)
            const centerType = $('select[name="logoType"]').val();

            if (centerType === 'logo' && logoUrl) {
                console.log("Using logo in QR code");
                // The correct way to specify logo options
                qrCodeOptions.image = logoUrl;

                // Convert percentage values to the format expected by the library
                const logoSizePercent = parseInt($('#logoSize').val() || '20') / 100;
                const logoMarginPercent = parseInt($('#logoMargin').val() || '5') / 100;

                qrCodeOptions.imageOptions = {
                    hideBackgroundDots: true,
                    imageSize: logoSizePercent,
                    margin: logoMarginPercent,
                    crossOrigin: "anonymous"
                };
            } else if (centerType === 'text' && $('#centerText').val().trim() !== '') {
                console.log("Using text in QR code");
                // Create a canvas for the text that matches the red rectangle dimensions
                const tempCanvas = document.createElement('canvas');
                const ctx = tempCanvas.getContext('2d');

                const canvasWidth = 450; // Wider canvas for better text display
                const canvasHeight = 100; // Adjusted height for proper proportion
                tempCanvas.width = canvasWidth;
                tempCanvas.height = canvasHeight;

                // Fill with transparent background
                ctx.fillStyle = 'rgba(255,255,255,0)';
                ctx.fillRect(0, 0, canvasWidth, canvasHeight);

                // Get text properties
                const text = $('#centerText').val();
                const fontSize = Math.floor(canvasHeight * 0.6); // Adjust font size to fill the height better
                const fontFamily = $('#textFont').val() || 'Arial';
                const textColor = $('#textColor').val() || '#000000';

                // Draw text on canvas
                ctx.fillStyle = textColor;
                ctx.font = `${fontSize}px ${fontFamily}`;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(text, canvasWidth / 2, canvasHeight / 2);

                // Convert canvas to data URL
                const textImageUrl = tempCanvas.toDataURL('image/png');

                // Add text image to QR code
                qrCodeOptions.image = textImageUrl;

                // Set image size to approximately 70% of QR code width to match the red rectangle
                qrCodeOptions.imageOptions = {
                    hideBackgroundDots: true,
                    imageSize: 0.7, // 70% of QR code width to match red rectangle
                    margin: 0.05, // Small margin
                    crossOrigin: "anonymous"
                };
            }

            // Check if QR code container exists
            if ($('#qrCode').length === 0) {
                console.error("QR code container not found");
                return;
            }

            // Create new QR Code
            try {
                qrCodeStyling = new QRCodeStyling(qrCodeOptions);

                // Append QR Code to container
                qrCodeStyling.append(document.getElementById('qrCode'));
                console.log("QR code generated successfully");
            } catch (qrError) {
                console.error("Error creating QR code:", qrError);
                $('#qrCode').html('<p class="text-danger">Error creating QR Code: ' + qrError.message + '</p>');
            }
        } catch (error) {
            console.error("Error generating QR Code:", error);
            $('#qrCode').html('<p class="text-danger">Error generating QR Code: ' + error.message + '</p>');
        }
    }

    // Function to download QR Code
    function downloadQRCode() {
        if (!qrCodeStyling) {
            showStatusMessage('Please generate a QR code first', 'danger');
            return;
        }

        try {
            const fileName = getRandomNumber(100, 1000);
            qrCodeStyling.download({
                name: 'Qr_' + fileName,
                extension: 'png'
            });
            showStatusMessage('QR code downloaded successfully!', 'success');
        } catch (error) {
            console.error("Error downloading QR Code:", error);
            showStatusMessage('Error downloading QR Code: ' + error.message, 'danger');
        }
    }

    function getRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Function to save QR code data to database
    function saveToDatabase() {
        if (!qrCodeStyling) {
            showStatusMessage('Please generate a QR code first', 'danger');
            return;
        }

        // Convert QR code to data URL
        const canvas = document.querySelector('#qrCode canvas');
        if (!canvas) {
            showStatusMessage('QR code canvas not found', 'danger');
            return;
        }

        // Get the QR code as a blob
        canvas.toBlob(function (qrBlob) {
            // Create FormData object
            const formData = new FormData(document.getElementById('qrCodeForm'));

            // Add CSRF token to the form data
            const csrfTokenName = $('meta[name="csrf-token-name"]').attr('content') || 'csrf_token_name';
            const csrfTokenValue = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', _csrf);

            // Add centerType to identify what's being used
            formData.append('centerType', $('select[name="logoType"]').val());

            // Add the QR image as a file
            formData.append('qr_image', qrBlob, 'qr-code.png');

            // Add logo file if it exists and logo is selected
            if ($('select[name="logoType"]').val() === 'logo') {
                const logoFile = document.getElementById('logoUpload').files[0];
                if (logoFile) {
                    formData.append('logo_image', logoFile);
                }
            }

            var url = $('#qrCodeForm').attr('action');

            // Send data to CodeIgniter controller
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false, // Don't process the data
                contentType: false, // Let the browser set content type with boundary
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfTokenValue // Add CSRF token as a header as well
                },
                beforeSend: function () {
                    $('#saveToDbBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                    showStatusMessage('Saving QR code data...', 'info');
                },
                success: function (response) {
                    if (response.success) {
                        showStatusMessage(response.message || 'QR code saved successfully!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);

                    } else {
                        showStatusMessage(response.message || 'Error saving QR code', 'danger');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    showStatusMessage('Server error: ' + error, 'danger');
                },
                complete: function () {
                    $('#saveToDbBtn').prop('disabled', false).html('<i class="fas fa-save"></i> <?= __("save"); ?>');
                }
            });
        }, 'image/png');
    }

    // Helper function to show status messages
    function showStatusMessage(message, type) {
        $('#statusMessage').html(`<div class="alert alert-${type}" role="alert">${message}</div>`);

        // Auto hide success messages after 3 seconds
        if (type === 'success') {
            setTimeout(function () {
                $('#statusMessage').empty();
            }, 3000);
        }
    }

    // Regenerate QR Code on form input changes
    $('#qrCodeForm input, #qrCodeForm select').on('input change', function () {
        // Don't regenerate on logo upload as that has its own handler
        if (this.id !== 'logoUpload') {
            generateQRCode();
        }
    });

    // Download QR Code button handler
    $('#downloadBtn').on('click', function (e) {
        e.preventDefault();
        downloadQRCode();
    });

    // Save to Database button handler
    $('#saveToDbBtn').on('click', function (e) {
        e.preventDefault();
        saveToDatabase(this);
    });

    // Prevent form submission
    $('#qrCodeForm').on('submit', function (e) {
        e.preventDefault();
        generateQRCode();
    });
});
