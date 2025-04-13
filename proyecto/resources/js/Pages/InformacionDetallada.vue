<script>
import { router } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import Valoracion from './Components/Valoracion.vue';

export default {
  props: {
    test: Object,
    categories: Object,
    languages: Object,
    usuario: Number,
    permitirBorrar: Boolean,
  },
  data() {
    return {
      likes: 0,
      difficulty: 0,
      originality: 0,
      score: 0,
      right_questions: 0,
      estadoValoracion: false,
      data: {}
    }
  },
  methods: {
    volver() {
      // Utiliza window.history para volver a la página anterior
      window.history.back();
    },
    submit() {
      router.get('/realizar-test/' + this.test.id + '/' + this.test.slug, this.data = {id: this.test.id})
    },
    submitCasual() {
      router.get('/realizar-test/casual/' + this.test.id + '/' + this.test.slug, this.data = {id: this.test.id})
    },
    guardar() {
      router.post('/biblioteca', this.data = {id: this.test.id})
    },
    noGuardar() {
      router.patch('/biblioteca', this.data = {id: this.test.id})
    },
    verUsuario() {
      router.get('/usuario/' + this.test.author.username)
    },
    valorarTest() {
      this.estadoValoracion = this.estadoValoracion ? false : true;
    },
    borrarTest() {
      router.delete('/test/' + this.test.id + '/' + this.test.author.id + '/eliminar')
    }

  },
  computed: {
    // Propiedad computada para contar los likes
    calcularLikes() {
      // Recorre todas las valoraciones
      for (let valoracion of this.test.ratings) {
        // Si la valoración tiene un me gusta, se suma al total de me gustas del test
        if (valoracion.like == 1) {
          this.likes += 1;
        }
      }
    },
    calcularDificultad() {
      /* Inicializo una variable que guarda el valor total de la dificultad de todos los test 
      y otra que guarda el total de valoraciones */
      let totalDificultad = 0;
      let totalValoraciones = 0;

      // Recorre todas las valoraciones
      for (let valoracion of this.test.ratings) {
        // Le añado los valores a las variables creadas
        totalDificultad += valoracion.difficulty;
        totalValoraciones += 1;
      }

      // Calculo la media de la dificultad si existen valoraciones
      if (totalValoraciones != 0) {
        this.difficulty = totalDificultad / totalValoraciones;
      }
    },
    calcularOriginalidad() {
      /* Inicializo una variable que guarda el valor total de la originalidad de todos los test 
      y otra que guarda el total de valoraciones */
      let totalOriginalidad = 0;
      let totalValoraciones = 0;

      // Recorre todas las valoraciones
      for (let valoracion of this.test.ratings) {
        // Le añado los valores a las variables creadas
        totalOriginalidad += valoracion.originality;
        totalValoraciones += 1;
      }

      // Calculo la media de la originalidad si existen valoraciones
      if (totalValoraciones != 0) {
        this.originality = totalOriginalidad / totalValoraciones;
      }
    },
    asignarPuntuacion() {
      if (this.test.results[0] != null) {
        this.score = this.test.results[0].score;
        this.right_questions = this.test.results[0].right_questions;
      }
    }
  },
  mounted() {
    this.asignarPuntuacion;
    // Nada más se monta el componente se llama a las propiedades computadas que calculan las valoraciones
    this.calcularLikes;
    this.calcularDificultad;
    this.calcularOriginalidad;
  },
  components: {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    Valoracion,
  }
}
</script>

<template>
  
  <div class="bg-custom-purple w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 m-10 p-5 shadow-custom-lg shadow-custom-blue">
    <div class="flex flex-col md:flex-row items-center md:justify-around">
      <div class="w-full md:w-4/12 bg-custom-white m-2 shadow-custom-md shadow-custom-black">
        <img class="h-full w-full object-cover" src="../../../public/img/planeta_cronotest.svg" alt="Imagen del test">
      </div>
      <div class="w-full md:w-8/12 m-2">
        <h1 class=" w-full break-words text-2xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">{{ test.title }}</h1>  
        
        <div class="flex flex-row flex-wrap justify-around items-center">
          <h4 class="block my-4 text-xl font-semibold w-fit m-3 p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">{{ test.category.name }}</h4>

          <h4 @click="verUsuario" class="block my-4 text-xl font-semibold w-fit m-3 p-1 bg-custom-blue shadow-custom-sm shadow-custom-black hover:underline">{{ test.author.username }}</h4>

          <h4 class="block my-4 text-xl font-semibold w-fit m-3 p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">{{ test.language.name }}</h4>
        </div>
        
        <div class="flex flex-col md:flex-row justify-around items-center">
          <p class="font-semibold">Dificultad: {{ difficulty }}</p>
          <p class="font-semibold">Originalidad: {{ originality }}</p>

          <div class="flex flex-col items-center m-3">
            <img @click="estadoLike" class=" w-6 md:w-8" src="../../../public/img/Like.svg" alt="Dado a me gusta">
            <p class="font-semibold">{{ likes }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center w-full m-2">
      <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="text-center">
          <h3 class="m-4 text-xl font-semibold p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Resultados</h3>  
          <h3 class="font-semibold">Puntuación: {{ score }}</h3>
          <h3 class="font-semibold">Preguntas correctas: {{ right_questions }}</h3>
        </div>

        <div class="text-center">
          <h3 class="m-4 text-xl font-semibold p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Descripción</h3>
          <p class="w-full break-words">{{ test.description }}</p> 
        </div>
      </div>

      <!-- Carga el componente para valorar el test. Es necesario recargar la página para visualizar los cambios -->
      <div class="w-full text-center">
        <button @click="valorarTest" class=" w-fit transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">Valorar el test</button>
        <div v-if="estadoValoracion">
          <p class="font-semibold underline">*Para realizar la valoración primero realiza el test*</p>
          <Valoracion :usuario="usuario" :testId="test.id" :testSlug="test.slug"></Valoracion>
        </div>
      </div>

      <div class="grid md:grid-cols-3">
        <div>
          <!-- Este menú (dropdown), es un componente de headless UI, al que luego le he aplicado estilos personalizados -->
          <Menu>
            <MenuButton class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 bg-custom-white text-black border border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-black rounded m-3 py-2 px-4">Realizar test</MenuButton>
            <MenuItems class="flex flex-col absolute bg-custom-black divide-y border border-custom-white  divide-custom-white mt-2">
              <MenuItem v-slot="{ active }">
                <button @click="submit" :class='{ 
                  "transition ease-in-out delay-50 w-full font-semibold p-3": !active,
                  "transition ease-in-out delay-50  w-full font-semibold bg-custom-white text-custom-black p-3 shadow-custom-sm shadow-custom-black scale-105": active }'>Con puntuación</button>
              </MenuItem>
              <MenuItem v-slot="{ active }">
                <button @click="submitCasual" :class='{ 
                  "transition ease-in-out delay-50 font-semibold p-3": !active,
                  "transition ease-in-out delay-50 font-semibold bg-custom-white text-custom-black p-3 shadow-custom-sm shadow-custom-black scale-105": active }'>Casual</button>
              </MenuItem>
            </MenuItems>
          </Menu>
        </div>  

        <button @click.prevent="guardar" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">Guardar</button>
        <button @click.prevent="noGuardar" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">No guardar</button>
      </div>
      <div class="flex justify-between w-full">
        <button @click.prevent="volver" class="w-fit transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">Volver</button>
        <button @click.prevent="borrarTest" v-if="permitirBorrar" class="w-fit transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-orange-600 border border-custom-white hover:border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">Borrar test</button>
      </div>

    </div>  
  </div>

</template>

<style>

</style>