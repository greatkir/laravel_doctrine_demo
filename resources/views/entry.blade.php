<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel-Doctrine Demo App</title>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />
        <!--Scripts-->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/entry.js') }}"></script>
    </head>
    <body>
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/index.php">Laravel Doctrine Demo App</a></li>
                    <li>Jobs in your City</li>
                </ul>
            </div>
            <h4 class="heading">Find a job you will love.</h4>

        </div>

        <section>
            <div class="container article-container" id="{{$id}}">
                <div class="alert alert-danger" style="display: none;" role="alert">Some error happened.Please, try again.</div>
                <div class="alert alert-danger alert-not-found" style="display: none;" role="alert">404. Sorry, we do not have such job position.</div>
            </div>
        </section>

    </body>
</html>
