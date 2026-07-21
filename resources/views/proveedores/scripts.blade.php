<script>
    const API_PROV = '/api/proveedores'

    document.addEventListener('DOMContentLoaded', function() {
    listarProveedores()
    })

    async function listarProveedores() {
        const response = await fetch(API_PROV)
        const proveedores = await response.json()

        let tbody = document.getElementById('tbody-proveedores')
        let html = ''

        proveedores.forEach(proveedor => {
            html += `
                <tr>
                    <td>${proveedor.nombre}</td>
                    <td>${proveedor.ruc ?? ''}</td>
                    <td>${proveedor.telefono ?? ''}</td>
                    <td>${proveedor.correo ?? ''}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editarProveedor(${proveedor.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarProveedor(${proveedor.id})"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `
        })
        tbody.innerHTML = html
    }

    function nuevoProveedor() {
        document.getElementById('tituloModalProveedor').innerHTML = 'Nuevo Proveedor'
        document.getElementById('formProveedor').reset()
        document.getElementById('idProveedor').value = ''
    }

    async function editarProveedor(id) {
        const response = await fetch(`${API_PROV}/${id}`)
        const proveedor = await response.json()

        document.getElementById('tituloModalProveedor').innerHTML = 'Editar Proveedor'
        document.getElementById('idProveedor').value = proveedor.id
        document.getElementById('nombreProveedor').value = proveedor.nombre
        document.getElementById('ruc').value = proveedor.ruc ?? ''
        document.getElementById('telefono').value = proveedor.telefono ?? ''
        document.getElementById('correoProveedor').value = proveedor.correo ?? ''

        new bootstrap.Modal(document.getElementById('modalProveedor')).show()
    }

    let formularioProveedor = document.getElementById('formProveedor')
    formularioProveedor.addEventListener('submit', async function (e) {
        e.preventDefault()

        const id = document.getElementById('idProveedor').value
        const url = id === '' ? API_PROV : `${API_PROV}/${id}`
        const data = new FormData(formularioProveedor)

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
            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalProveedor'))
            modal.hide()
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove())
            document.body.classList.remove('modal-open')
            document.body.style.removeProperty('overflow')
            document.body.style.removeProperty('padding-right')
            listarProveedores()
            }
    })

    async function eliminarProveedor(id) {
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
            const response = await fetch(`${API_PROV}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })

            const resultado = await response.json()
            listarProveedores()

            await Swal.fire({
                title: '¡Eliminado!',
                text: resultado.message,
                icon: 'success'
            })
        }
    }
</script>