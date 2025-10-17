<script setup>
import {onMounted, ref} from "vue";
import { useModuleStore } from '../stores/modulesStore.js'
import { useToast } from "vue-toastification";


const toast = useToast()

const store=useModuleStore()
const active=ref([])
onMounted(async () => {
   const alert= await store.fetchModuleActive()
  active.value=alert
    console.log("test", alert)

})

const activate = async (id) => {

  const result=store.activateModule(id)
  if(result){
    const alert= await store.fetchModuleActive()
    active.value=alert
    toast.success("Module activé")
  }
}

</script>

<template>


  <div class="flex">
    <div  >
      <aside class="w-64 h-screen bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold mb-4">Menu</h2>
        <ul>

          <li v-for="item in active" :key="item.id" class="mb-2"><a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">{{ item.name}}</a></li>

        </ul>
      </aside>
    </div>
    <div >
      <button class=" text-gray-100" @click="activate(1)">Activer le Module1 </button>
      <button class=" text-gray-100" @click="activate(2)">Activer le Module2 </button>
      <button class=" text-gray-100" @click="activate(3)">Activer le Module3 </button>
      <button class=" text-gray-100" @click="activate(4)">Activer le Module4 </button>
      <button class=" text-gray-100" @click="activate(5)">Activer le Module5 </button>

    </div>
  </div>


</template>


<style scoped>

</style>
