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
<body style="font-family: monospace">
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="row">
                <h1>Detalles resultantes</h1>
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <td>Total duplicados: </td>
                        <td>{{ $data['duplicates'] }}</td>
                    </tr>
                    <tr>
                        <td>Errores: </td>
                        <td>{{ $data['errors'] }}</td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#°</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['ids'] as $id => $records)
                            <tr>
                                <td>{{$id}}</td>
                                <td>{{$records['beginning']}}</td>
                                <td>{{$records['end']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <h3>Periodos faltantes</h3>
                <ul>
                    @foreach($data['ids'] as $id => $records)
                        @if (empty($records['missing_dates']))
                            @continue(true)
                        @endif
                        <li>
                            ID: {{$id}}
                            <ul>
                                @foreach($records['missing_dates'] as $row)
                                    <li>Desde: {{$row['from']}}</li>
                                    <li>Hasta: {{$row['to']}}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
