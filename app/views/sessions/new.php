{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div>

    <form class="form-signin" action="/login" method="post">

      <h2 class="form-signin-heading">Please sign in</h2>

      <label>Email</label>
      <input name="email" id="inputEmail" class="form-control" type="email" autofocus="" required="" >

      <label>Password</label><a href="/password_resets/new"> (forgot password)</a>
      <label class="sr-only" for="inputPassword">Password</label>
      <input name="password" id="inputPassword" class="form-control" type="password" required="" autocomplete="off">
      <div class="checkbox">
        <label>
          <input name= "remember_me" type="checkbox" value="remember_me">
          Remember me
        </label>
      </div>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p>New user? <a href="/users/new">Sign up now</a></p>
      {% if forward_url %}
        <div class="panel panel-warning" role="alert">You will redirect to "{{ forward_url }}" upon sign in</div>
      {% endif %}
    </form>
    </div>
  </div>
{% endblock %}