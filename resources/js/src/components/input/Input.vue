<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: String,
  min: Number,
  max: Number,
  label: String,
  name: String,
  type: String,
  id: String,
  invalidFeedback: String,
  autocomplete: String,
  placeholder: String
});

const value = ref(props.modelValue ?? "");
const focused = ref(false);

watch(() => props.modelValue, () => {value.value = props.modelValue});

function handleFocus(value){
  focused.value = value;
}

</script>
<template>
  <div class="input-group-wrapper">
    <div class="input-group" :class="{'has-value': value.length > 0, 'is-invalid': invalidFeedback}">
      <input :type="type" :id="id" :name="name" v-model="value" :min="min" :max="max"
        :autocomplete="autocomplete"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="focused && value.length === 0 ? placeholder : ''"
        @focusin="handleFocus(true)"
        @focusout="handleFocus(false)"
      />
      <label class="flex gap-1 items-center mb-2" :for="id" v-if="label">
        <div><slot name="label-icon"></slot></div>
        <div>{{ label }}</div>
      </label>
    </div>
    <div class="invalid-feedback">{{ invalidFeedback }}</div>
  </div>
</template>
<style scoped lang="scss">
@import '~styles/theme';

@mixin label-open{
  top: -12px;
  transform: none;
  font-size: 0.85rem;
  transition: 100ms all linear; 
}

.input-group-wrapper{
  margin-top: 1rem;
  margin-bottom: 1rem;

  .input-group{
    position: relative;
    margin-bottom: 0.25rem;

    &.is-invalid label{
      color: $dangerColour;
    }

    &.is-invalid::before{
      background-color: $dangerColour;
    }

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

  .invalid-feedback{
    display: none;
    font-size: 0.75rem;
    color: $dangerColour;
  }

  .input-group.is-invalid + .invalid-feedback{
    display: block;
  }
}
</style>