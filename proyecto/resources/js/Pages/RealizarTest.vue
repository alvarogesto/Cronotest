<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    test: Object,
  },
  data() {
    return {
      preguntaActual: 0,
      puntuacion: 0,
      preguntas: [],
      preguntasCorrectas: 0,
      puntos: 180,
      intervalo: null,
      tiempo: 0,
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
  watch: {
    // Cada vez que tiempo vale 180 se llama al método
    tiempo(valor) {
      if (valor == 180) {
        this.calcularTiempo();
      }
    }
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
          this.tiempo = 180;
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
        // La puntuación es igual al tiempo sobrante al responder. De forma que cuanto antes respondas, más puntos ganarás
        this.puntuacion += this.tiempo;
        this.preguntasCorrectas += 1;
      } else {
        this.incorrecto = true;
        this.predeterminado = false;
        this.preguntas.push(false);
      }

      this.submit(respuesta)
      this.siguiente();
    },
    calcularTiempo() {
      // Limpiar el intervalo existente antes de crear uno nuevo
      clearInterval(this.intervalo);

      // Crear un nuevo intervalo
      this.intervalo = setInterval(() => {
        this.tiempo -= 1;

        if (this.tiempo === 0) {
          this.preguntas.push(false);
          this.siguiente();
        }
      }, 1000);
    },
    submit(respuesta) {
      // Enviar los datos del test
      router.post('/realizar-test/guardar-datos', this.datos = {
        respuesta: respuesta,
        puntuacion: this.puntuacion,
        preguntasCorrectas: this.preguntasCorrectas,
        id: this.test.id
      });
    },
    resumen() {
      // Enviar los datos para el resumen del test
      router.post('/realizar-test/' + this.test.id + '/' + this.test.slug + '/resumen', 
      this.datosResumen = {
        'preguntas': this.preguntas,
        'testId': this.test.id,
        'testSlug': this.test.slug,
        'puntuacion': this.puntuacion
      });
    }
  },
  mounted() {
    this.tiempo = 180;
  },
  // En caso de que se salga de la página se borra el intervalo
  beforeUnmount() {
    clearInterval(this.intervalo);
  },
}
</script>

<template>
  <div class="flex flex-col items-center justify-around w-10/12 text-center">
    <div class="flex justify-around w-full h-full">
      <div class="flex flex-col items-center justify-center font-semibold  w-3/12 h-fit md:w-2/12 bg-custom-purple p-5 shadow-custom-md shadow-custom-blue">
        <p class="font-semibold">Tiempo</p>
        <p>{{ tiempo }}</p>
      </div>

      <div class="w-full h-fit border-y border-custom-white shadow-custom-sm shadow-custom-blue">
        <!-- El ancho de la barra cambia en función del tiempo restante -->
        <div :style="{ width: tiempo / 1.8 + '%' }" class="transition-all h-5 bg-custom-white"></div>
      </div>
      
      <div class="flex flex-col items-center justify-center font-semibold w-3/12 md:w-2/12 h-fit bg-custom-purple p-5 shadow-custom-md shadow-custom-blue">
        <p class="font-semibold">Puntos</p>
        <p>{{ puntuacion }}</p>
      </div>
    </div>

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
