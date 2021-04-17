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
                <h1>Importador de archivo csv con laravel</h1>
            </div>
            <hr>
            <div class="row">
                <form method="post" action="{{route('upload-file')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-outline mb-4">
                        <input type="file" id="csvImporter" name="csv" class="form-control" />
                        <label class="form-label" for="csvImporter">Csv importer</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
            <hr>
            <div class="row">
                <h5>Descargar ejemplo: <a href="{{url('files/example.csv')}}">Ejemplo.csv</a></h5>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
