<?php
echo '<footer class="bg-dark text-white text-center py-2 fixed-bottom" style="padding-left: 15px; padding-right: 15px;">
  <div class="container-fluid">
    <p class="mb-0">Interfaz de cocina.</p>
    <div class="d-flex justify-content-center mt-1">

    </div>
  </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
// Get the modal
var modal = document.getElementById("id01");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src="https://kit.fontawesome.com/9459b47ce8.js" crossorigin="anonymous"></script>
</html>';
?>
