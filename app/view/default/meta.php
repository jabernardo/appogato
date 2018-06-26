<title><?= \Lollipop\Utils::fuse($title, 'Appogato Test Application') ?></title>
<?php if ($favicon) { ?>
<link rel="icon" type="<?= \Lollipop\Utils::fuse($favicon_type, 'image/x-icon') ?>" href="<?= \Lollipop\Utils::fuse($favicon, '') ?>">
<link rel="shortcut icon" type="<?= \Lollipop\Utils::fuse($favicon_type, 'image/x-icon') ?>" href="<?= \Lollipop\Utils::fuse($favicon, '') ?>">
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (isset($meta) && is_array($meta)) { ?>
<meta charset="<?= \Lollipop\Utils::fuse($meta['charset'], 'UTF-8') ?>">
<meta name="author" content="<?= \Lollipop\Utils::fuse($meta['author'], '') ?>">
<meta name="description" content="<?= \Lollipop\Utils::fuse($meta['description'], '') ?>">
<meta name="keywords" content="<?= \Lollipop\Utils::fuse($meta['keywords'], '') ?>">
<?php } ?>
