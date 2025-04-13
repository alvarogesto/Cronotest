<script>
import TestCarta from './Components/TestCarta.vue';
import Paginacion from './Components/Paginacion.vue';

export default {
  props: {
    tests: Object,
  },
  components: {
    TestCarta, 
    Paginacion,
  }
}
</script>

<template>

  <!-- Si hay test guardados los muestra -->
  <div v-if="tests.data.length != 0" class="flex w-full m-10 flex-wrap">
    <!-- Recorre todos los test en lista -->
    <div v-for="test in tests.data" class="w-6/12 md:w-4/12 xl:w-3/12 2xl:w-2/12">
      <!-- Por cada test, genera un componente y se envían los valores -->
      <TestCarta :test="test"></TestCarta>
    </div>

    <Paginacion :links="tests.links"></Paginacion>
  </div>
  <!-- En caso de el usuario no haya guardado ningún test, se muestra el mensaje -->
  <div v-else class="bg-custom-purple text-center w-10/12 md:w-8/12 2xl:w-6/12 m-10 p-5 shadow-custom-lg shadow-custom-blue">
    <h1 class="block text-4xl font-bold m-3 bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Ahora mismo no tienes ningún test guardado.</h1>
    <h3 class="block m-3 text-xl">¡Puedes buscar entre todos los test <Link href="/buscador" class="underline font-semibold">aquí</Link>!</h3>
  </div>
  
</template>

<style>

</style>