        <!-- Footer Section Start -->
        <footer class="footer border-top">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    <li class="list-inline-item"><a href="../dashboard/extra/privacy-policy.html">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="../dashboard/extra/terms-of-service.html">Terms of Use</a></li>
                </ul>
                <div class="right-panel">
                    ©<script>
                        document.write(new Date().getFullYear())
                    </script> Comeya, Made with
                    <span class="text-gray">
                        <svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
                        </svg>
                    </span> by <a href="#">Leapcol site</a>.
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->
    </main>  
  
    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('assets/js/libs.min.js') ?>"></script>

    <!-- Dashboard Charts JavaScript -->
    <script src="<?= base_url('assets/js/charts/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/js/charts/apexcharts.js') ?>"></script>

    <!-- fslightbox JavaScript -->
    <script src="<?= base_url('assets/js/fslightbox.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    
    <!-- Notificaciones JavaScript -->
    <script>
        let ultimoPedidoId = localStorage.getItem('ultimo_pedido_id') || 0;

        function checkNuevosPedidos() {
            fetch(`<?= base_url('notificaciones/check') ?>?ultimo_id=${ultimoPedidoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.count > 0) {
                        mostrarNotificacion(`${data.count} nuevo${data.count > 1 ? 's' : ''} pedido${data.count > 1 ? 's' : ''} recibido${data.count > 1 ? 's' : ''}`);
                        actualizarDropdownNotificaciones(data.pedidos);
                        ultimoPedidoId = data.ultimo_id;
                        localStorage.setItem('ultimo_pedido_id', ultimoPedidoId);
                        
                        const badge = document.getElementById('notification-badge');
                        if (badge) badge.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function mostrarNotificacion(mensaje) {
            // Evitar duplicados
            const existing = document.querySelector('.order-notification');
            if (existing) existing.remove();
            
            const toast = document.createElement('div');
            toast.className = 'order-notification';
            toast.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="fas fa-bell me-2"></i>${mensaje}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }

        function actualizarDropdownNotificaciones(pedidos) {
            const container = document.getElementById('notificaciones-container');
            if (!container) return;
            
            if (pedidos.length === 0) {
                container.innerHTML = `
                    <div class="text-center p-3">
                        <p class="mb-0 text-muted">No hay notificaciones nuevas</p>
                    </div>
                `;
                return;
            }
            
            const html = pedidos.map(pedido => `
                <a href="<?= base_url('admin/pedidos') ?>" class="iq-sub-card">
                    <div class="d-flex align-items-center">
                        <div class="avatar-40 rounded-pill bg-soft-success p-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-shopping-cart text-success"></i>
                        </div>
                        <div class="ms-3 w-100">
                            <h6 class="mb-0">Nuevo pedido #${pedido.numero_pedido}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0">${pedido.cliente_nombre || 'Cliente'}</p>
                                <small class="float-end font-size-12">Ahora</small>
                            </div>
                        </div>
                    </div>
                </a>
            `).join('');
            
            container.innerHTML = html;
        }

        setInterval(checkNuevosPedidos, 10000);
        document.addEventListener('DOMContentLoaded', checkNuevosPedidos);
    </script>
    
    <!-- Superadmin JavaScript -->
    <script>
        function toggleEmpresa(empresaId, nuevoEstado) {
            if (confirm('¿Está seguro de cambiar el estado de esta empresa?')) {
                fetch('<?= base_url('admin/toggle-empresa') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        empresa_id: empresaId,
                        activo: nuevoEstado
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado de la empresa');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
            }
        }
    </script>

</body>

</html>