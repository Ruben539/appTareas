import React, { useEffect, useState } from 'react'
import './App.css';
import { tareasApi } from './api/tareasApi'

export const App = () => {

	const [tareas, setTareas] = useState([])
	const [pendientes, setPendientes] = useState(0)
	const [proceso, setProceso] = useState(0)
	const [terminado, setTerminado] = useState(0)
	const [nombre, setNombre] = useState('');
	const [responsable, setResponsable] = useState('');
	const [descripcion, setDescripcion] = useState('');


	const getAllTareas = async () => {
		const resp = await tareasApi.get('/app/tareas/listado')
		setTareas(resp.data)
	}

	const cantidadPendientes = async () => {
		const resp = await tareasApi.get('/app/tareas/count-pendiente')
		setPendientes(resp.data.cantidad)
	}


	const cantidadEnProceso = async () => {
		const resp = await tareasApi.get('/app/tareas/count-proceso')
		setProceso(resp.data.cantidad)
	}

	const cantidadTerminados = async () => {
		const resp = await tareasApi.get('/app/tareas/count-terminados')
		setTerminado(resp.data.cantidad)
	}

	useEffect(() => {
		getAllTareas()
		cantidadPendientes()
		cantidadTerminados()
		cantidadEnProceso()
	}, [])

	const onFormSubmit = (e) => {

		try {
			e.preventDefault()
			const tarea = {
				nombre,
				descripcion,
				responsable,
			}
			tareasApi.post('/app/tareas/crear', tarea).then((resp) => {
				alert(resp.data)
				getAllTareas()
				cantidadPendientes()
				cantidadTerminados()
				cantidadEnProceso()
			}).catch((error) => {
				alert('No se a podido agregar la tarea')
			})

		} catch (error) {
			console.log(error)
		}
	}

	//TODO: Funcion para cambiar el estado de la tarea a proceso.
	const tareaEnProceso = (id, estado) => {
		if (estado == 1) {
			const estado_id = 2

			const resp = tareasApi.put(`/app/tareas/actualizar-estado/${id}/${estado_id}`).then((resp) => {
				if (resp.data) {
					alert(resp.data)
					getAllTareas()
					cantidadPendientes()
					cantidadTerminados()
					cantidadEnProceso()
				} else {
					alert('No se pudo actualizar el estado')
				}
			})
		} else if (estado == 2) {
			alert('La tarea ya se encuentra en estado de Proceso')
		} else if (estado == 3) {
			alert('La tarea debe estar en proceso para que pueda ser terminada')
		}
	}

	//TODO: Funcion para cambiar la tarea a terminada.
	const tareaTerminada = (id, estado) => {

		if (estado == 1) {
			alert('La tarea debe estar en proceso para que pueda ser terminada')

		} else if (estado == 2) {
			const estado_id = 3
			const resp = tareasApi.put(`/app/tareas/actualizar-estado/${id}/${estado_id}`).then((resp) => {
				if (resp.data) {
					alert(resp.data)
					getAllTareas()
					cantidadPendientes()
					cantidadTerminados()
					cantidadEnProceso()
				} else {
					alert('No se pudo actualizar el estado')
				}
			})
		} else if (estado == 3) {
			alert('La tarea ya fue terminada por otro responsable')
		}
	}


	//TODO: Funcion para cambiar la tarea a terminada.
	const tareaEliminada = (id, estado) => {

		if (estado == 3) {
			alert('Una tarea terminada no puede ser eliminada')

		} else {
			const resp = tareasApi.delete(`/app/tareas/eliminar/${id}`).then((resp) => {
				if (resp.data) {
					alert(resp.data)
					getAllTareas()
					cantidadPendientes()
					cantidadTerminados()
					cantidadEnProceso()

				} else {
					alert('No se pudo eliminar la tarea')
				}
			})
		}
	}



	return (
		<>
			<div className='card-to-do'>
				<h1>Lista de tareas - N° Tareas: <span>{tareas.length}</span></h1>
				<div className='counter-todos'>
					<h3>
						Pendientes: <span className='text-danger'>{pendientes}</span>
					</h3>
					<h3>
						En Proceso: <span className='text-warning'>{proceso}</span>
					</h3>
					<h3>
						Terminados: <span className='text-success'>{terminado}</span>
					</h3>
				</div>

				<div className='add-todo'>
					<form onSubmit={onFormSubmit}>
						<input
							type='text'
							className='input-add'
							name='nombre'
							value={nombre}
							onChange={(e) => setNombre(e.target.value)}
							placeholder='Ingrese el nombre de la tarea'
						/>

						<input
							type='text'
							className='input-add'
							name='descripcion'
							value={descripcion}
							onChange={(e) => setDescripcion(e.target.value)}
							placeholder='Ingrese una descripcion de la tarea'
						/>

						<input
							type='text'
							className='input-add'
							name='responsable'
							value={responsable}
							onChange={(e) => setResponsable(e.target.value)}
							placeholder='Ingrese el responsable de la tarea'
						/>

						<button className='btn-add' type='submit'>
							Agregar
						</button>
					</form>

				</div>
				<br />
				<div className='table-responsive'>
					<table className="table  table-hover text-center table-bordered">
						<thead >
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Descripcion de la Tarea</th>
								<th>Estado</th>
								<th>Responsable</th>
								<th>Poner en Proceso</th>
								<th>Terminar Tarea</th>
								<th>Eliminar Tarea</th>
							</tr>
						</thead>
						<tbody>
							{tareas.map((tarea, index) => (
								<tr key={index}>
									<td style={{
										fontWeight: 'bold'
									}}>{tarea.id}</td>
									<td>{tarea.nombre}</td>
									<td>{tarea.tarea}</td>
									<td>{tarea.estado}</td>
									<td>{tarea.responsable}</td>
									<td>
										<button className="btn btn-outline-warning" onClick={() => tareaEnProceso(tarea.id, tarea.estado_id)}><i className="fas fa-user-check"></i></button>
									</td>
									<td>
										<button className="btn btn-outline-success" onClick={() => tareaTerminada(tarea.id, tarea.estado_id)}><i className="fas fa-check"></i></button>
									</td>
									<td>
										<button className="btn btn-outline-danger" onClick={() => tareaEliminada(tarea.id, tarea.estado_id)}><i className="fas fa-trash-alt"></i></button>
									</td>
								</tr>
							))}
						</tbody>
					</table>
				</div>
			</div>
		</>
	)
}

