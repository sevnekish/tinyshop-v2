<?if(!empty($success)):?>
  <div class="alert alert-success" role="alert"><?=$success?></div>
<?endif;?>

<?if(!empty($error)):?>
  <div class="alert alert-danger" role="alert"><?=$error?></div>
<?endif;?>

<!-- to this -->

{% if sucess %}
  <div class="alert alert-success" role="alert">
    <ul>
      {% for message in success %}
        <li>{{ message }}</li>
      {% endfor %}
    </ul>
  </div>
{% endif %}

{% if error %}
  <div class="alert alert-danger" role="alert">
    <ul>
      {% for message in error %}
        <li>{{ message }}</li>
      {% endfor %}
    </ul>
  </div>
{% endif %}


{% if info %}
  <div class="alert alert-info" role="alert">
    <ul>
      {% for message in info %}
        <li>{{ message }}</li>
      {% endfor %}
    </ul>
  </div>
{% endif %}

<!-- to this -->

<!-- change error to danger -->
{% if messages %}
  {% for type, messages_array in messages %}
    <div class="alert alert-{{ type }}" role="alert">
      <ul>
        {% for message in messages_array %}
          <li>{{ message }}</li>
        {% endfor %}
      </ul>
    </div>
  {% endfor %}
{% endif %}