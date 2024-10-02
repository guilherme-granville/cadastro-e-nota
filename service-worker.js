self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open('todo-cache').then(function (cache) {
            return cache.addAll([
                '/',
                '/index.php',
                '/cadastro.php',
                '/declaracao_conteudo.php',
                '/outra_pagina.php',
                '/verficar_produtos.php',
                '/login.php',
                '/logout.php',
                '/.htaccess',
                
                '/css/declaracao.css',
                '/css/login.css',
                '/css/style.css',
                '/css/outra_pagina.css',
                '/css/produtos.css',

                '/js/cadastrar_produto.js',
                '/js/declaracao_conteudo.js',
                '/js/main.js',
                '/js/outra_pagina.js',

                '/icons/pencil.svg',
                '/icons/favicon.ico',

                '/php/cadastrar_produto.php',
                '/php/buscar_produto.php',
                '/php/conexao.php',
                '/php/obter_cidade.php',
                '/php/obter_produto.php',

                '/manifest.json'
            ]);
        })
    );
});

self.addEventListener('fetch', function(event){
    event.respondWith(
        caches.match(event.request).then(function(response){
            return response || fetch(event.request);
        })
    );
});