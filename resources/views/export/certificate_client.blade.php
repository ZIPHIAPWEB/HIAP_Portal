<!DOCTYPE html>
<html>  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Certificate</title>
        <style>
            @font-face {
                font-family: 'Montserrat';
                src: url("{{ asset('fonts/montserrat_500_51d32715a2529ff80180b0dec7eb7073.ttf') }}") format('truetype');
            }
            
            body, html {
                height: 100%;
                margin: 0;
                background: rgb(204,204,204); 
            }
            
            .bg {
                background-image: url("{{ '/cert_layout/' . $data['layout']['img_path'] }}") !important;
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
            }

            .full-name {
                position: absolute;
                left: 0;
                width: 100%;
                text-align: center;
            }

            .a-four {
                box-sizing: border-box;
                padding: 0;
                width: 210mm;
                height: 297mm;
                background-image: url("{{ '/cert_layout/' . $data['layout']['img_path'] }}") !important;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
            }

            .page {
                background: white;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }

            .page {
                width: 29.7cm;
                height: 21cm; 
                background-image: url("{{ config('app.url') . 'cert_layout/' . $data['layout']['img_path'] }}") !important;
                background-position: center; 
                background-repeat: no-repeat;
                background-size: contain;
            }

            .container {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            @media print {
                page {
                    width: 29.7cm;
                    height: 21cm;
                }
            }
        </style>
    </head>
    <body>
        <div class="container no-print">
            <div class="page">
                <div class="full-name" style="{{ $data['layout']['f_style'] }}">
                    <span>{{ $data['full_name'] }}</span>
                </div>
            </div>
        </div>
    </body>
</html>