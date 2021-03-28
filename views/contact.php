<h1 class="text-center">
  Send us a message
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
      <label for="subject">
        Subject
      </label>
      <div class="input-group">
        <div class="input-group-text">
          <i class="fa fa-question"></i>
        </div>
        <input 
          name="subject" 
          type="text" 
          class="form-control">
        </div>
    </div>
    <div class="form-group">
      <label for="message">
        Type your message
      </label>
      <textarea 
        name="message"
        class="form-control"
        placeholder="Something interesting you may want to share with us?"></textarea>
    </div>
    <button 
      class="btn btn-md btn-success" 
      type="submit">
        Send Message
    </button>
  </div>
</form>