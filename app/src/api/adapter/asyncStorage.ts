export class StorageAdapter {

    static async getItem(key: string): Promise<String | null> {
        try {

            const value = await localStorage.getItem(key)
            return value

        } catch (error) {

            return null
        }
    }

    static async setItem(key: string, value: string): Promise<void> {
        try {
            await localStorage.setItem(key, value)
        } catch (error) {
            throw new Error(`No se pudo guardar el token: ${key} ${value}`)
        }

    }

    static async removeItem(key: string): Promise<void> {
        try {
            await localStorage.removeItem(key)
        } catch (error) {
            console.log(error)
            throw new Error(`Error al remover el: ${key}`)
        }
    }
}