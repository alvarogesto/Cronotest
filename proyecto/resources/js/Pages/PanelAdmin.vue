<script>
import { router } from '@inertiajs/vue3'

export default {
    props: {
        usuario: Object
    },
    data() {
        return {
            category: '',
            language: '',
            data: {}
        }
    },
    methods: {
        submitCategoria() {
            router.post('/perfil/admin/categoria', this.data = {
                category: this.category
            })

            // Luego de hacer el POST limpio el campo
            this.category = '';
        },
        submitIdioma() {
            router.post('/perfil/admin/idioma', this.data = {
                language: this.language
            })

            // Luego de hacer el POST limpio el campo
            this.language = '';
        },
        volver() {
            // Utiliza window.history para volver a la página anterior
            window.history.back();
        },
    }
}
</script>

<template>

    <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-5 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Panel de administrador</h1>

        <h3 class="block mt-4 text-xl w-full p-1 font-semibold text-center bg-custom-blue shadow-custom-sm shadow-custom-black">Añadir elementos</h3>

        <form @submit.prevent="submitCategoria">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="name">Categoria</label>
            <input v-model="category" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="name" id="name">

            <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded my-3 py-2 px-4">
                Añadir categoría
            </button>
        </form>

        <form @submit.prevent="submitIdioma">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="language">Idioma</label>
            <input v-model="language" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="language" id="language">

            <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded my-3 py-2 px-4">
                Añadir idioma
            </button>
        </form>

        <button @click="volver" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-white rounded py-2 px-4">Volver</button>
    </div>
  
</template>

<style>

</style>