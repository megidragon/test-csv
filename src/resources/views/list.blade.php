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
                <h1>Lista de importaciones</h1>
            </div>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Item #°</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($list))
                            <tr>
                                <td colspan="3">Sin resultados</td>
                            </tr>
                        @else
                            @foreach($list as $item)
                                <tr>
                                    <th scope="row">
                                        #{{$item->session_id}}
                                    </th>
                                    <td style="color: {{$item->status == \App\Models\LiveStatus::$FINISHED ? 'green' : 'red'}};">
                                        <strong>{{$item->status}}</strong>
                                    </td>
                                    <td>
                                        @if ($item->status === \App\Models\LiveStatus::$FINISHED)
                                            <a href="{{route('details', $item->session_id)}}" target="_blank">
                                                <button class="btn btn-primary">
                                                    Ver
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
