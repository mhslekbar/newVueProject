import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import "bootstrap"
import "bootstrap/dist/css/bootstrap.min.css";
import "normalize.css";

// end import B-V-3
// import BootstrapVue3 from 'bootstrap-vue-3'
// import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'
// end import B-V-3

createApp(App).use(store).use(router).mount('#app')
