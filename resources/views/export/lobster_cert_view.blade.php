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
            body {
                background: rgb(204,204,204); 
            }
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }

            page[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
                background-image: url("{{ asset($data['img_path']) }}") !important;
                background-position: center;
                background-size: contain;
                position: relative;
            }

            @media print {
                body {
                    width: 21cm;
                    height: 29.7cm; 
                    margin: 0;
                    padding: 0;
                }

                page[size="A4"] {  
                    background-image: url("{{ asset($data['img_path']) }}") !important;
                    background-position: center;
                    background-size: contain;
                    position: relative;
                }
            }
        </style>
    </head>
    <body>
        <page size="A4">
            @foreach($data['cert_styles'] as $style)
            <p style="{{ $style['styles'] }}">RENZ D MERGENIO</p>
            @endforeach
        </page>
        <!-- <div class="container no-print">
            <div class="page">
                <div class="full-name">
                    <span>Alyssa Diaz</span>
                </div>
                <div class="accredited-hours">
                    <span>Accredited Hourse: 400</span>
                </div>
            </div>
        </div> -->
    </body>
</html>