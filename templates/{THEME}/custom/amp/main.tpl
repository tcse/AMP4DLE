<!doctype html>
<html ⚡ lang="ru">

<head>
    <meta charset="utf-8">
    <title>{title} - {site-name}</title>
    <meta name="description" content="{description}">
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
    <noscript>
      <style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style>
    </noscript>
    <link rel="canonical" href="{full-link}">
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
          "name": "{login}"
      },
      "publisher": {
          "@type": "Organization",
          "name": "{site-name}",
          "logo": {
              "@type": "ImageObject",
              "url": "/engine/skins/images/amp4dle.png",
              "width": 140,
              "height": 140
          }
      },
      "image": {
          "@type": "ImageObject",
          "url": "/engine/skins/images/amp4dle.png",
          "height": 210,
          "width": 210
      }
    }
    </script>
</head>

<body>
    <!-- Start Navbar -->
    {include file="custom/amp/navbar.tpl"}
    <!-- End Navbar -->
    {include file="custom/amp/fullstory.tpl"}
    {include file="custom/amp/footer.tpl"}
</body>

</html>