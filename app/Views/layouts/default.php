<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? ''; ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/scripts/ajax.js" type="text/javascript"></script>
    <script src="/assets/scripts/main.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body>
<h1><a href="<?=PATH?>">Заказы</a></h1>
<div class="contentWraper">
    <?= $this->content; ?>
</div>
</body>
</html>