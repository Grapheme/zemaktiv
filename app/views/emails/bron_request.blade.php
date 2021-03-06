<?php
$livetype = array('Участки под дачу – я хочу построить дом сам, у меня уже есть к кому обратиться',
        'Участки под дачу – я пока не знаю какой именно дом построить – мне было интересно посмотреть проекты ваших домов',
        'Участки с готовыми домами, я хочу максимально быстро заселиться'
);
$price = array('Возможность рассрочки или ипотеки', 'Наличие скидок при 100% оплате');
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
        Номер участка: {{ Land::where('id', $land_id)->pluck('number') }}<br>
        Период проживания: {{ @$livetype[Input::get('livetype')] }}<br>
        Оплата: {{ @$price[Input::get('price')] }}
    </p>
</div>
</body>
</html>