{% extends "users/_account.php" %}

{% block account_content %}
  <div class="container">
    <div class="registration-form">

    <form class="form-signin" action="/users/{{ current_user.id }}" method="post">

      <label>Name</label>
        <input name="name" type="text" value="{{ current_user.name }}" class="form-control input-xlarge" required>

      <label>Password</label>
        <input id="password" type="password" name="password" type="text" value="" class="form-control input-xlarge" autocomplete="off">
      <label>Repeat Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" type="text" value="" class="form-control input-xlarge" autocomplete="off">
        
      <div class="row">
        <div class="col-sm-12">
          <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords Match
        </div>
      </div>

      <label>Telephone</label>
        <input name="telephone" type="text" value="{{ current_user.telephone }}" class="form-control input-xlarge" required>
      <label>Address</label>
      <textarea name="address" rows="3" class="form-control input-xlarge" required>{{ current_user.address }}</textarea>
      <br>
      <div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
      </div>
    </div>
  </div>
{% endblock %}