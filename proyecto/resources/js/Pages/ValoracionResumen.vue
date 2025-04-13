<script>
import Valoracion from './Components/Valoracion.vue';
import Resumen from './Components/Resumen.vue';
import { router } from '@inertiajs/vue3';

export default {
    props: {
        preguntas: Object,
        puntuacion: Number,
        usuario: Number,
        testId: Number,
        testSlug: String,
    },
    components: {
        Valoracion,
        Resumen,
    },
    methods: {
        finalizar() {
            /* Redirijo a información detallada en vez de a buscador 
            por si el usuario quiere guardar el test o ver el perfil del creador. */
            router.get('/informacion-detallada/' + this.testId + '/' + this.testSlug);
        }
    }
}
</script>

<template>
    <div class="bg-custom-purple w-10/12 md:w-8/12 2xl:w-6/12 m-10 p-5 shadow-custom-lg shadow-custom-blue">
        <!-- Invoca los componentes de Resumen y Valoracion y les pasa datos como prop -->
        <h2 class="text-4xl w-full font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Resumen del test</h2>
        <Resumen :preguntas="preguntas" :puntuacion="puntuacion"></Resumen>
        
        <h2 class="text-4xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">¡Valora este test!</h2>
        <Valoracion :usuario="usuario" :testId="testId" :testSlug="testSlug"></Valoracion>
        <div class="flex justify-center">
            <button @click="finalizar" type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-white hover:text-black border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-black rounded m-3 py-2 px-4">
                Finalizar
            </button>
        </div>
    </div>
</template>

<style>

</style>