<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    test: Object,
  },
  data() {
    return {
      preguntaActual: 0,
      preguntas: [],
      preguntasCorrectas: 0,
      predeterminado: true,
      correcto: false,
      incorrecto: false,
      datos: {},
      datosResumen: {}
    }
  },
  computed: {
    pregunta() {
      // Obtener la pregunta actual basándose en el índice actual
      return this.test.question[this.preguntaActual];
    },
    respuestas() {
      // Obtener las respuestas de la pregunta actual
      return this.test.answer.filter(answer => answer.question_id === this.pregunta.id);
    },
  },
  methods: {
    // Método para pasar a la siguiente pregunta
    siguiente() {
      // Espera 1 segundo, pasa a la siguiente pregunta y comprueba que no haya más
      setTimeout(() => {
        if ( this.preguntaActual != (this.test.question.length -1) ) {
          this.preguntaActual += 1;
          this.correcto = false;
          this.incorrecto = false;
          this.predeterminado = true;
        } else {
          this.resumen();
        }
      }, 1000);
    },
    // Método que recibe una respuesta y calcula si es correcta o no
    calcularRespuesta(respuesta) {
      if (respuesta.correct == true) {
        this.correcto = true;
        this.predeterminado = false;
        this.preguntas.push(true);
        this.preguntasCorrectas += 1;
      } else {
        this.incorrecto = true;
        this.predeterminado = false;
        this.preguntas.push(false);
      }
      this.siguiente();
    },
    resumen() {
      // Enviar los datos para el resumen del test
      router.post('/realizar-test/' + this.test.id + '/' + this.test.slug + '/resumen', 
      this.datosResumen = {
        'preguntas': this.preguntas,
        'testId': this.test.id,
        'testSlug': this.test.slug,
      });
    }
  }
}
</script>

<template>
  <div class="flex flex-col items-center justify-around w-10/12 text-center">
    <!-- Muestra la pregunta actual y selecciona el estilo según la respuesta seleccionada es correcta o no-->
    <div :class="{'flex items-center justify-center font-semibold bg-custom-purple w-full h-full m-10 p-5 overflow-hidden shadow-custom-lg shadow-custom-blue ': predeterminado,
    'flex items-center justify-center text-custom-black  font-semibold bg-custom-white w-full h-full m-10 p-5 shadow-custom-lg shadow-custom-blue overflow-hidden break-words': correcto,
    'flex items-center justify-center font-semibold bg-orange-600 w-full h-full m-10 p-5 shadow-custom-lg shadow-custom-blue overflow-hidden break-words': incorrecto,
    }">
      <h3 class="w-full break-words">{{ pregunta.question }}</h3>
    </div>

    <div class="flex flex-wrap justify-center m-10 text-center w-full h-full">
      <!-- Itera las respuestas de la pregunta actual -->
      <div @click.prevent="calcularRespuesta(respuesta)" v-for="respuesta in respuestas" :key="respuesta.id" class="bg-custom-purple w-8/12 md:w-5/12 overflow-hidden m-5 p-5 hover:bg-custom-blue hover:shadow-custom-sm hover:shadow-custom-purple hover:scale-105 transition ease-in-out delay-50">
        <p class="w-full break-words">{{ respuesta.answer }}</p>
      </div>
    </div>
  </div>
</template>

<style>

</style>
