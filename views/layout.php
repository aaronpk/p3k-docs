<html>
<head>
  <title><?= $this->e($title) ?></title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/styles.css" rel="stylesheet">
</head>
<body>

<div id="container">
  <div id="content">
    <?= $this->section('content') ?>
  </div>
  <div id="nav">
    <?= $this->fetch('partials/nav', ['sidebar' => $sidebar]) ?>
  </div>
</div>

<footer>
  
</footer>

</body>
</html>
