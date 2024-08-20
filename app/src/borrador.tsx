<table className="table table-hover">
					<thead >
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripcion de la Tarea</th>
							<th>Estado</th>
							<th>Editar</th>
							<th>Rechazar</th>
							<th>Eliminar</th>
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
								<td>
									<button className="btn btn-primary">Editar</button>
								</td>
								<td>
									<button className="btn btn-warning">Rechazar</button>
								</td>
								<td>
									<button className="btn btn-danger">Eliminar</button>
								</td>
							</tr>
						))}
					</tbody>
				</table>