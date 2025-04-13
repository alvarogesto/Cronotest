import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Layout from './Shared/Layout.vue';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout ??= Layout;  //Al hacer esto deja de ser necesario importar el layout en cada componente
    return page

  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('Link', Link) //Al registrar el componente Link de forma global puedo utilizarlo en toda la app sin tener que importarlo manualmente en cada archivo
      .mount(el)
  },
})