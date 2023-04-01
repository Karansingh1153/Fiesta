<div class="row mx-auto contact" id="contact">
  <h1 class="text-center my-5" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-duration="500">Contact Us</h1>
  <div class="col-md-10 mx-auto">
    <div class="row mx-auto contact-col-reverse my-5">
      <div class="col-12 col-md-12 col-lg-6 contact-content" data-aos="zoom-in-up" data-aos-duration="1000">
        <form action="../wb/contactBack.php" method="post">
          <?php
          if (isset($_GET['error'])) {
          ?>
            <div class="error-space">
              <p class="error text-center"><?php echo $_GET['error']; ?></p>
            </div>
          <?php } ?>
          <input type="text" name="name" id="name" pattern="[A-Za-z0-9_]{2,20}" class="w-100 my-2" required placeholder="Name">
          <input type="email" class="w-100 my-2" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email">
          <div class="d-flex my-3 flex-column">
            <textarea name="message" id="message" cols="10" rows="4" placeholder="Message"></textarea>
          </div>
          <div class="mx-auto d-flex justify-content-center">
            <button class="btn my-2" type="submit">Send</button>
          </div>
        </form>
      </div>
      <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-enter align-items-center google-map" data-aos="zoom-in-up" data-aos-duration="1000">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235013.70770006668!2d72.43930992910548!3d23.02049747101609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1679159105642!5m2!1sen!2sin" frameborder="0" style="border:0; width: 100%; height:100%;" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>