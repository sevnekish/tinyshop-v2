{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div class="row">
      <form class="form-signin" action="/password_resets" method="post">
        <h1>Forgot password</h1>

        <label>Email</label>
        <input name="email" id="inputEmail" class="form-control" type="email" autofocus="" required="" >
        <br>
        <div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
{% endblock %}