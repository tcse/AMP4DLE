# AMP4DLE
Модуль AMP страниц для DataLife Engine 

Официальная страница https://tcse-cms.com/amp4dle 

В качестве исходника - бесплатный модуль DomiTori 

Автоматическая генерация AMP версии страниц полной новости.

Суффикс /amp.html в конце ссылки полной новости. Например, у страницы https://tcse-cms.com/main/inet/1447-Sovremennoe-seo-amp-istorii.html - версия AMP будет доступна по ссылке https://tcse-cms.com/main/inet/1447-Sovremennoe-seo-amp-istorii/amp.html .

![](https://sun4-16.userapi.com/Gm32m9Td-DopmXv9MMkCbaf4xiaWil8hen_GLQ/sqfrTSgQtss.jpg)

Автоматическое добавление мета-тегов canonical и amphtml для индексации AMP версии страницы.


## Устанока 

Загрузить архив плагина через админку Утилиты - Управления плагинами.

Открываем .htaccess в корне вашего сайта, ищем в нем код

    # Сам пост

ВЫШЕ вставляем код

    # AMP

    RewriteRule ^([0-9]{4})/([0-9]{2})/([0-9]{2})/(.*)/amp.html$ index.php?subaction=showfull&year=$1&month=$2&day=$3&news_name=$4&seourl=$4&amp=1 [L]
    RewriteRule ^([^.]+)/([0-9]+)-(.*)/amp.html$ index.php?newsid=$2&seourl=$3&seocat=$1&amp=1 [L]
    RewriteRule ^([0-9]+)-(.*)/amp.html$ index.php?newsid=$1&seourl=$2&amp=1 [L]


Установка завершена. 


## Принцип работы AMP с DataLife Engine

AMP версия создается только для статьи целиком (то, что обычно отображается в шаблоне {THEME}/fullstory.tpl )

После подключения и активации плагина AMP4DLE_pro у каждой статьи сайта в метатегах генерируемых CMS появляется новый тег информирующий о наличии AMP версии страницы.

    <link rel="amphtml" href="https://sitename.com/o-skripte/1-post1/amp.html">

где атрибут rel="amphtml" это тот самый признак AMP-версии,
а ссылка вида https://sitename.com/o-skripte/1-post1/amp.html (с окончанием /amp.html ) и есть адрес AMP страницы.

## Теги шаблонов

У вас есть 2 файла в папке с вашим шаблоном - custom/amp/main.tpl и custom/amp/fullstory.tpl
В них настраиваем внешний вид ваших amp страниц. 


{full-link} - ссылка на полную новость

[full-link]..[/full-link] - текст между тегами станет ссылкой на полную новость

{login} - Автор новости

[profile]...[/profile] - текст между тегами станет ссылкой на профиль автора

{views} - количество просмотров новости

{date} - дата новости в формате 17.01.2021

{seo-date} - дата для разметки schema в формате 2021-01-17

{title} - тайтл новости

{full-story} - описание новости

{description} - обрезанное до 150 символов описание новости для мета тегов и микроразметки

{link-category} - ссылки на категории новости

{site-name} - имя сайта из админки DLE

{short-name} - краткое имя сайта из админки DLE

{site-url} - полный адрес сайта

{THEME} - адрес сайта с приставкой /templates/ваша_тема

