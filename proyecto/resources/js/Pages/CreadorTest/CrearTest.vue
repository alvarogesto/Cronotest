<script>
import { router } from '@inertiajs/vue3';
import PreguntasAleatorias from '../Components/PreguntasAleatorias.vue';

export default {
    props: {
        categories: Object,
        languages: Object
    },
    data() {
        return {
            /*Las variables que están en inglés están así para que coincidan 
            con el nombre de los campos de la tabla en la base de datos*/  
            title: '',
            language: '',
            description: '',
            category: '',
            language: '',
            image: null,
            formulario: {}
        }
    },
    methods: {
        /*Metodo submit personalizado, que envia una petición POST 
        con un objeto que contiene los valores de los campos del formulario*/
        submit() {
            router.post('/test/crear', 
            this.formulario = {
                title: this.title,
                description: this.description,
                category: this.category,
                language: this.language,
                image: this.image,
            })
        },
    },
    components: {
        PreguntasAleatorias,
    }
}
</script>

<template>

    <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-5 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Información general</h1>

        <form @submit.prevent="submit">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="title">Título</label>
            <input v-model="title" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" type="text" name="title" id="title" required>

            <label class="block mt-2 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="category">Categoría</label>
            <select v-model="category" class="text-custom-black my-2 focus:shadow-custom-sm focus:shadow-custom-black" id="category"  required>
                <option v-for="category in categories" :key="category.name" :value="category.id">{{ category.name }}</option>
            </select>

            <label class="block mt-2 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="language">Idioma</label>
            <select v-model="language" class="text-custom-black my-2 focus:shadow-custom-sm focus:shadow-custom-black" id="language"  required>
                <option v-for="language in languages" :key="language.name" :value="language.id">{{ language.name }}</option>
            </select>
            
            <label class="block my-2 text-xl  w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="image">Imagen</label>
            <input @input="image = $event.target.files[0]" type="file" name="image" id="image">

            <label class="block mt-2 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="description">Descripción</label>
            <textarea v-model="description" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" name="description" id="description" cols="30" rows="10"></textarea>
            
            <div class="flex justify-center w-full">
                <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">
                Continuar
                </button>
            </div>
        </form>

        <PreguntasAleatorias></PreguntasAleatorias>
    </div>
  
</template>

<style>

</style>