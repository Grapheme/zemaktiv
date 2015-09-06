<?php
$ipoteka = array('Ипотекой от Сбербанка', 'Рассрочка от застройщика');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <p>
        Посетитель заказал звонок.<br>
        Тел.номер: {{ @$phone }}<br>
        {{ @$ipoteka[$request] }}
    </p>
</div>
</body>
</html>