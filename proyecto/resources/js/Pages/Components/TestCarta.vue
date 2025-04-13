<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    test: Object,
  },
  methods: {
    verTest() {
      router.get('/informacion-detallada/' + this.test.id + '/' + this.test.slug)
    },
    verUsuario() {
      router.get('/usuario/' + this.test.author.username)
    }
  }
}
</script>

<template>

  <div class="m-5 bg-custom-white hover:shadow-custom-md hover:shadow-custom-blue hover:scale-105 transition ease-in-out delay-50">
    <div @click="verTest">
    <!-- Los slots reciben los valores que se envían desde el componente padre -->
    <img class="h-full w-full object-cover" src="../../../../public/img/planeta_cronotest.svg" alt="Sunset in the mountains">
    
    <div class="bg-custom-purple text-center">
      <div class="p-3">
        <h4 class="bg-custom-white font-bold text-xl truncate p-1 mb-1 text-custom-black shadow-custom-sm shadow-custom-black">
          {{ test.title }}
          {{ img }}
        </h4>
      </div>
      <div>
      </div>
      <div class="pt-1 pb-3 px-1">
        <span class="inline-block px-3 py-1 text-xs text-custom-white mr-2 border border-custom-white">
          {{ test.category.name }}
        </span>
      </div>
    </div> 
    </div>
    <button @click.prevent="verUsuario" class="w-full bg-custom-purple border-2 text-center hover:bg-custom-white hover:text-custom-black hover:underline">
      {{ test.author.username }}
    </button>
  </div>
    
</template>

<style>

</style>