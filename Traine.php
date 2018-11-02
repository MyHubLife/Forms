<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    list($form_errors, $input) = validate_form();
    if ($form_errors){
        show_form($form_errors);
    } else {
        //print "INSERT YOU NAME, more than 3 chars \n";
        proces_form($input);
    }
} else {
    show_form();
}

function validate_form(){
    $errors = array();
    if (strlen(trim($_POST["my_name"])) < 3) {
        $errors[] = 'You name must be longer that 3 letters';
    }
    if (strlen(trim($_POST["my_name"])) == 0) {
        $errors[] = 'Please enter your name =)';
    }
        return $errors;
}

function show_form($errors = ''){
    if ($errors){
        print 'Please correct these errors: <ul><li>';
        print implode('</li><li>', $errors);
        print '</li></ul>';
    }
    print <<<_HTML_
<form method="post" action="$_SERVER[PHP_SELF]">
You name:<input type="text" name="my_name">
<!--<br>-->
<!--<select name="lunch[]" multiple>-->
<!--<option value="pork">BBQ Pork Bun</option>-->
<!--<option value="chicken">Chicken Bun</option>-->
<!--<option value="lotus">Lotus Seed Bun</option>-->
<!--<option value="bean">Bean Paste Bun</option>-->
<!--<option value="nest">Bird-Nest Bun</option>-->
<!--</select> -->
<br>
<input type="submit" name="Say hello!">
</form>
_HTML_;
}

function proces_form()
{
    print "Hello, " . $_POST['my_name'];
}