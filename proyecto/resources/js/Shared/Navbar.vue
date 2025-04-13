<script>
export default {
  data() {
    return {
      estadoMenu: false
    }
  },
  methods: {
    // Metodo que cambia el estado del menú, esto permite indicar si el menu es visible o no
    mostrarMenu() {
      this.estadoMenu = !this.estadoMenu;
    }
  }
}
</script>

<template>
    <nav class="flex w-full p-3 bg-custom-purple mb-3">
        <div class="flex justify-around flex-wrap items-center w-full">
             <!-- Logo y botón para el menú hamburguesa -->
            <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
                <ul>
                    <li>
                        <Link href="/">
                            <img src="../../../public/img/logotipo.svg" alt="logo" class="w-24">
                        </Link>
                    </li>
                </ul>

                <!-- Cuando la pantalla es demasiado pequeña la barra pasa a tener un menú hamburguesa -->
                <button @click="mostrarMenu" class="flex lg:hidden text-custom-white bg-custom-blue border-2 border-custom-white p-1 hover:shadow-custom-sm hover:shadow-custom-black" type="button">
                    <img src="../../../public/img/menu.svg" alt="logo" class="w-10">
                </button>
            </div>

            <div v-bind:class="{'hidden': !estadoMenu, 'flex': estadoMenu}" class="lg:flex items-center">
                <!-- Menú principal -->
                <ul class="flex flex-col lg:flex-row ml-auto text-xl">
                    <li>
                        <Link href="/biblioteca" class="m-1 p-1 lg:p-3 font-bold transition ease-in-out delay-50 hover:bg-custom-blue hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-black">
                            Biblioteca
                        </Link>
                    </li>
                    <li>
                        <Link href="/buscador" class="m-1 p-1 lg:p-3 font-bold transition ease-in-out delay-50 hover:bg-custom-blue hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-black">Buscar</Link>
                    </li>
                    <li>
                        <Link href="/test/crear" class="m-1 p-1 lg:p-3 font-bold transition ease-in-out delay-50 hover:bg-custom-blue hover:text-custom-white hover:shadow-custom-sm hover:shadow-custom-black">Crear Test</Link>
                    </li>
                </ul>
            </div>

            <div v-bind:class="{'hidden': !estadoMenu, 'flex': estadoMenu}" class="lg:flex items-center">
                <!-- Menú de usuario -->
                <ul class="flex flex-col lg:flex-row ml-auto text-xs">
                    <li class="p-1 lg:p-3 hover:text-custom-white hover:underline">
                        <Link href="/login">Iniciar sesión</Link>
                    </li>
                    <li class="p-1 lg:p-3 hover:text-custom-white hover:underline">
                        <Link href="/registro">Registrarse</Link>
                    </li>
                    <li class="hover:text-custom-white hover:underline">
                        <Link href="/perfil" class="hidden lg:flex">
                            <img src="../../../public/img/usuario.svg" alt="usuario" class="w-full h-10 transition ease-in-out delay-50 hover:shadow-custom-sm hover:shadow-custom-black">
                        </Link>
                        <Link href="/perfil" class="flex lg:hidden p-1 lg:p-3 hover:text-custom-white hover:underline">
                            Perfil
                        </Link>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</template>

<style>

</style>