# AMP4DLE
Модуль AMP страниц для DataLife Engine 

В качестве исходника - бесплатный модуль DomiTori 


## Устанока 

Открываем .htaccess в корне вашего сайта, ищем в нем код

# Сам пост

ВЫШЕ вставляем код

# AMP

RewriteRule ^([0-9]{4})/([0-9]{2})/([0-9]{2})/(.*)/amp.html$ index.php?subaction=showfull&year=$1&month=$2&day=$3&news_name=$4&seourl=$4&amp=1 [L]
RewriteRule ^([^.]+)/([0-9]+)-(.*)/amp.html$ index.php?newsid=$2&seourl=$3&seocat=$1&amp=1 [L]
RewriteRule ^([0-9]+)-(.*)/amp.html$ index.php?newsid=$1&seourl=$2&amp=1 [L]


Установка завершена. Далее вас ждет не менее увлекательное - настройка под свои нужды. У вас есть 2 файла в папке с вашим шаблоном - amp.tpl и amp-fullstory.tpl
В них настраиваем внешний вид ваших amp страниц. 

Какие теги можно использовать в amp.tpl и amp-fullstory.tpl:
{full-link} - ссылка на полную новость
[full-link]..[/full-link] - текст между тегами станет ссылкой на полную новость
{login} - Автор новости
[profile]...[/profile] - текст между тегами станет ссылкой на профиль автора
{views} - количество просмотров новости
{date} - дата новости в формате 01.08.2017
{seo-date} - дата для разметки schema в формате 2017-08-01
{title} - тайтл новости
{full-story} - описание новости
{description} - обрезанное дл 150 символов описание новости для мета тегов и микроразметки
{link-category} - ссылки на категории новости
{site-name} - имя сайта с настроек
{site-url} - полный адрес сайта
{THEME} - адрес сайта с приставкой /templates/ваша_тема
