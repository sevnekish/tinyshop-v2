<div class="container">
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
</div>
