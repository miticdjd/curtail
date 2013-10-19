Curtail
=======

Curtail is small PHP script for combinating and caching javascript and css files.

Using
-----

To use curtail you need to have one directory for css and one directory for javascript files. This script combine this css and javascript files and create one request on server for css files and one requeste for javascript files and compress this files.

In this way you reduce requests to server for css and javascript files and loading this files from browser cache.

If you want to load this css files:
ui-lightness/jquery-ui-1.10.3.custom.min.css
bootstrap.min.css
bootstrap-theme.min.css

from folder css you don't need to call them individually like this:
<link rel="stylesheet" href="/css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-theme.min.css">

With curtail you can do in this way:
<link rel="stylesheet" href="/css/ui-lightness/jquery-ui-1.10.3.custom.min.css,bootstrap.min.css,bootstrap-theme.min.css">