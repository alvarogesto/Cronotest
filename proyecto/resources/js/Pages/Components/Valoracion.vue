<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    usuario: Number,
    testId: Number,
    testSlug: String,
  },
  data() {
    return {
      /*Las variables que están en inglés están así para que coincidan 
      con el nombre de los campos de la tabla en la base de datos*/ 
      like: false,
      difficulty: 5,
      originality: 5,
      valoracionEnviada: '',
      formulario: {}
    }
  },
  methods: {
    estadoLike() {
      // Cambiar el estado de like al contrario que tenga en ese momento
      this.like = this.like ? false : true;
    },
    submit() {
      // Enviar los datos de la valoración
      router.post('/realizar-test/' + this.testId + '/' + this.testSlug + '/valorar', 
      this.formulario = {
        'userId': this.usuario,
        'testId': this.testId,
        'like': this.like,
        'difficulty': this.difficulty,
        'originality': this.originality,
      });

      // Indicar que se enviado la valoración
      this.valoracionEnviada = '¡Se ha enviado la valoración!'
    }
  }
}
</script>

<template>
  <!-- En caso de que haya un usuario muestra el formulario -->
  <div v-if="usuario != null">
    <form @submit.prevent="submit">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="flex flex-col items-center">
          <label class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="difficulty">Dificultad</label>
          <input v-model="difficulty" class="w-full mt-4" type="range" min="0" max="10" name="difficulty" id="difficulty"/>
          <p class="font-semibold">{{ difficulty }}</p>
        </div>

        <div class="flex flex-col items-center justify-center">
          <div v-if="like">
            <img @click="estadoLike" class="w-12 mt-4 hover:scale-110 transition ease-in-out delay-50" src="../../../../public/img/Like.svg" alt="Dado a me gusta">
          </div>
          <div v-else="like" >
            <img @click="estadoLike" class="w-12 mt-4 hover:scale-110 transition ease-in-out delay-50" src="../../../../public/img/LikeSinRelleno.svg" alt="Me gusta">
          </div>
        </div>

        <div class="flex flex-col items-center">
          <label class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black" for="originality">Originalidad</label>
          <input v-model="originality" class="w-full mt-4" type="range" min="0" max="10" name="originality" id="originality"/>
          <p class="font-semibold">{{ originality }}</p>
        </div>
      </div>
    </form>
    
    <div class="flex flex-col items-center">
      <p class="font-semibold">{{ valoracionEnviada }}</p>

      <button @click="submit" type="submit" class="transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 hover:bg-custom-blue border border-custom-white font-semibold hover:shadow-custom-sm hover:shadow-custom-white rounded m-3 py-2 px-4">
        Enviar valoración
      </button>
    </div>
  </div>
  <!-- En caso de que no haya un usuario registrado muestra el mensaje -->
  <div v-else class="text-center">
    <p class="my-4"><Link href="/login" class="font-bold hover:underline">Inicia sesión</Link> para enviar una valoración</p>
  </div>
    
</template>

<style>

</style>