<head>
  <?php $now = time(); ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php $time = time(); ?>
  <?= js('assets/lazysizes.min.js?v=' . $time) ?>
  <?= js('assets/flickity.min.js?v=' . $time) ?>
  <?= js('assets/theme.js?v=' . $time) ?>
  <?php snippet('favicon') ?>

  <title> <?= $page->title() ?> </title>
  
  <?= css('assets/css/flickity.css') ?>
  <?= css('assets/css/styles.css?' . $now) ?>
  <?= css('assets/css/root.css?' . $now) ?>
</head>