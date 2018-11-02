Напишите программу, отображающую, проверяющую достоверность и обрабатывающую
форму для ввода сведений о доставленной посылке. Эта форма
должна содержать поля ввода адресов отправителя и получателя, а также размеров
и веса посылки. При проверке достоверности данных из переданной
на обработку формы должно быть установлено, что вес посылки не превышает
68 кг, а любой из ее размеров - порядка 91 см.
Функция обработки формы в вашей программе должна выводить на экран сведения
о посылке в виде организованного, отформатированного отчета.

<?php
echo '<br>';
ini_set('display_errors','off');
$error = validate_form();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(validate_form() == null){
        show_results();
    }else{
        show_errors($error);
        show_form();
    }
}else{
    show_form();
}

function show_errors($error){
    echo "Please correct these errors: <ul><li>" . implode("</li><li>", $error) . "</li></ul>";
}

function show_form(){
    print '<form method="post" action="">
    <fieldset>
        <legend><h2>Parcel info</h2></legend>
        <h3> Adress </h3>
        <p>Sender adress: <input type="text" name="Sender" ><br> <!--required-->
        <p>Recipient adress: <input type="text" name="Recipient" ><br>
        <h3>Parcel dimensions</h3>
        <p>Weight of postal parcel: <input type="text" name="Weight" > kg <br>
        <p>Parcel height: <input type="text" name="Height" > cm <br>
        <p>Parcel lenght: <input type="text" name="Lenght" > cm <br>
        <p>Parcel width: <input type="text" name="Width" > cm
        <p><input type="submit" name="submit" value="Check and send"> 
        <!--<input type="button" name="cleaner" value="Clean form">-->
    </fieldset>
</form>';
}

function validate_form(){
    $errors = array();
    if (strlen(trim($_POST['Sender'])) == null){
        $errors[] = "Please insert correct sender adres";
    }
    if (strlen(trim($_POST['Recipient'])) == null){
        $errors[] = "Please insert correct recipient adres";
    }
    if ($_POST['Weight']== null){
        $errors[] = "Please insert correct weight";
    }elseif(!is_int($_POST['Weight']) && $_POST['Weight'] > 68){
        $errors[] = "Please insert correct weight that not sbeen increase than 68 kg";
    }
    if ($_POST['Height'] == null)
    {
        $errors[] = "Please insert correct height";
    }elseif(!is_int($_POST['Height']) && $_POST['Height'] > 91){
        $errors[] = "Please insert correct height that not been increase than 91 cm";
    }
    if ($_POST['Lenght'] == null){
        $errors[] = "Please insert correct lenght";
    }elseif(!is_int($_POST['Lenght']) && $_POST['Lenght'] > 91){
        $errors[] = "Please insert correct lenght that not been increase than 91 cm";
    }
    if ($_POST['Width'] == null){
        $errors[] = "Please insert correct width";
    }elseif(!is_int($_POST['Width']) && $_POST['Width']> 91){
        $errors[] = "Please insert correct width that not been increase than 91 cm";
    }
    return $errors;
}

function show_results(){
    //var_dump($_POST);
    echo '<table border="1" cellpadding="7" cellspacing="0" title="INFORMATION ABOUT PARCEL">';
    echo '<caption>INFORMATION ABOUT PARCEL</caption>';
    foreach ($_POST as $item=>$value){
        if ($item != submit){
            echo "<tr align='center'>
                <td align='center'>$item</td>
                <td align='center'>$value</td>
             </tr>";
        }else{
            echo '</table>';
        }
    }
    new_form();
}

function new_form(){
    echo '<br>';
    echo '<input type="button" name="new_parcel" value="New parcel"/>';
    //echo "PROCES FORM OK ";
}
