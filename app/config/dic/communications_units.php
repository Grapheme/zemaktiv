<?php

return array(

    'fields' => function ($dicval = NULL) {

        return array(
            'photo' => array(
                'title' => 'Изображение',
                'type' => 'image',
                'params' => array(
                    'maxFilesize' => 1, // MB
                    #'acceptedFiles' => 'image/*',
                    #'maxFiles' => 2,
                ),
            ),
            'anonce' => array(
                'title' => 'Короткое описание',
                'type' => 'textarea_redactor',
            ),
            'content' => array(
                'title' => 'Описание',
                'type' => 'textarea_redactor',
            ));
    },
    'menus' => function($dic, $dicval = NULL) {
        $menus = array();
        return $menus;
    },
    'actions' => function($dic, $dicval) {

    },
    'hooks' => array(
        'before_all' => function ($dic) {},
        'before_index' => function ($dic) {},
        'before_index_view' => function ($dic, $dicvals) {},
        'before_create_edit' => function ($dic) {},
        'before_create' => function ($dic) {},
        'before_edit' => function ($dic, $dicval) {},
        'before_store_update' => function ($dic) {},
        'before_store' => function ($dic) {},
        'after_store' => function ($dic, $dicval) {},
        'before_update' => function ($dic, $dicval) {},
        'after_update' => function ($dic, $dicval) {},
        'before_destroy' => function ($dic, $dicval) {},
        'after_destroy' => function ($dic, $dicval) {},
    ),

    'seo' => false,
    'versions' => 0,
);