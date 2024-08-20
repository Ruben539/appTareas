import axios from 'axios'

import { StorageAdapter } from './adapter/asyncStorage'

//TODO: Recepcionamos la api declarada en el .env
const baseUrl = 'http://127.0.0.1:8000/api'


//FIXME: Creamos la conexion por medio de axios.
const tareasApi = axios.create(
    {
        baseURL: baseUrl,
        headers: {
          'Content-Type': 'application/json'
        }
    }
)

  //TODO: Interceptors para la utilizacion del token obtenido en el header de autenticacion.
  tareasApi.interceptors.request.use(
    async(config:any)=>{
        const token = await StorageAdapter.getItem('token')        
        if(token){
           config.headers['Authorization'] = `Bearer ${token}`
        }
        return config;
    }
)

  export {
  
    tareasApi,
  
  }

