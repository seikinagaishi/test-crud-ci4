<?php echo $this->include('partials/head'); ?>

<body>
    <main id="page-list">
        <section id="list">
            <?php foreach($usuario as $user) : ?>
            <div class="user">
                <div class="pic"></div>
                <h1><?php echo $user->usuario ?></h1>
            </div>
            <?php endforeach; ?>
        </section>

        <a href="./" class="anchor-button">Voltar</a>
    </main>
</body>

<?php echo $this->include('partials/footer'); ?>