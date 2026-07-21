<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formCategoria">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModalCategoria">Nueva Categoría</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idCategoria">
                    <div class="mb-3">
                        <label for="nombreCategoria" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreCategoria" name="nombre" placeholder="Electrónica" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionCategoria" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcionCategoria" name="descripcion" placeholder="Descripción de la categoría">
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