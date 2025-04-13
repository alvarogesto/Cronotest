<script>
import { router } from '@inertiajs/vue3'

export default {
    data() {
        return {
            //Las variables que están en inglés están así para que coincidad con el nombre de los campos de la tabla en la base de datos            
            email: '',
            password: '',
            formulario: {}
        }
    },
    methods: {
        submit() {
            router.post('/login', 
            this.formulario = {
                email: this.email,
                password: this.password
            })
        }
    }
}
</script>

<template>

    <div class="flex flex-col justify-center bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-8 p-10 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Iniciar Sesión</h1>

        <form @submit.prevent="submit">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="email">Correo</label>
            <input v-model="email" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="email" id="email" required>
            
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="password">Contraseña</label>
            <input v-model="password" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="password" name="password" id="password" required>


            <div class="flex justify-center my-6">
                <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-white rounded py-2 px-4">Iniciar sesión</button>
            </div>
        </form>

        <p class="w-full text-center">¿No tienes una cuenta? <Link href="/registro" class="underline font-semibold">Regístrate aquí</Link></p>
  </div>
  
</template>

<style>

</style>