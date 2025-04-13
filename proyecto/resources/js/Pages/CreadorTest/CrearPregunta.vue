<script>
import { router } from '@inertiajs/vue3';
import PreguntasAleatorias from '../Components/PreguntasAleatorias.vue';

export default {
    data() {
        return {
            /*Las variables que están en inglés están así para que coincidan 
            con el nombre de los campos de la tabla en la base de datos*/  
            question: '',
            image: null,
            formulario: {}
        }
    },
    methods: {
        /*Metodo submit personalizado, que envia una petición POST 
        con un objeto que contiene los valores de los campos del formulario*/
        submit() {
            router.post('/test/crear/pregunta', 
            this.formulario = {
                question: this.question,
                image: this.image
            })
        }
    },
    components: {
        PreguntasAleatorias,
    }
}
</script>

<template>

    <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-10 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Pregunta</h1>

        <form @submit.prevent="submit" enctype="multipart/form-data">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="question">Introduce una pregunta</label>
            <textarea v-model="question" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" name="question" id="question" cols="30" rows="5" required></textarea>

            <label class="block my-2 text-xl  w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="image">Imagen</label>
            <input @input="image = $event.target.files[0]" type="file" name="image" id="image">
            
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