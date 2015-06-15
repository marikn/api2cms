{{ get_doctype() }}
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <title>API2CMS | Unified CMS API interface</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="shortcut icon" href="favicon.png">

        {{ stylesheet_link("css/bootstrap.css") }}
        {{ stylesheet_link("css/animate.css") }}
        {{ stylesheet_link("css/font-awesome.min.css") }}
        {{ stylesheet_link("css/slick.css") }}

        {{ stylesheet_link("js/rs-plugin/css/settings.css") }}
        {{ stylesheet_link("css/freeze.css") }}

        {{ javascript_include("js/modernizr.custom.32033.js") }}

        <!--[if lt IE 9]>
            {{ javascript_include("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js", false) }}
            {{ javascript_include("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js", false) }}
        <![endif]-->
    </head>

    <body>
        {{ partial("partials/preloader") }}
        <header>
            {{ partial("partials/menu") }}
            {{ partial("partials/slider") }}
        </header>

        <div class="wrapper">
            {{ content() }}
            {{ partial("partials/footer") }}
        </div>


        {{ javascript_include("js/jquery-1.11.1.min.js") }}
        {{ javascript_include("js/bootstrap.min.js") }}
        {{ javascript_include("js/slick.min.js") }}
        {{ javascript_include("js/placeholdem.min.js") }}
        {{ javascript_include("js/rs-plugin/js/jquery.themepunch.plugins.min.js") }}
        {{ javascript_include("js/rs-plugin/js/jquery.themepunch.revolution.min.js") }}
        {{ javascript_include("js/waypoints.min.js") }}
        {{ javascript_include("js/scripts.js") }}

        <script>
            $(document).ready(function() {
                appMaster.preLoader();
            });
        </script>
    </body>
</html>
