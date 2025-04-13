<script>
import { router } from '@inertiajs/vue3';
import TestCarta from './Components/TestCarta.vue';
import Paginacion from './Components/Paginacion.vue';


export default {
  props: {
    usuario: Object,
    tests: Object,
    estadoEditar: Boolean,
    admin: Boolean,
  },
  data() {
    return {
      likes: 0
    }
  },
  computed: {
    editar() {
      router.get('/perfil/editar')
    },
    calcularLikes() {
      // Recorro todas las valoraciones de todos los test que haya creado el usuario
      for (let test of this.tests.data) {
        for (let valoracion of test.ratings) {
          // Si la valoración tiene un me gusta, se suma al total de me gustas del test
          if (valoracion.like == 1) {
            this.likes += 1;
        }
        }
      }
    },
    irPanelAdmin() {
      router.get('/perfil/admin')
    }
  },
  created() {
    // Nada más se monta el componente se llama a la propiedad computada
    this.calcularLikes;
  },
  components: {
    TestCarta, 
    Paginacion,
  }
}
</script>

<template>
    
  <div class="flex flex-col items-center w-full">
    <div class="flex flex-col items-center w-10/12 md:w-8/12">
      <div class="flex flex-col lg:flex-row items-center h-auto w-full"> 
        <div class="bg-custom-white m-2 shadow-custom-md shadow-custom-black h-auto text-center">
          <img class="h-full w-full object-cover" src="../../../public/img/planeta_cronotest.svg" alt="Foto de perfil">
        </div>

        <div class="flex items-center">
          <div class="bg-custom-purple w-fit h-fit m-5 p-5 shadow-custom-md shadow-custom-blue text-center">
            <p v-bind="nombre" class="font-semibold">{{ usuario.name }}</p>
            <p>@{{ usuario.username }}</p>
          </div>

          <div class="flex bg-custom-purple w-fit h-fit m-5 p-5 justify-center shadow-custom-md shadow-custom-blue">
            <img class="w-6 m-1" src="../../../public/img/Like.svg" alt="me gusta">
            <p class="m-1 font-semibold text-2xl">{{ likes }}</p>
          </div>
        </div>

        <div class="flex items-center">
          <div v-if="estadoEditar" class="m-2 hover:underline bg-custom-purple w-fit h-fit p-2 shadow-custom-sm shadow-custom-blue">
            <p @click="editar" class="hover:underline">Editar</p>
          </div>
          <div v-if="estadoEditar" class="m-2 hover:underline bg-custom-purple w-fit h-fit p-2 shadow-custom-sm shadow-custom-blue">
            <Link href="/logout" method="PATCH">Cerrar sesión</Link>
          </div>
          </div>
          <div v-if="admin" class="m-2 hover:underline bg-custom-purple w-fit h-fit p-2 shadow-custom-sm shadow-custom-blue">
            <p @click="irPanelAdmin" class="hover:underline">Panel de administrador</p>
          </div>
      </div>
    
      <div class="bg-custom-purple w-full m-5 p-5 shadow-custom-md shadow-custom-blue h-auto">
        <p class="w-full break-words">{{ usuario.description }}</p>
      </div>
    </div>

    <div class="flex flex-col w-full items-center h-auto">
      <div class="bg-custom-purple w-fit h-fit m-5 p-5 shadow-custom-md shadow-custom-blue"><h3>TEST CREADOS</h3></div>

      <div class="flex w-full justify-center flex-wrap">
        <!-- Recorre todos los test en lista -->
        <div v-for="test in tests.data" class="w-6/12 md:w-4/12 xl:w-3/12 2xl:w-2/12">
          <!-- Por cada test, genera un componente y se envían los valores -->
          <TestCarta :test="test"></TestCarta>
        </div>
        <Paginacion :links="tests.links"></Paginacion>
      </div> 
    </div>
  </div>

</template>

<style>

</style>