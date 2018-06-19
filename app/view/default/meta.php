<title><?= fuse($title, 'Appogato Test Application') ?></title>
<?php if ($favicon) { ?>
<link rel="icon" type="<?= fuse($favicon_type, 'image/x-icon') ?>" href="<?= fuse($favicon, '') ?>">
<link rel="shortcut icon" type="<?= fuse($favicon_type, 'image/x-icon') ?>" href="<?= fuse($favicon, '') ?>">
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (isset($meta) && is_array($meta)) { ?>
<meta charset="<?= fuse($meta['charset'], 'UTF-8') ?>">
<meta name="author" content="<?= fuse($meta['author'], '') ?>">
<meta name="description" content="<?= fuse($meta['description'], '') ?>">
<meta name="keywords" content="<?= fuse($meta['keywords'], '') ?>">
<?php } ?>
