{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div class="row">
      <form class="form-signin" action="/password_resets/{{ reset_digest }}" method="post">
        <h1>Reset password</h1>
          
          <input id="email" type="hidden" name="email" value="{{ email }}" class="form-control input-xlarge" required>
        <label>Password</label>
          <input id="password" type="password" name="password" type="text" value="" class="form-control input-xlarge" autocomplete="off" required>
        <label>Repeat Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" type="text" value="" class="form-control input-xlarge" autocomplete="off" required>
          
        <br>
        <div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Update password</button>
        </div>
      </form>
    </div>
  </div>
{% endblock %}