<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TESTE MINIO</title>
</head>
<body>
    <h1>TESTE MINIO</h1>
    <h1>Formulário abaixo</h1>
    @if ($error)
        <h1>{{ $error }} </h1>
    @else
        <h1> {{ $success }} </h1>
    @endif
    <form action="{{ route('enviar.imagem') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="arquivo" id=""><br>
        <input type="submit" value="Enviar imagem">
    </form>
    
</body>
</html>