<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Album Photo - Accueil</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    
    <body>
        <header>Album Photo</header>
        <nav>
            <a href="/">Accueil</a>
            <a href="/albums">Albums</a>
            <a href="/photos">Photos</a>
            <a href="/tags">Tags</a>
            <a href="/ajoutPhoto">Ajout Photo</a>
        </nav>
        
        
        <main>
            @yield("content")
        </main>
    </body>
</html>
