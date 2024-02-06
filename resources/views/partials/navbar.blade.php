<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="font-family: Times New Roman, Times, serif;">
  <div class="container">
    <a class="navbar-brand" href="/home">E-Archive POLDA DIY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link {{ (request()->path() === "home") ? 'active' : '' }}" href="/home">
          Home<span class="sr-only">(current)</span>
        </a>
        <!-- <a class="nav-link {{ (request()->path() === "about") ? 'active' : '' }}" href="/about">
          About
        </a> -->
        <a class="nav-link {{ (request()->path() === "mails") ? 'active' : '' }}" href="/mails">
          Daftar Surat
        </a>
        <!-- <a class="nav-link" href="/logout"><i class="bi bi-box-arrow-right"></i></a> -->
        <a class="nav-link" href="#" id="logout-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
  
      </div>
    </div>
        {{-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
  </div>
</nav>

<!-- Masukkan ini di dalam bagian <head> atau sebelum penutup </body> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var logoutLink = document.getElementById("logout-link");
        
        if (logoutLink) {
            logoutLink.addEventListener("click", function(event) {
                event.preventDefault();
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    window.location.href = '/logout'; // Ganti dengan URL logout yang sesuai
                }
            });
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>