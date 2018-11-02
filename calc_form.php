<?php
require 'FormHelper.php';
$ops = array('+','-','*','/');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    list($errors, $input) = validate_form();
    if ($errors) {
        //отобразить форму с указанием ошибоу
        show_form($errors);
    } else {
        //обработка переданных данных в форму
        proces_form($input);
        // отображение формы для следуюзего вичесления
        show_form();
    }
} else {
    //если не переданы значения - отобразить форму заново
    show_form();
}

function show_form($errors = array()){
    $defaults = array('num1' => 1,
        'op' => 0,
        'num2' => 1);
        $form = new FormHelper($defaults);
        include 'math-form.php';
}

function validate_form(){
    $input = array();
    $errors = array();

    $input['op'] = $GLOBALS['ops'][$_POST['op']] ?? '';
    if (! in_array($input['op'], $GLOBALS['ops'])){
        $errors[] = "Please select operation.";
    }
    $input['num1'] = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    if (is_null($input['num1'])|| ($input['num1']=== false)){
        $errors[] = "Pleade enter a valid first number";
    }
    $input['num2'] = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    if (is_null($input['num2'])|| ($input['num2']=== false)){
        $errors[] = "Pleade enter a valid second number";
    }
    if (($input['op'] == '/') && ($input['num2']==0)){
        $errors[] = 'Division by 0 is not allowed';
    }
    return array($errors, $input);
}


function proces_form($input){
 $result = 0;

 if ($input['op'] == '+'){
     $result = $input['num1'] + $input['num2'];
 }elseif ($input['op'] == '-'){
     $result = $input['num1'] - $input['num2'];
 }elseif ($input['op'] == '*'){
     $result = $input['num1'] * $input['num2'];
 }elseif ($input['op'] == '/'){
     $result = $input['num1'] / $input['num2'];
 }

 $message = "{$input['num1']} {$input['op']} {$input['num2']} = $result";

 print "<h3> $message </h3>";
}



