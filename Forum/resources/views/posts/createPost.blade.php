<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Tópico</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Criar Novo Tópico</h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="profile.html">Perfil</a>
            <a href="logout.html">Sair</a>
        </nav>
    </header>

    <main>
        <form action="submit_post.html" method="POST">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required>

            <label for="category">Categoria:</label>
            <select id="category" name="category">
                <option value="1">Programação</option>
                <option value="2">Matemática</option>
                <option value="3">Ciências</option>
            </select>

            <label for="content">Conteúdo:</label>
            <textarea id="content" name="content" rows="10" required></textarea>

            <button type="submit">Criar Tópico</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Fórum Didático. Todos os direitos reservados.</p>
    </footer>
</body>
</html>