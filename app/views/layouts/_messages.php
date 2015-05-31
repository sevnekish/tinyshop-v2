<div class="container">
  {% if flash.messages %}
    {% for type, messages_array in flash.messages %}
      <div class="alert alert-{{ type }}" role="alert">
        <ul>
          {% for message in messages_array %}
            <li>{{ message }}</li>
          {% endfor %}
        </ul>
      </div>
    {% endfor %}
  {% endif %}
  {% if flash.debug_info %}
    {% for type, messages_array in flash.debug_info %}
      <div class="alert alert-{{ type }}" role="alert">
        <ul>
          {% for message in messages_array %}
            <li>{{ message }}</li>
          {% endfor %}
        </ul>
      </div>
    {% endfor %}
  {% endif %}
</div>
