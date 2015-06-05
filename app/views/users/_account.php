{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="list-group adminbar">
          {% if current_user.admin %}
            <a href="/admin_panel" class="list-group-item"><i class="fa fa-wrench"></i> Admin panel</a>
          {% endif %}
          <a href="/users/{{ current_user.id }}" class="list-group-item"><i class="fa fa-user"></i> Contact info</a>
          <a href="/users/{{ current_user.id }}/orders" class="list-group-item"><i class="fa fa-book"></i> Orders</a>
          <a href="/logout" class="list-group-item"><i class="fa fa-sign-out"></i> Log out</a>
        </div>
      </div>

      {% block account_content %}
      {% endblock %}

    </div>

  </div>
{% endblock %}