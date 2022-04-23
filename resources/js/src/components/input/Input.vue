<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: String,
  min: Number,
  max: Number,
  label: String,
  name: String,
  type: String,
  id: String
});

const value = ref(props.modelValue ?? "");

watch(() => props.modelValue, () => {value.value = props.modelValue});

</script>
<template>
  <div>
    <div class="input-group" :class="{'has-value': value.length > 0}">
      <input :type="type" :id="id" :name="name" v-model="value" :min="min" :max="max"
        @input="$emit('update:modelValue', $event.target.value)"
      />
      <label class="block mb-2" :for="id" v-if="label">{{ label }}</label>
    </div>
  </div>
</template>
<style scoped lang="scss">
@mixin label-open{
  top: -12px;
  transform: none;
  font-size: 0.85rem;
  transition: 100ms all linear; 
}

.input-group{
  position: relative;
  margin-top: 0.5rem;

  label{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 10px;
    pointer-events: none;
  }

  input{
    height: 2.5rem;
    padding-left: 10px;
    width: 100%;
    outline: none;
  }

  &::before, &::after{
    content: ' ';
    position: absolute;
    bottom: 0px;
    height: 2px;
    display: block;
  }

  &::before{
    width: 100%;
    background-color: black;
    z-index: 1;
  }

  &::after{
    width: 0%;
    background-color: rgb(68, 143, 255);
    z-index: 2;
  }

  &:focus-within{
    &::after{
      width: 100%;
      transition: 200ms all linear;
    }

    label{
      color:rgb(68, 143, 255);
      @include label-open;
    }
  }

  &.has-value label{
    @include label-open;
  }
}
</style>