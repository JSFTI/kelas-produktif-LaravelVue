<script setup>
import { Button } from '../components/input';
import { useRoute, useRouter } from 'vue-router';
import MethodsEvents from '../page-components/dasar-komponen/MethodsEvents.vue';
import { computed } from '@vue/reactivity';
import Reactivity from '../page-components/dasar-komponen/Reactivity';
import ChildComponents from '../page-components/dasar-komponen/ChildComponents.vue';
import LifeCycle from '../page-components/dasar-komponen/LifeCycle.vue';
import ComputedValue from '../page-components/dasar-komponen/ComputedValue.vue';
import Watchers from '../page-components/dasar-komponen/Watchers.vue';
import ListConditionalRendering from '../page-components/dasar-komponen/ListConditionalRendering.vue';

const route = useRoute();
const router = useRouter();

document.title = "Dasar Komponen Vue";

const examples = [
  {name: "Methods and Events", path: "methods-events", component: MethodsEvents},
  {name: "Reactivity", path: "reactivity", component: Reactivity},
  {name: "Child Component", path: "child-component", component: ChildComponents},
  {name: "Life-Cycle", path: "life-cycle", component: LifeCycle},
  {name: "Computed Value", path: "computed-value", component: ComputedValue},
  {name: "Watchers", path: "watchers", component: Watchers},
  {name: "List and Conditional Rendering", path: "list-conditional-rendering", component: ListConditionalRendering},
];

function handleSectionChange(path){
  router.push({name: "dasar-komponen", params: {section: path}});
}

const section = computed(() => {
  const examplesMap = {};
  for(let i = 0; i < examples.length; i++){
    examplesMap[examples[i].path] = examples[i].component;
  }
  return examplesMap[route.params.section];
});
</script>
<template>
  <div class="flex flex-wrap gap-5 justify-center">
    <Button v-for="(example, i) in examples" :key="i"
      @click="handleSectionChange(example.path)"
      :active="route.params.section === example.path"
    >
      {{ example.name }}
    </Button>
  </div>
  <section class="mt-10 mx-2 md:mx-32 lg:mx-48 xl:mx-96">
    <component :is="section"></component>
  </section>
</template>