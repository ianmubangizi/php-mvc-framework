<h3><?= $message ?></h3>

<form class="row g-3" method="post">
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Send Message</button>
  </div>
</form>
