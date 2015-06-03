{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div>

    <form class="form-signin" action="/login" method="post">

      <h2 class="form-signin-heading">Please sign in</h2>

      <input name="email" id="inputEmail" class="form-control" type="email" autofocus="" required="" placeholder="Email address">
      <label class="sr-only" for="inputPassword">Password</label>
      <input name="password" id="inputPassword" class="form-control" type="password" required="" placeholder="Password" autocomplete="off">
      <div class="checkbox">
        <label>
          <input name= "remember_me" type="checkbox" value="remember_me">
          Remember me
        </label>
      </div>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      {% if urlRedirect %}
        <div class="panel panel-warning" role="alert">You will redirect to "{{ urlRedirect }}" upon login</div>
      {% endif %}
    </form>
    </div>
  </div>
{% endblock %}