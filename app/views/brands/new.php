{% extends "admin_panel/_admin_panel.php" %}

{% block admin_panel_content %}
  <div class="col-lg-6 col-md-6 col-sm-6">

      <form name="addcategory" class="form-new-item" action="/brands" enctype="multipart/form-data" method="post">

        <label>Add brand</label>
          <input name="brand" type="text" value="" class="form-control input-xlarge" autocomplete="off" required>
        <div>
          <button class="btn btn-lg btn-primary pull-right btn-adminbar" type="submit">Add brand</button>
        </div>
      </form>

  </div>
{% endblock %}