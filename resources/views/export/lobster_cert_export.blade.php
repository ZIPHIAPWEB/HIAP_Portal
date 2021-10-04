<!DOCTYPE html>
<html>  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Certificate</title>
        <style>
            @font-face {
                font-family: 'Montserrat';
                src: url("{{ storage_path('fonts/montserrat_500_51d32715a2529ff80180b0dec7eb7073.ttf') }}") format('truetype');
            }

            @font-face {
                font-family: 'Montserrat';
                src: url("{{ storage_path('fonts/MontserratBold-DOWZd.ttf') }}") format('truetype');
                font-weight: bold;
            }
            
            body {
                background: rgb(204,204,204); 
            }
            div[size="A4"] {
                background: white;
                display: block;
                margin: 0 auto;
                /* box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); */
            }

            div[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
                background-image: url("{{ asset($data['layout']['img_path']) }}") !important;
                background-position: center;
                background-size: contain;
                position: relative;
            }

            @foreach($data['layout']['styles'] as $style)
                div[size="A4"] span:nth-child({{ $loop->iteration }}) { {{ $style['styles']}} }
            @endforeach

            @page {
                margin: 0px;
            }

            @media print {
                body {
                    width: 21cm;
                    height: 29.7cm; 
                    margin: 0;
                    padding: 0;
                }

                div[size="A4"] {  
                    background-image: url("{{ asset($data['layout']['img_path']) }}") !important;
                    background-position: center;
                    background-size: contain;
                    position: relative;
                }
                
                @foreach($data['layout']['styles'] as $style)
                    div[size="A4"] span:nth-child({{ $loop->iteration }}) { {{ $style['styles']}} }
                @endforeach
            }
        </style>
    </head>
    <body>
        <div size="A4">
            @foreach($data['client'] as $client)
                @if ($client)
                    <span>{{ $client }}</span>
                @endif
            @endforeach
        </div>
    </body>
</html>