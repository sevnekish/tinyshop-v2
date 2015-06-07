{% extends "layouts/application.php" %}

{% block content %}

  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-4">
        <div class="list-group adminbar">
          <a href="/adminpanel/orders" class="list-group-item"><i class="fa fa-book"></i> Orders</a>
          <a href="/adminpanel/users" class="list-group-item"><i class="fa fa-users"></i> Users</a>
          <a href="/adminpanel/categories/new" class="list-group-item"><i class="fa fa-plus"></i> Add new category</a>
          <a href="/adminpanel/brands/new" class="list-group-item"><i class="fa fa-plus"></i> Add new brand</a>
          <a href="/adminpanel/items/new" class="list-group-item"><i class="fa fa-plus"></i> Add new product</a>
          <a href="/logout" class="list-group-item"><i class="fa fa-sign-out"></i> Log out</a>
        </div>
      </div>

    {% block admin_panel_content %}
    {% endblock %}

    </div>

  </div>

{% endblock %}