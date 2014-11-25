
<h1>Please enter your name below</h1>

<form method="post" action="names/add/">
    <p>
    Name: {{ text_field('name') }}
    </p>
    <p>
    {{ submit_button('Submit') }}
    </p>  
</form>
