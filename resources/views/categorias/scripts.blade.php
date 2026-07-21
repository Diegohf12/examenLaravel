<script>
    const API_CAT = '/api/categorias'

    document.addEventListener('DOMContentLoaded', function() {
        listarCategorias()

        document.getElementById('formCategoria').addEventListener('submit', async function (e) {
            e.preventDefault()

            const id = document.getElementById('idCategoria').value
            const url = id === '' ? API_CAT : `${API_CAT}/${id}`
            const data = new FormData(this)

            if (id !== '') {
                data.append('_method', 'PUT')
            }

            const response = await fetch(url, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: data
            })

            if (response.ok) {
            this.reset()
            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCategoria'))
            modal.hide()
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove())
            document.body.classList.remove('modal-open')
            document.body.style.removeProperty('overflow')
            document.body.style.removeProperty('padding-right')
            listarCategorias()
            }
        })
    })

    async function listarCategorias() {
        const response = await fetch(API_CAT)
        const categorias = await response.json()

        let tbody = document.getElementById('tbody-categorias')
        let html = ''

        categorias.forEach(categoria => {
            html += `
                <tr>
                    <td>${categoria.nombre}</td>
                    <td>${categoria.descripcion ?? ''}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarCategoria(${categoria.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarCategoria(${categoria.id})"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `
        })
        tbody.innerHTML = html
    }

    function nuevaCategoria() {
        document.getElementById('tituloModalCategoria').innerHTML = 'Nueva Categoría'
        document.getElementById('formCategoria').reset()
        document.getElementById('idCategoria').value = ''
    }

    async function editarCategoria(id) {
        try {
            const response = await fetch(`${API_CAT}/${id}`)
            const categoria = await response.json()

            document.getElementById('tituloModalCategoria').innerHTML = 'Editar Categoría'
            document.getElementById('idCategoria').value = categoria.id
            document.getElementById('nombreCategoria').value = categoria.nombre
            document.getElementById('descripcionCategoria').value = categoria.descripcion ?? ''

            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCategoria')).show()
        } catch (error) {
            console.error('Error al editar:', error)
        }
    }

    async function eliminarCategoria(id) {
        const result = await Swal.fire({
            title: '¿Estás seguro(a)?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        })

        if (result.isConfirmed) {
            const response = await fetch(`${API_CAT}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })

            const resultado = await response.json()
            listarCategorias()

            await Swal.fire({
                title: '¡Eliminado!',
                text: resultado.message,
                icon: 'success'
            })
        }
    }
</script>