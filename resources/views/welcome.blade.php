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
        <script src="{{ asset('/js/app.js') }}"></script>
    </head>
    <body>
        
    
    
      <div class="container">
        <div class="breadcrumbs">
          <ul class="breadcrumb">
            <li><a href="index.php">Laravel Doctrine Demo App</a></li>
            <li>Jobs in your City</li>
          </ul>
        </div>
        <h4 class="heading">Find a job you will love.</h4>
        <form id="job-main-form" method="get" action="#" >
          <div class="controls">
            <div class="row">
              <div class="col-sm-5 col-sm-offset-1 col-lg-4 col-lg-offset-2">
                <div class="form-group">
                  <label for="profession">Profession</label>
                  <input type="text" id="profession" name="profession" placeholder="Profession you are looking for" class="form-control">
                </div>
              </div>
              <div class="col-sm-5 col-lg-4">
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" id="location" name="location" placeholder="Any particular location?" value="Bay Area" class="form-control">
                </div>
              </div>
              <div class="col-sm-1">
                <button type="submit" name="name" class="btn btn-primary job-main-form__button"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    
    <section>
      <div class="container">
        <h3 class="heading">We have found 40 jobs</h3>
        <div class="alert alert-danger" style="display: none;" role="alert">Some error happened.Please, try again.</div>
           
        <div id="joblist">
          
        </div>
       
        <div class="pages col-md-offset-2">
          <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li class="active"> <a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </section>
    
    </body>
</html>
