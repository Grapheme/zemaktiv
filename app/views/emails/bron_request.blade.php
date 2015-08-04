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
        Номер участка: {{ Land::where('id', $land_id)->pluck('number') }}
    </p>
</div>
</body>
</html>