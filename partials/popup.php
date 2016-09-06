<div class="popup">
  <div class="container">
    <div class="popup__content">
      <button class="popup__close" data-popup-toggle>
        <i class="icon icon_close"></i>
        <span class="sr-only">Close</span>
      </button>
      
      <h2 class="headline headline_xl text-center">Submit</h2>

      <div class="form__message">
        <p class="headline headline_thin">Thank you for your contribution. The submission was sent to the website owners for review.</p>
      </div>

      <form action="#" method="post" class="form">
        <div class="form__field">
          <div class="form__child">
            <input type="text" name="name" placeholder="Resource name" required>
          </div>
          <div class="form__child">
            <input type="text" name="description" placeholder="Description">
          </div>
        </div>
        <div class="form__field">
          <div class="form__child">
            <select name="category" data-placeholder="Category" class="custom-select" required>
              <option value=""></option>
              <option value="design">Design</option>
              <option value="development">Development</option>
              <option value="technology">Technology</option>
              <option value="products">Products</option>
              <option value="apps">Apps</option>
              <option value="podcasts">Podcasts</option>
            </select>
          </div>
          <div class="form__child">
            <input type="url" name="url" placeholder="Website URL" required>
          </div>
        </div>
        <div class="form__field form__field_separated">
          <div class="form__child">
            <input type="text" name="submitter_name" placeholder="Your name" required>
          </div>
          <div class="form__child">
            <input type="email" name="submitter_email" placeholder="Your email" required>
          </div>
        </div>
        <div class="form__field">
          <button type="submit" class="button button_secondary">Submit</button>
        </div>
      </form>
    </div>
    <div class="popup__loader"></div>
  </div>
</div>
<!-- /.popup -->
