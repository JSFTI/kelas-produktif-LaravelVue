<script setup>
import { Button } from '@/src/components/input';

const names = ['Adi', 'Budi', 'Citra', 'Doni', 'Ethan', 'Farhan'];

function getRandomIndex(){
  return Math.floor(Math.random() * 10) % names.length;
}

function handleGreeting(){
  alert(`Hello ${names[getRandomIndex()]}`);
}

function addTwoNumbers(a, b){
  return a + b;
}
</script>
<template>
  <div>
    <Button @click="handleGreeting()">
      Say Hi!
    </Button>
    <div class="mt-3">1 + 2 = {{ addTwoNumbers(1, 2) }}</div>
  </div>
</template>