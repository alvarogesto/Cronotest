<script>
/* En este componente hago uso de la API de Open Trivia Database, la cúal tiene la licencia CC BY-SA 4.0 DEED.
Lo que hago es extraer 10 preguntas aleatorias de todas las que contiene la API.
El objetivo de mostrar estas preguntas es que los usuarios que quieran crear un test, pero no tengan idea de qué hacer, tengan algunas referencias de las que inspirarse.
Por ejemplo, el tema del test o qué tipo de preguntas hacer*/

export default {
  data() {
    return {
      resultados: {},
      estado: false
    };
  },
  methods: {
    generarPreguntas() {
      fetch("https://opentdb.com/api.php?amount=10")
        .then((response) => response.json())
        .then((data) => {
          this.resultados = data;
          this.estado = true;
        })
        .catch(function (error) {
          console.warn("Algo ha salido mal", error.message);
        });
    }
  }
};
</script>

<template>

    <div class="w-full text-center">
        <h3 class="text-xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">¿No se te ocurre que poner?</h3>
        <h3 class="my-4 text-md font-semibold w-full p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">¡Genera preguntas aleatorias de las que sacar inspiración!</h3>

        <button @click="generarPreguntas" type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">
            Generar
        </button>

        <!-- Muestros las preguntas sacadas de la API -->
        <!-- Las preguntas de la api están en formato html, esto hace que algunas palabras se vean mal.
        Para arreglar eso se puede usar v-html para cargar la información.
        El problema es que al hacerlo pueden generarse problemas de seguridad, donde alguien inyecta código en la pregunta.
        Por ello prefiero dejar las preguntas como texto. -->
        <div v-for="pregunta in resultados.results" class="flex flex-col lg:flex-row text-start border-t border-custom-white">
            <p class="font-semibold m-2 p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">{{ pregunta.category }}</p>
            <p class="p-1 m-2">{{ pregunta.question }}</p>
        </div>
        <div v-if="estado" class="mt-3">
            <p class="text-sm">Preguntas generadas a partir de la API de <a href="https://opentdb.com/" class="hover:underline font-bold">Open Trivia Database</a> creada por <a href="https://www.pixeltailgames.com/" class="hover:underline font-bold">PIXELTAIL GAMES LLC</a>. La API usa la licencia <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="hover:underline font-bold">CC BY-SA 4.0 DEED</a></p>
        </div>
    </div>

</template>

<style>

</style>