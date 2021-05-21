<?php echo $this->include('partials/head'); ?>

<body>
    <main>
        <form>
            <h1>Registre-se</h1>
            <input id="usuario" type="text" name="usuario" placeholder="Usuário">
            <input id="senha" type="password" name="senha" placeholder="Senha">

            <button type="button" id="btn-enviar">Registrar</button>
            <a href="login">Já tenho conta</a>
        </form>
    </main>
</body>

<script>
    document.querySelector('#btn-enviar').addEventListener('click', () => {
        let formData = {
            usuario: document.querySelector('#usuario').value,
            senha: document.querySelector('#senha').value
        }

        fetch('register', {
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

            if(res.msg == 'Success') {
                window.location.href = "login";
            }
        })
        
        .catch((err) => {
            console.log(err);
            alert('Erro!');
        })
    })
</script>

<?php echo $this->include('partials/footer') ?>