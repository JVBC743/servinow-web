<!DOCTYPE html>
<html>
<head>
    <title>Edição do Perfil</title>
</head>
<body>
    <h1>Configuração de Conta</h1>
    <form action="">
        <div>
            <input type="text" placeholder="Nome">
            <input type="text" placeholder="E-mail">
            <input type="text" placeholder="Telefone">
            <input type="text" placeholder="Área de atuação">
            <input type="text" placeholder="CPF/CNPJ">
        </div>
        <div>
            <input type="text" placeholder="Rede social #1">
            <input type="text" placeholder="Rede social #2">
            <input type="text" placeholder="Rede social #3">
            <input type="text" placeholder="Rede social #4">
            <input type="image">
        </div>
        
        
        {{ $nome_foto = "teste" }}

        <input type="submit" value="Salvar">
    </form>
</body>
</html>