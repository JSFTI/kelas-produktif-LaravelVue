<script setup>
import { useUser } from '@/stores/user';
import UserCircle from '~icons/ph/user-circle';
import Password from '~icons/carbon/password';
import { onBeforeMount, ref } from 'vue';
import { useRouter } from 'vue-router';
import loginValidation from '@/validators/login';
import axios from 'axios';

const user = useUser();
const router = useRouter();

const invalidFeedbacks = ref({});
const formLoading = ref(false);

onBeforeMount(() => {
  if(user.id !== null){
    router.replace('/');
  }
});

function handleLogin(e){
  invalidFeedbacks.value = {};
  formLoading.value = true;

  const formData = new FormData(e.target);
  const jsonData = Object.fromEntries(formData);

  loginValidation(jsonData)
    .then(() => {
      axios.post('/login', jsonData)
        .then((res) => {
          user.$patch(res.data);
          router.push('/');
          formLoading.value = false;
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
};
</script>
<template>
  <div class="w-full flex justify-center">
    <Card class="md:w-[400px] md:mx-0 w-screen mx-4 pb-4 px-4">
      <div class="text-center">
        <h1 class="font-bold text-3xl">Login</h1>
        <small class="text-center">Belum ada akun? <router-link :to="'/register'">Daftar di sini</router-link></small>
      </div>
      <form @submit.prevent="handleLogin">
        <Input label="Username" name="username" id="register-username"
          :invalidFeedback="invalidFeedbacks.username"
          placeholder="Masukkan username atau email"
        >
          <template v-slot:label-icon>
            <UserCircle />
          </template>
        </Input>
        <Input type="password" label="Password" name="password" id="register-password"
          autocomplete="new-password"
          :invalidFeedback="invalidFeedbacks.password"
        >
          <template v-slot:label-icon>
            <Password />
          </template>
        </Input>
        <div class="color-danger text-center mb-3" v-if="invalidFeedbacks.status">
          {{invalidFeedbacks.status}}
        </div>
        <div class="text-center">
          <Button type="submit">
            Login
          </Button>
        </div>
      </form>
    </Card>
  </div>
</template>