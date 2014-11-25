
<h1>Please enter your name below</h1>

<form method="post" action="names/add/">
    <p>
    Name: <?php echo $this->tag->textField(array('name')); ?>
    </p>
    <p>
    <?php echo $this->tag->submitButton(array('Submit')); ?>
    </p>  
</form>
