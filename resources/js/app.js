require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import { Toaster } from '@meforma/vue-toaster';
import { QuillEditor } from '@vueup/vue-quill';



import '@vueup/vue-quill/dist/vue-quill.snow.css';

import VueCollapsiblePanel from '@dafcoe/vue-collapsible-panel';

import '@dafcoe/vue-collapsible-panel/dist/vue-collapsible-panel.css';

//Recipe Ingredient Component Added with calculation
import helpers from '@/Pages/VueClasses/RecipeIngredientsPrototype/helpers';
import conversions from '@/Pages/VueClasses/RecipeIngredientsPrototype/conversions';

import { Inertia } from '@inertiajs/inertia';

const RecipeIngredientPrototype = (app, options = {}) => {  
  //app.$helpers = helpers
  app.config.globalProperties.$helpers = helpers

  //app.$conversions = conversions
  app.config.globalProperties.$conversions = conversions
}

const el = document.getElementById('app');

window.Vapor = require('laravel-vapor');

createApp({
    render: () =>
        h(InertiaApp, {            
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    
    .use(Toaster)
    .use(VueCollapsiblePanel)       
    .use(RecipeIngredientPrototype)
    .component('QuillEditor', QuillEditor)
    
    .mount(el);    

InertiaProgress.init({ color: '#4B5563' });
Inertia.on('start', () => document.getElementById('full_loader').style.display="flex");
Inertia.on('finish', () => document.getElementById('full_loader').style.display="none");
