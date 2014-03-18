<?php $this->title = "Index page title"; ?>

<h1>Hello <?php echo $name; ?></h1>

<?php $this->start_region('extra_header'); ?>
    <script>console.log('Hello MVC');</script>
<?php $this->end_region(); ?>

<?php $this->start_region('footer'); ?>
    <h3>This is footer</h3>
<?php $this->end_region(); ?>
