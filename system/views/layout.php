<!doctype html>
<html>
<head>
    <title><?php echo $this->title; ?></title>
    <?php echo $this->region('extra_header'); ?>
</head>
<body>
    <h3>Hello world! From MVC Framework</h3>
    <?php echo $content; ?>
    <?php echo $this->region('footer'); ?>
</body>
</html>