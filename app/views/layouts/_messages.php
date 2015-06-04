<div class="container">
  {% if flash['messages'] is defined %}
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

  {% if flash['debug_info'] is defined %}
    {% for type, messages_array in flash.debug_info %}
      {% if type == 'link' %}
        <div class="alert alert-info" role="alert">
          <ul>
            {% for link_type, link in messages_array %}
              <li><a href="{{ link }}">{{ link_type }}</a></li>
            {% endfor %}
          </ul>
        </div>
      {% else %}
        <div class="alert alert-{{ type }}" role="alert">
          <ul>
            {% for message in messages_array %}
              <li>{{ message }}</li>
            {% endfor %}
          </ul>
        </div>
      {% endif %}
    {% endfor %}
  {% endif %}
</div>
