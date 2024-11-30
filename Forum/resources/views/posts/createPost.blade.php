<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Post</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .post-form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .post-form-container h2 {
            text-align: center;
            color: #1da1f2;
        }

        .post-form-container label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        .post-form-container input, 
        .post-form-container select, 
        .post-form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #e1e8ed;
            border-radius: 5px;
        }

        .post-form-container textarea {
            resize: none;
            height: 100px;
        }

        .post-form-container button {
            background-color: #1da1f2;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .post-form-container button:hover {
            background-color: #0d95e8;
        }
    </style>
</head>
<body>
    <div class="post-form-container">
        <h2>Criar Post</h2>
        <form action="{{ route('createPost') }}" method="POST">
            @csrf
            <label for="title">Título do Post:</label>
            <input type="text" id="title" name="title" placeholder="Digite o título" required>

            <label for="category">Categoria do Post:</label>
            <select id="category" name="category" required>
                <option value="">Selecione uma categoria</option>
                <option value="1">Programação</option>
                <option value="2">Matemática</option>
                <option value="3">Ciências</option>
            </select>

            <label for="tags">Tags do Post:</label>
            <select id="tags" name="tags[]" multiple>
                <option value="1">Laravel</option>
                <option value="2">PHP</option>
                <option value="3">Bootstrap</option>
            </select>

            <label for="content">Texto do Post:</label>
            <textarea id="content" name="content" placeholder="O que está acontecendo?" required></textarea>

            <button type="submit"><i class="fas fa-paper-plane"></i> Publicar</button>
        </form>
    </div>
</body>
</html>