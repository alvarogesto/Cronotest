<script>
import { router } from '@inertiajs/vue3';

export default {
    data() {
        return {
            accion: '',
            formulario: {}
        }
    },
    methods: {
        /*Metodo submit personalizado, que envia una petición POST 
        con un objeto que contiene los valores de los campos del formulario*/
        submit() {
            router.post('/test/crear/accion', 
            this.formulario = {
                accion: this.accion
            });
        }
    }
}
</script>

<template>
    <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-4 shadow-custom-lg shadow-custom-blue">
        <h1 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">¿Qué quieres hacer?</h1>

        <form @submit.prevent="submit">
            <input v-model="accion" class="mt-3 mx-2" type="radio" id="addAnswer" name="accion" value="addAnswer" required>
            <label class="text-lg" for="addAnswer">Añadir otra respuesta</label><br>
            <input v-model="accion" class="m-2" type="radio" id="addQuestion" name="accion" value="addQuestion" required>
            <label class="text-lg" for="addQuestion">Añadir otra pregunta</label><br>
            <input v-model="accion" class="m-2" type="radio" id="finishTest" name="accion" value="finishTest" required>
            <label class="text-lg" for="finishTest">Terminar el test</label><br>
            
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