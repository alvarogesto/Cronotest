<script>
import { router } from '@inertiajs/vue3'

export default {
    props: {
        usuario: Object
    },
    data() {
        return {
            //Las variables que están en inglés están así para que coincidad con el nombre de los campos de la tabla en la base de datos            
            name: this.usuario.name,
            username: this.usuario.username,
            description: this.usuario.description,
            avatar: this.usuario.avatar,
            email: this.usuario.email,
            formulario: {},
            data: {}
        }
    },
    methods: {
        submit() {
            if (this.password == this.verifyPassword) {
                router.patch('/perfil/editar', 
                this.formulario = {
                    name: this.name,
                    username: this.username,
                    description: this.description,
                    email: this.email,
                    avatar: this.avatar
                })
            }
        },
        actualizarAvatar() {
            router.post('/perfil/avatar', 
            this.formulario = {
                avatar: this.avatar
            })
        },
        volver() {
            // Utiliza window.history para volver a la página anterior
            window.history.back();
        },
    }
}
</script>

<template>

    <div class="flex flex-col justify-center bg-custom-purple w-8/12 md:w-6/12 xl:w-4/12 2xl:w-3/12 m-8 p-10 shadow-custom-lg shadow-custom-blue">
        
        <h3 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Cambiar avatar</h3>
        
        <form @submit.prevent="actualizarAvatar">
            <label class="block mt-4 text-xl w-fit my-2 p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="avatar">avatar</label>
            <input @input="avatar = $event.target.files[0]" type="file" name="avatar" id="avatar">

            <button @click="actualizarAvatar" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-white rounded my-6 py-2 px-4">Cambiar Avatar</button>
        </form>
        
        <h3 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Editar perfil</h3>
        
        <form @submit.prevent="submit">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="name">Nombre</label>
            <input v-model="name" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="name" id="name" required>

            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="username">Nombre de usuario</label>
            <input v-model="username" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="username" id="username" :placeholder="usuario.username" required>

            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="email">Correo</label>
            <input v-model="email" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="email" id="email" :placeholder="usuario.email" required>
            
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="description">Descripción</label>
            <textarea v-model="description" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" name="description" id="description" :placeholder="usuario.description"></textarea>

            <div class="flex justify-between my-6">
                <button @click="volver" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-white rounded py-2 px-4">Volver</button>
                <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-white border border-custom-white hover:border-custom-white font-semibold hover:text-custom-black hover:shadow-custom-sm hover:shadow-custom-black rounded py-2 px-4">Aplicar cambios</button>
            </div>
        </form>
  </div>
  
</template>

<style>

</style>