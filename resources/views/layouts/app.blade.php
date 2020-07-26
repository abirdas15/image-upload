<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Dropify -->
    <link rel="stylesheet" href="https://lib.arvancloud.com/ar/Dropify/0.2.2/css/dropify.min.css">
    <!--Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    
    <title>Hello, world!</title>
  </head>
  <body>
    @yield('content')

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Dropify -->
    <script src="{{ asset('/') }}js/dropify.min.js"></script>

     <!--Toastr -->
     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

     <!-- Sweet Alert -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script')
  </body>
</html>