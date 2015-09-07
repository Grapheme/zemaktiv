<?php
$livetype = array('Дом для постоянного проживания','Летний дом, дача');
$technology = array('Строительные конструкции','Комплектация домов');
$price = array('Купить дом и участок в рассрочку','Наличие скидки при 100% оплате');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <p>
        Посетитель забронировал участок.<br>
        Имя: {{ @$name }}<br>
        Тел.номер: {{ @$phone }}<br>
        Email: {{ @$email }}<br>
        Номер участка: {{ Land::where('id', $land_id)->pluck('number') }}<br>
        Период проживания: {{ @$livetype[Input::get('livetype')] }}<br>
        Технология строительства: {{ @$technology[Input::get('technology')] }}<br>
        Период проживания: {{ @$price[Input::get('price')] }}
    </p>
</div>
</body>
</html>