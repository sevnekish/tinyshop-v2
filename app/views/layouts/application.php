<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ title }}</title>

    {% include 'layouts/_shim.php' %}

    <link href="/content/css/application.css" rel="stylesheet">

  </head>
  <body>
  
  {% include 'layouts/_header.php' %}

  {% block content %}
  {% endblock %}

  {% include 'layouts/_footer.php' %}

  {% include 'layouts/_scripts.php' %}

  </body>
</html>