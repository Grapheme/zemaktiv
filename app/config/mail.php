<?php

return array(

    'feedback' => array(
        'address' => 'bakhvalov@zemaktiv.ru',
        'call_address' => 'bakhvalov@zemaktiv.ru',
        'bran_address' => 'bakhvalov@zemaktiv.ru',
        'poll_address' => 'bakhvalov@zemaktiv.ru'
    ),

    'driver' => 'smtp',
    'host' => 'in.mailjet.com',
    'port' => 587,
    'from' => array(
        'address' => 'bakhvalov@zemaktiv.ru',
        'name' => 'Вяземские сады'
    ),
    'username' => '0d8dd8623bd38b41c43683c41c0558eb',
    'password' => '465c500abd5f680f0b20405deb967b36',

    'sendmail' => '/usr/sbin/sendmail -bs',
    'encryption' => 'tls',

    'pretend' => 0,
);