<script setup>
import { Input, Radio, Select, Button } from '@/src/components/input';
import { reactive } from 'vue';
import IconAdd from '~icons/ic/baseline-add';
import IconDelete from '~icons/bi/trash';

const state = reactive({
  name: "Jason",
  gender: "M",
  age: 21,
  major: 0,
  advisor: {
    name: 'Niskarto Zendrato',
    gender: "M",
    age: 40
  },
  classes: [{
    abbr: 'PTI',
    name: 'Pengantar Teknologi Informasi'
  }]
});

const newClass = reactive({
  abbr: "",
  name: ""
})

function handleAddNewClass(){
  state.classes.push({...newClass});
  // Try:
  // state.classes.push(newClass);
  // Spoilers, it will not work as expected. Why?
  newClass.abbr = "";
  newClass.name = "";
}

function deleteClass(index){
  state.classes.splice(index, 1);
}

function deleteAllClasses(){
  state.classes = [];
  // Or
  // state.classes.splice(0, state.classes.length);
}

</script>
<template>
  <form>
    <Input label="Name" v-model="state.name" name="name" id="name-input" />
    <div class="mt-3">
      <div>Gender</div>
      <div class="flex gap-5">
        <Radio label="Male" v-model="state.gender" value="M" id="gender-male" name="gender" />
        <Radio label="Female" v-model="state.gender" value="F" id="gender-female" name="gender" />
      </div>
    </div>
    <Input class="mt-3" type="number" label="Age" v-model.number="state.age" name="age" id="age-input" />
    <Select class="mt-3" v-model.number="state.major" label="Major" name="major" id="major-input"
      :options="[{value: 0, option: 'Teknologi Informasi'}, {value: 1, option: 'Ilmu Komputer'}]"
    />

    <div class="mt-3">Advisor Data</div>
    <Input label="Name" v-model="state.advisor.name" name="advisorName" id="advisor-name-input" />
    <div class="mt-3">
      <div>Gender</div>
      <div class="flex gap-5">
        <Radio label="Male" v-model="state.advisor.gender" value="M" id="advisor-gender-male" name="advisorGender" />
        <Radio label="Female" v-model="state.advisor.gender" value="F" id="advisor-gender-female" name="advisorGender" />
      </div>
    </div>
    <Input class="mt-3" type="number" label="Age" v-model.number="state.advisor.age" name="advisorAge" id="advisor-age-input" />

    <div class="mt-3">Student Classes</div>
    <div class="flex flex-col gap-1">
      <div class="flex gap-2" v-for="(clas, i) in state.classes" :key="i">
        <Input v-model="clas.abbr" class="w-12" />
        <Input v-model="clas.name" />
        <Button type="button" @click="deleteClass(i)">
          <IconDelete />
        </Button>
      </div>
      <div class="flex gap-2">
        <Input v-model="newClass.abbr" class="w-12" />
        <Input v-model="newClass.name" />
        <Button type="button" @click="handleAddNewClass()">
          <template v-slot:icon>
            <IconAdd />
          </template>
        </Button>
      </div>
      <Button type="button" @click="deleteAllClasses()">
        Delete All Classes
      </Button>
    </div>
  </form>
  <pre>{{ state }}</pre>
</template>