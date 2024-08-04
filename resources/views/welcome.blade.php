<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
        {{ Form::open() }}

      <div class="g-recaptcha" data-sitekey="6Ld2dB8UAAAAAFM-u1XgrX7n487_uPDjmu_q-BVn"></div>
      <input type="text" name="name">
      <button type="submit">Submit</button>
      {!! Form::close() !!}
      <script type="text/javascript">
          $('form').submit(function(e){
            if (grecaptcha.getResponse().length === 0) {
                e.preventDefault();
            }
          })
      </script>
  </body>
</html>