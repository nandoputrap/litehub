    <!-- ALL JS HERE -->
    <script src="js/jquery-3.4.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script>
  $(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      margin: 10,
      nav: true,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    })
  })
</script>
  </body>
</html>
