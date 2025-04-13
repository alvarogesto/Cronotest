<script>
import { router } from '@inertiajs/vue3';

export default {
    data() {
        return {
            /*Las variables que están en inglés están así para que coincidan 
            con el nombre de los campos de la tabla en la base de datos*/              
            answer: '',
            correct: null,
            formulario: {}
        }
    },
    methods: {
        /*Metodo submit personalizado, que envia una petición POST 
        con un objeto que contiene los valores de los campos del formulario*/
        submit() {
            // Convierte el valor de correct a booleano usando un operador ternario
            const correctValue = this.correct === 'true' ? true : false;

            router.post('/test/crear/respuesta', 
            this.formulario = {
                answer: this.answer,
                correct: correctValue,
            });
        }
    }
}
</script>

<template>
    <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-4 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Respuesta</h1>

        <form @submit.prevent="submit">
            <label class="block mt-4 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="answer">Introduce una respuesta</label>
            <textarea v-model="answer" class="w-full my-2 text-custom-black focus:shadow-custom-sm focus:shadow-custom-black" name="answer" id="answer" cols="30" rows="2" required></textarea>
           
            <label class="block mt-2 text-xl w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="correct">¿Es la respuesta correcta?</label>
            <div class="flex my-2 ">
                <input v-model="correct" class="mx-2" type="radio" id="true" name="correct" value="true" required>
                <label class="text-lg" for="true">Si</label><br>
                <input v-model="correct" class="mx-2" type="radio" id="false" name="correct" value="false" required>
                <label class="text-lg" for="false">No</label><br>
            </div>
            
            <div class="flex justify-center">
                <button type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">
                Continuar
                </button>
            </div>
        </form>
  </div>
  
</template>

<style>

</style>