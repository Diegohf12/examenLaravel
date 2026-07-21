<script>
    const API = '/api/productos'

    document.addEventListener('DOMContentLoaded', function() {
        listarProductos()
    })

    async function listarProductos() {
        const response = await fetch(API)
        const productos = await response.json()

        let tbody = document.getElementById('tbody-productos')
        let html = ''

        productos.forEach(producto => {
            html += `
                <tr>
                    <td>${producto.nombre}</td>
                    <td>${producto.descripcion ?? ''}</td>
                    <td>S/ ${producto.precio}</td>
                    <td>${producto.stock}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarProducto(${producto.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarProducto(${producto.id})"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `
        })
        tbody.innerHTML = html
    }

    function nuevoProducto() {
        document.getElementById('tituloModalProducto').innerHTML = 'Nuevo Producto'
        document.getElementById('formProducto').reset()
        document.getElementById('idProducto').value = ''
    }

    async function editarProducto(id) {
        try {
            const response = await fetch(`${API}/${id}`)
            const producto = await response.json()

            document.getElementById('tituloModalProducto').innerHTML = 'Editar Producto'
            document.getElementById('idProducto').value = producto.id
            document.getElementById('nombre').value = producto.nombre
            document.getElementById('descripcion').value = producto.descripcion ?? ''
            document.getElementById('precio').value = producto.precio
            document.getElementById('stock').value = producto.stock

            const modalEl = document.getElementById('modalProducto')
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl)
            modal.show()
        } catch (error) {
            console.error('Error al editar:', error)
        }
    }

    document.getElementById('formProducto').addEventListener('submit', async function (e) {
        e.preventDefault()

        const id = document.getElementById('idProducto').value
        const url = id === '' ? API : `${API}/${id}`
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
            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalProducto'))
            modal.hide()
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove())
            document.body.classList.remove('modal-open')
            document.body.style.removeProperty('overflow')
            document.body.style.removeProperty('padding-right')
            listarProductos()
        }
    })

    async function eliminarProducto(id) {
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
            const response = await fetch(`${API}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })

            const resultado = await response.json()
            listarProductos()

            await Swal.fire({
                title: '¡Eliminado!',
                text: resultado.message,
                icon: 'success'
            })
        }
    }
</script>