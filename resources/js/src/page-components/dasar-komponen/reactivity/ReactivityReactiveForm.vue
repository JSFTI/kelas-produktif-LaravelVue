<script setup>
import { Input, Radio, Select } from '@/src/components/input';
import { reactive } from 'vue';

const state = reactive({
  name: "Jason",
  gender: "M",
  age: 21,
  major: "0",
});

</script>
<template>
  <form>
    <Input label="Name" v-model="state.name" name="name" id="name-input" />
    <div>
      <div>Gender</div>
      <div class="flex gap-5">
        <Radio label="Male" v-model="state.gender" value="M" id="gender-male" name="gender" />
        <Radio label="Female" v-model="state.gender" value="F" id="gender-female" name="gender" />
      </div>
    </div>
    <Input type="number" label="Age" v-model="state.age" name="age" id="age-input" />
    <Select v-model="state.major" label="Major" name="major" id="major-input"
      :options="[{value: 0, option: 'Teknologi Informasi'}, {value: 1, option: 'Ilmu Komputer'}]"
    />
  </form>
  <pre>{{ state }}</pre>
</template>