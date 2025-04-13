<script>
import TestCarta from './Components/TestCarta.vue';
import MenuLateral from './Components/MenuLateral.vue';
import Paginacion from './Components/Paginacion.vue';

export default {
  props: {
    tests: Object,
    categories: Object,
    languages: Object,
    filters: Object,
  },
  data() {
    return {
      buscar: '',
      estadoBarra: false,
    }
  },
  methods: {
    mostrarBarra() {
      this.estadoBarra = this.estadoBarra ? false : true;
    }
  },
  components: {
    TestCarta, 
    MenuLateral, 
    Paginacion,
  }
}
</script>

<template>

  <div class="flex flex-col md:flex-row w-full items-start flex-grow ">   
    <button @click="mostrarBarra" class="flex md:hidden w-fit bg-custom-purple hover:shadow-custom-sm hover:shadow-custom-blue text-custom-white p-1 m-5">
      <img src="../../../public/img/menu.svg" alt="logo" class="w-10">
    </button>

    <div :class='{
      "hidden md:flex my-5": !estadoBarra,
      "flex flex-grow m-5": estadoBarra}'>
      <MenuLateral :filters="filters" :categories="categories" :languages="languages"></MenuLateral>
    </div>
    
    <div :class='{
      "hidden md:flex w-full flex-wrap": estadoBarra,
      "flex w-full flex-wrap": !estadoBarra}'>
      <!-- Recorre todos los test de la página actual -->
      <div v-for="test in tests.data" class="w-6/12 sm:w-4/12 md:w-4/12 lg:w-3/12 xl:w-2/12">
        <!-- Por cada test, genera un componente y se envían los valores -->
        <TestCarta :test="test"></TestCarta>
      </div>

      <Paginacion :links="tests.links"></Paginacion>
    </div>
  </div>
  
</template>

<style>

</style>