<?php if (isset($title)) { ?>
<title><?= $title ?></title>
<?php } ?>

<meta charset="<?= fuse($meta['charset'], 'UTF-8') ?>">
<link rel="shortcut icon" type="<?= fuse($favicon_type, 'image/x-icon') ?>" href="<?= fuse($favicon, '') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (isset($meta)) { ?>
<meta name="author" content="<?= fuse($meta['author'], '') ?>">
<meta name="description" content="<?= fuse($meta['description'], '') ?>">
<meta name="keywords" content="<?= fuse($meta['keywords'], '') ?>">
<?php } ?>
