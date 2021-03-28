<?php



?>

<h1 class="text-center">
  Sign into your account
</h1>

<form method="post" class="row p-3">
  <div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-2 mx-auto shadow bg-body rounded">
    <div class="form-group">
      <label for="email">
        Email
      </label>
      <div class="input-group">
        <div class="input-group-text">
          <i class="fa fa-envelope"></i>
        </div>
        <input 
          name="email" 
          type="email" 
          class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="password">
        Password
      </label>
      <div class="input-group">
        <div class="input-group-text">
          <i class="fa fa-lock"></i>
        </div>
        <input 
          name="password" 
          type="password" 
          class="form-control">
        </div>
    </div>
    <button 
      class="btn btn-md btn-primary" 
      type="submit">
        Login
    </button>
  </div>
</form>