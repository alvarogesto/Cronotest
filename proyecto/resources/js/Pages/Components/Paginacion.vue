<script>
export default {
    props: {
        links: Object
    }
}
</script>

<template>
  <div class="w-full text-center m-3">
    <!-- Este componente permite recorrer las páginas de los test.
    Si hay un enlace para la siguiente página el componente será un Link, si no será un span -->
    <Component
      :is="link.url ? 'Link' : 'span'"
      v-for="link in links"
      :href="link.url"
      v-html="link.label"
      class="p-1 m-2 bg-custom-purple shadow-custom-sm shadow-custom-blue"
      :class="{ 'text-custom-black': ! link.url, 'font-bold underline' : link.active }"
    />
  </div>
</template>

<style>

</style>