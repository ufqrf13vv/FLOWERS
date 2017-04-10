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
        Field::make('text', '_crb_phone', 'Телефон'),
        Field::make('text', '_crb_adress', 'Адрес'),
        Field::make('text', '_crb_email', 'Email'),
        Field::make('text', '_crb_footer', 'Текст футера')
    ]);

Container::make('post_meta', 'Слайдер')
    ->show_on_post_type('post')
    ->add_fields([
        Field::make('text', '_crb_video', 'Ссылка на видео'),
        Field::make('text', '_crb_author', 'Автор отзыва'),
        Field::make('text', '_crb_author-post', 'Должность автора'),
        Field::make('text', '_crb_order', 'Номер договора'),
        Field::make('radio', '_crb_type', 'Тип слайда')
            ->add_options([
                'image' => 'Рисунок',
                'video' => 'Видео',
                'feedback' => 'Отзыв'
            ]),
    ]);