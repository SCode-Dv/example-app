<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/app.css">
    <title>Catálogo de productos</title>

    <style>
        table, td, th {
            border: 1px solid;
        }
        table {
            width: 90%;
            margin: auto;
        }
    </style>

</head>
<body>

    <h1>Catálogo de productos</h1>
    <h3>Productos totales: {{ $lista->count() }}</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lista AS $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->codigo }}</td>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->precio }}</td>
                <td>{{ $item->existencia }}</td>
                <td>{{ $item->categoria->nombre }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!--<form action="" method="post">
        @method("DELETE")
        @csrf

        <button type="submit">Eliminar</button>

    </form>-->

</body>
</html>