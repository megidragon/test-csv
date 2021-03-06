<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
</head>
<body>
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="row">
                <h1>Selecciona tipo usuario</h1>
            </div>
            <hr>
            <div class="row">
                <form method="post" action="{{route('set-role')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="role1" value="admin" checked>
                        <label class="form-check-label" for="role1">
                            Admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="role2" value="client">
                        <label class="form-check-label" for="role2">
                            Otro
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
