</div>

 <!-- Footer -->
  <footer class="bg-white border-top py-4 mt-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="text-muted mb-0">&copy; 2024 Comeya. Todos los derechos reservados.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p class="text-muted mb-0">Hecho con  para restaurantes</p>
        </div>
      </div>
    </div>
  </footer>
   <!-- JS Locales -->
  <script src="<?= base_url('public/assets/js/libs.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/app.js') ?>"></script>
  <!-- Bootstrap 5 JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Modal de Bienvenida -->
  <div class="modal fade" id="welcomeModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 p-0">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white rounded-circle p-2" data-bs-dismiss="modal" style="z-index: 1050;"></button>
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&h=600&fit=crop" class="img-fluid w-100" alt="Bienvenida" style="border-radius: 0.5rem;">
      </div>
    </div>
  </div>

  <script>
    // Modal de bienvenida que aparece solo una vez
    if (!localStorage.getItem('welcomeModalShown')) {
      setTimeout(() => {
        new bootstrap.Modal(document.getElementById('welcomeModal')).show();
        localStorage.setItem('welcomeModalShown', 'true');
      }, 2000);
    }
  </script>
</body>
</html>