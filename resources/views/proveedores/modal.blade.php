<div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="modalProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formProveedor">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModalProveedor">Nuevo Proveedor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idProveedor">
                    <div class="mb-3">
                        <label for="nombreProveedor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreProveedor" name="nombre" placeholder="Empresa S.A.C." maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="ruc" class="form-label">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" placeholder="20123456789" maxlength="15">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="987654321" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="correoProveedor" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correoProveedor" name="correo" placeholder="contacto@empresa.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>