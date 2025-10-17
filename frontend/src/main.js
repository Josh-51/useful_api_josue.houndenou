import router from './router';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
 import Toast from "vue-toastification";
 import "vue-toastification/dist/index.css";

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'

const app = createApp(App)
const pinia = createPinia();

pinia.use(piniaPluginPersistedstate);

app.use(pinia)
app.use(router)
 app.use(Toast)
app.mount('#app')
