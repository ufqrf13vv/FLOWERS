<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Widget;

// Миниатюра категории
Container::make('term_meta', 'Миниатюра')
    ->show_on_taxonomy('category')
    ->add_fields([
        Field::make('image', 'crb_thumb', 'Миниатюра')
    ]);

//  Редактируемые поля
Container::make('theme_options', 'Редактируемые поля')
    ->add_fields([
        Field::make('text', '_crb_phone1', 'Телефон-1'),
        Field::make('text', '_crb_phone2', 'Телефон-2'),
        Field::make('text', '_crb_footer', 'Текст футера')
    ]);

Container::make('post_meta', 'Контактные данные магазинов')
    ->show_on_post_type('post')
    ->add_fields([
        Field::make('text', '_crb_contact-adress', 'Адрес'),
        Field::make('text', '_crb_contact-phone', 'Телефон'),
        Field::make('text', '_crb_contact-email', 'Email')
    ]);