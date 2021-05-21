<?php echo $this->include('partials/head'); ?>

<body>
    <main>
        <form>
            <h1>Dados</h1>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario->usuario; ?>">
            <input type="password" id="senha" name="senha" value="<?php echo $usuario->senha; ?>">

            <button type="button" id="btn-enviar">Alterar</button>
            <button class="danger" type="button" id="btn-excluir">Excluir</button>

            <div class="links">
                <a href="#" id="logout">Sair</a>
                <a href="lista">Lista de Usuários</a>
            </div>
        <form>
    </main>
</body>

<script>
    document.querySelector('#btn-enviar').addEventListener('click', () => {
        let formData = {
            usuario: document.querySelector('#usuario').value,
            senha: document.querySelector('#senha').value
        }

        fetch('update', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        
        .then(res => res.json())

        .then(res => {
            alert(res.msg);
            window.location.reload();
        })
        
        .catch((err) => {
            console.log(err);
            alert('Erro!');
        })
    })

    document.querySelector('#btn-excluir').addEventListener('click', () => {
        fetch('delete', {
            method: 'POST'
        })

        .then(() => {
            alert('Conta deletada!');
            window.location.href = 'login';
        })

        .catch((err) => {
            console.log(err);
        })
    })

    document.querySelector('#logout').addEventListener('click', () => {
        fetch('logout', {
            method: 'POST'
        })

        .then(() => {
            alert('deslogou');
            window.location.href = 'login';
        })

        .catch((err) => {
            console.log(err);
        })
    })
</script>

<?php echo $this->include('partials/footer'); ?>