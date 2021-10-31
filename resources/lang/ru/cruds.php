<?php

return [
    'userManagement' => [
        'title'          => 'Управление пользователями',
        'title_singular' => 'Управление',
    ],
    'permission'     => [
        'title'          => 'Управление разрешениями',
        'title_singular' => 'Разрешение',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Комментарий',
            'name'              => 'Название',
            'roles'             => 'Роли',
            'permissions'       => 'Разрешения',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Управление ролями',
        'title_singular' => 'Роль',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'roles'             => 'Роли',
            'title'             => 'Комментарий',
            'name'              => 'Название',
            'title_helper'       => ' ',
            'permissions'        => 'Разрешение рола',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Пользователи',
        'title_singular' => 'Пользователь',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'company'           => [
        'title'          => 'Компании',
        'title_singular' => 'Компания',
        'fields'         => [
            'add'                      => 'Добавить компанию',
            'create'                   => 'Создать компанию',
            'edit'                   => 'Изменить компанию',
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Название',
            'name_input'               => 'Название компании',
            'logo'                     => 'Логотип',
            'manage'                   => 'Управление',
            'logo_choose'              => 'Выбрать логотип',
            'description'              => 'Описание компании',
            'description_placeholder'  => 'Опишите свою компанию',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'branch'           => [
        'title'          => 'Филиалы',
        'title_singular' => 'Филиал',
        'fields'         => [
            'add'                      => 'Добавить филиал',
            'create'                   => 'Создать филиал',
            'edit'                   => 'Изменить филиал',
            'company'                  => 'Компания',
            'company_helper'           => 'Выберите компанию',
            'address'                  => 'Адрес филиал',
            'address_helper'           => 'Пожалуйста, укажите адрес филиала',
            'phone'                    => 'Телефон филиала',
            'phone_helper'             => 'Пожалуйста, добавьте телефон филиала',
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Название филиала',
            'name_helper'              => 'Введите название филиала ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'manager'           => [
        'title'          => 'Менеджеры',
        'title_singular' => 'Менеджер',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'cashier'           => [
        'title'          => 'Кассиры',
        'title_singular' => 'Кассир',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'category'           => [
        'title'          => 'Категории',
        'title_singular' => 'Категория',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'import'           => [
        'title'          => 'Импорт товаров',
        'title_singular' => 'Импорт товар',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
];
