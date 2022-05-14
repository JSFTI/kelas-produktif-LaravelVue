<script setup>
import { onBeforeMount, ref } from 'vue';
import UserCircle from '~icons/ph/user-circle';
import BaselineAlternateEmail from '~icons/ic/baseline-alternate-email';
import Password from '~icons/carbon/password';
import validateRegistration from '@/validators/register';
import {useToast} from 'vue-toast-notification';
import axios from 'axios';
import {useUser} from '@/stores/user';
import { useRouter } from 'vue-router';

const user = useUser();
const toast = useToast();

const router = useRouter();
const invalidFeedbacks = ref({});
const formLoading = ref(false);

onBeforeMount(() => {
  if(user.id !== null){
    router.replace('/');
  }
});

function handleRegister(e){
  formLoading.value = true;
  const formData = new FormData(e.target);
  const formJson = Object.fromEntries(formData);

  invalidFeedbacks.value = {};

  validateRegistration(formJson)
    .then(() => {
      axios.post('/register', formJson)
        .then((res) => {
          toast.success("Pendaftaran Berhasil!");
          user.$patch(res.data);
          formLoading.value = false;
          router.push('/');
        })
        .catch((err) => {
          invalidFeedbacks.value = err.response.data.messages;
          formLoading.value = false;
        });
    })
    .catch((err) => {
      invalidFeedbacks.value = err;
      formLoading.value = false;
    }); 
}
</script>
<template>
  <div class="w-full flex justify-center">
    <Card class="lg:w-[400px] lg:mx-4 w-screen mx-4 pb-4 px-4">
      <div class="text-center">
        <h1 class="font-bold text-3xl">Register</h1>
        <small class="text-center">Sudah ada akun? <router-link :to="'/login'">Login di sini</router-link></small>
      </div>
      <form @submit.prevent="handleRegister">
        <Input label="Username" name="username" id="register-username"
          :invalidFeedback="invalidFeedbacks.username">
          <template v-slot:label-icon>
            <UserCircle />
          </template>
        </Input>
        <Input label="Email" name="email" id="register-email"
          :invalidFeedback="invalidFeedbacks.email">
          <template v-slot:label-icon>
            <BaselineAlternateEmail />
          </template>
        </Input>
        <Input type="password" label="Password" name="password" id="register-password"
          autocomplete="new-password"
          :invalidFeedback="invalidFeedbacks.password">
          <template v-slot:label-icon>
            <Password />
          </template>
        </Input>
        <Input type="password" label="Confirm Password" name="password_confirmation"
          id="register-confirm-password"
          :invalidFeedback="invalidFeedbacks.confirmPassword">
          <template v-slot:label-icon>
            <Password />
          </template>
        </Input>
        <div class="text-center">
          <Button type="submit" :disabled="formLoading">Register</Button>
        </div>
      </form>
    </Card>
  </div>
</template>