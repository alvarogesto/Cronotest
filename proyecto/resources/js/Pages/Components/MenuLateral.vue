<script>
import { router } from '@inertiajs/vue3';
import debounce from "lodash/debounce";
import throttle from "lodash/throttle";

export default {
    props: {
        filters: Object,
        categories: Object,
        languages: Object,
    },
    data() {
        return {
            //De esta forma cuando el usuario pulse enter, el buscador no va a perder el valor
            buscar: this.filters.buscar,
            categorias: [],
            idiomas: []
        }
    
    },
    watch: {
        /*Cuando cambia el valor del input del buscador se ejecuta la petición get.
        Uso debounce para evitar que se hagan demasiadas peticiones innecesarias.
        Esto limita el número de peticiones a una cada 250 ms desde que el usuario 
        ha dejado de escribir (si no cada vez que el usuario escribe una letra se hace una petición).*/
        buscar: debounce(function (valor) {
            router.get('/buscador', {buscar: valor}, {
                preserveState: true,
                replace: true,
                preserveScroll: true
            })
        }, 250),
        // Al usar throttle estoy limitando el numero de peticiones a como máximo una cada 250 ms
        categorias: throttle(function (valor) {
            router.get('/buscador', {category: valor}, {
                preserveState: true,
                replace: true,
                preserveScroll: true
            })
        }, 250),
        // Al usar throttle estoy limitando el numero de peticiones a como máximo una cada 250 ms
        idiomas: throttle(function (valor) {
            router.get('/buscador', {language: valor}, {
                preserveState: true,
                replace: true,
                preserveScroll: true
            })
        }, 250)
    }
}
</script>

<template>
    
    <div class="bg-custom-purple p-5 shadow-custom-md shadow-custom-blue">
        <form> 
            <div class="flex items-center group">
                <label for="buscar"><img class="bg-custom-white h-6 p-1 group-focus-within:shadow-custom-md group-focus-within:shadow-custom-black" src="../../../../public/img/lupa.svg" alt="lupa"></label>
                <input v-model="buscar" class="my-2 w-full h-6 text-custom-black bg-custom-white group-focus-within:shadow-custom-md group-focus-within:shadow-custom-black" type="text" name="buscar" id="buscar" placeholder="Busca entre todos los test">
            </div>

            <h3 class="text-3xl font-bold my-3 text-center bg-custom-white shadow-custom-md shadow-custom-black text-custom-black">Filtros</h3>
            
            <h3 class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Categorías</h3>
            <!-- Recorre todas las categorías de la lista -->
            <div v-for="category in categories">
                <!-- El motivo por el que uso el slug como id en vez del propio id es porque si no tantos las categorías como los idiomas 
                tendrían los mismos valores como id (1,2,3...) -->
                <input v-model="categorias" class="m-2" type="checkbox" :id="category.slug" :name="category.id" :value="category.slug">
                <label class="my-2 hover:underline" :for="category.slug">{{ category.name }}</label>
            </div>

            <h3 class="block my-4 text-xl font-semibold w-fit p-1 bg-custom-blue shadow-custom-sm shadow-custom-black">Idiomas</h3>
            <!-- Recorre todos los idiomas de la lista -->
            <div v-for="language in languages">
                <input v-model="idiomas" class="m-2" type="checkbox" :id="language.slug" :name="language.id" :value="language.slug">
                <label class="my-2 hover:underline" :for="language.slug">{{ language.name }}</label>
            </div>
        </form>
    </div>
    
</template>

<style>

</style>