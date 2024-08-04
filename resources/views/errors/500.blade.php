
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>500 Error</title>

    <!-- Base Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>

<body class="body-500">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-500"></i>
        <div class="text-center">
            <h2 class="purple-bg">Something went wrong</h2>
        </div>
        <p>Why not try refreshing your page? or you can contact <a href="#">support</a></p>
        <a href="{{ route(front.home) }}" class="back-btn">Back to Home</a>
    </section>

</div>


</body>
</html>
