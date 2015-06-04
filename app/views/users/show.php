{% extends "users/_account.php" %}

{% block account_content %}
  <div class="col-lg-6 col-md-6 col-sm-6">


    <div class="panel panel-info">

      <div class="panel-heading account-panel">
        <h3 class="panel-title">{{ current_user.name }}</h3>
        <a href="/users/{{ current_user.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 col-lg-3 " align="center">
            <img alt="User Pic" src="/content/images/user.png" class="img-circle"> 
          </div>


          <div class=" col-md-9 col-lg-9 "> 
            <table class="table table-user-information">
              <tbody>

                <tr>
                  <td>Email</td>
                  <td>{{ current_user.email }}</td>
                </tr>

                <tr>
                  <td>Phone Number</td>
                  <td>{{ current_user.telephone }}</td>
                </tr>

                <tr>
                  <td>Home Address</td>
                  <td>{{ current_user.address }}</td>
                </tr>

              </tbody>
            </table>

            <br>
          </div>
        </div>
      </div>

    </div>

  </div>
{% endblock %}