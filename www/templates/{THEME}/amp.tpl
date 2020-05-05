<!doctype html>
<html ⚡ lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0/amp-experiment-0.1.js">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js">
    <link rel="preconnect dns-prefetch" href="https://fonts.gstatic.com/" crossorigin>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-experiment" src="https://cdn.ampproject.org/v0/amp-experiment-0.1.js"></script>
    <script async custom-element="amp-dynamic-css-classes" src="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js"></script>
    <script custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js" async=""></script>
	<script custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js" async=""></script>

    <!-- Import other AMP Extensions here -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	{include file="custom/amp/amp-custom-css.tpl"}
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
    <noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <link rel="canonical" href=".">
	<script type="application/ld+json">
	{
	        "@context": "http://schema.org",
	        "@type": "NewsArticle",
	        "mainEntityOfPage": "{full-link}",
	        "headline": "{title}",
	        "datePublished": "{seo-date}",
	        "dateModified": "{seo-date}",
	        "description": "{description}",
	        "author": {
	          "@type": "Person",
	          "name": "{author}"
	        },
	        "publisher": {
	          "@type": "Organization",
	          "name": "TCSE",
	          "logo": {
	            "@type": "ImageObject",
	            "url": "{THEME}/images/logo.png",
	            "width": 600,
	            "height": 60
	          }
	        },
	        "image": {
	          "@type": "ImageObject",
	          "url": "{image-1}",
	          "height": 2000,
	          "width": 800
	        }
	      }
	</script>
  </head>
  <body>

	<!-- Start Navbar -->
		{include file="custom/amp/navbar.tpl"}
	<!-- End Navbar -->

    {include file="custom/amp/amp-fullstory.tpl"}

    {include file="custom/amp/footer.tpl"}
  </body>
</html>



{* ================ *}
{* Особенности:
Автоматическая генерация AMP версии страниц полной новости.
Приставка /amp.html в конце ссылки полной новости. Например, у страницы http://сайт_ру/o-skripte/1-post1.html - версия AMP будет доступна по ссылке http://сайт ру/o-skripte/1-post1/amp.html .
Автоматическое добавление мета-тегов canonical и amphtml для индексации AMP версии страницы.
Готовый настроенный шаблон на базе smartphone. Добавлены выезжающее меню и блок "поделиться". *}
