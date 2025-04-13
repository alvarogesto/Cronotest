<script>
export default {
  props: {
    preguntas: Object,
    puntuacion: Number,
  },
  data() {
    return {
      respuestasAcertadas: 0,
      totalPreguntas: 0,
    };
  },
  methods: {
    contarRespuestas() {
      // Filtrar todas las respuestas correctas
      this.respuestasAcertadas = this.preguntas.filter((respuesta) => respuesta === true).length;
      // Guardar todas las preguntas
      this.totalPreguntas = this.preguntas.length;
    },
  },
  created() {
    // Llama al método al crear el componente
    this.contarRespuestas();
  },
};
</script>

<template>
  <div class="flex flex-col items-center">
    <!-- Si existe una puntuación se muestra -->
    <div v-if="puntuacion != null">
      <h3 class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Puntuación</h3>
      <p class="text-xl font-bold">{{ puntuacion }} puntos</p>
    </div>

    <h3 class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Preguntas correctas</h3>

    <div>
      <p class="text-lg font-semibold">Has acertado {{ respuestasAcertadas }} de {{ totalPreguntas }} preguntas</p>
    </div>

    <!-- Muestra un cuadrado por cada pregunta del test. 
    Si el usuario acertó la pregunta el cuadrado será blanco, si no será naranja  -->
    <div class="flex flex-wrap w-full justify-center">
      <div v-for="(respuesta, index) in preguntas" :key="index" class="w-8 h-8 bg-custom-white m-1" :class="{ 'bg-orange-600': !respuesta }"></div>
    </div>
  </div>
</template>

<style></style>
