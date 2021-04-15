<div class="container">
  <div class="row">
    <div class="col s12 m6">
      <div class="row">
        <div class="col s12">
          <h5 class="text-center">Login</h5>
        </div>
      <form class="col s12" action="./login.php" method="POST">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">email</i>
              <input id="email" name="email" type="email" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock</i>
              <input id="password" name="password" type="password" class="validate">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12 offset-m1">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="row">
        <div class="col s12">
          <h5 class="text-center">Register</h5>
        </div>
      <form class="col s12" action="./register.php" method="POST">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input name="name_register" id="name_register" type="text" class="validate">
              <label for="name_register">Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">email</i>
              <input name="email_register" id="email_register" type="email" class="validate">
              <label for="email_register">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock</i>
              <input name="password_register" id="password_register" type="password" class="validate">
              <label for="password_register">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12 offset-m1">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
