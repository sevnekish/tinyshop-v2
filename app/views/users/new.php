{% extends "layouts/application.php" %}

{% block content %}
  <div class="container">
    <div class="registration-form">

    <form class="form-signin" action="/users" method="post">

      <label>Name</label>
        <input name="name" type="text" value="{{ flash.prev_params.name }}" class="form-control input-xlarge" required>
      <label>Email</label>
        <input name="email" type="text" value="{{ flash.prev_params.email }}" class="form-control input-xlarge" required>

      <label>Password</label>
        <input id="password" type="password" name="password" type="text" value="" class="form-control input-xlarge" autocomplete="off" required>
      <label>Repeat Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" type="text" value="" class="form-control input-xlarge" autocomplete="off" required>
        
      <div class="row">
        <div class="col-sm-12">
          <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords Match
        </div>
      </div>

      <label>Telephone</label>
        <input name="telephone" type="text" value="{{ flash.prev_params.telephone }}" class="form-control input-xlarge" required>
      <label>Address</label>
      <textarea name="address" rows="3" class="form-control input-xlarge" required>{{ flash.prev_params.address }}</textarea>
      <br>
      <div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
      </div>
    </div>
  </div>
{% endblock %}