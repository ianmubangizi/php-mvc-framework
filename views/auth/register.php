<h1 class="text-center">
  Sign up for your account
</h1>

<form method="post" class="row p-3">
  <div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-2 mx-auto shadow bg-body rounded">
      <div class="form-group">
        <label for="first_name">
          First name
        </label>
        <input 
          name="first_name" 
          type="text" 
          class="form-control">
      </div>
      <div class="form-group">
        <label for="last_name">
          Last name
        </label>
        <input 
          name="last_name" 
          type="text" 
          class="form-control">
      </div>
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
    <div class="form-group">
      <label for="confirm_password">
        Confirm Password
      </label>
      <div class="input-group">
        <div class="input-group-text">
          <i class="fa fa-lock"></i>
        </div>
        <input 
          name="confirm_password" 
          type="password" 
          class="form-control">
        </div>
    </div>
    <button 
      class="btn btn-md btn-primary" 
      type="submit">
        Submit
    </button>
  </div>
</form>