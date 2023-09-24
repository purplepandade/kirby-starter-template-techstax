<!DOCTYPE html>
<html lang="de">
<?php snippet('html-head') ?>

<body class="overflow-x-hidden font-karla bg-bodyBG">
    <?php snippet('header') ?>
    <main>
        <div class="page-width py-12">
            <?= $page->text()->kirbytext() ?>
        </div>
    </main>
    <?php snippet('footer') ?>
</body>

</html>