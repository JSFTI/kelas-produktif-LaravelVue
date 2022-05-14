<script setup>
import { ref } from 'vue';
import { Button } from '@/src/components/input'
import IconHamburger from '~icons/charm/menu-hamburger';
import IconPowerSettingsNew from '~icons/material-symbols/power-settings-new';
import { useUser } from '@/stores/user';
import axios from 'axios';

const user = useUser();

const collapsed = ref(true);

const pages = [
  {path: '/posts', name: "Posts"}
];

function handleCollapse(){
  document.body.classList.toggle('no-scroll');
  collapsed.value = !collapsed.value;
}

function handleLogout(){
  axios.post('/logout')
    .then(() => {
      user.$reset();
    });
}
</script>
<template>
  <header>
    <nav class="navbar">
      <router-link :to="'/'" class="navbar-logo">
        Kelas Produktif
      </router-link>
      <div :class="['navbar-nav', collapsed ? 'collapsed' : 'uncollapsed']">
        <Button class="navbar-collapse-button" @click="handleCollapse" :active="collapsed">
          <template v-slot:icon>
            <IconHamburger />
          </template>
        </Button>
        <ul :class="['navbar-nav-list']">
          <li v-for="route in pages" :key="route.name" class="navbar-nav-item">
            <router-link :to="route.path">{{ route.name }}</router-link>
          </li>
          <li class="navbar-nav-item" v-if="user.id === null">
            <router-link :to="'/register'">Register/Login</router-link>
          </li>
          <li class="navbar-nav-item" v-if="user.id !== null">
            <router-link :to="'/profil'">Profil</router-link>
          </li>
          <li class="navbar-nav-item" v-if="user.id !== null">
            <a href="javascript:void(0)" @click="handleLogout"><IconPowerSettingsNew /></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>
<style scoped lang="scss">
  .navbar{
    @apply h-14 shadow-lg flex items-center fixed w-full bg-white z-50;
    .navbar-logo{
      @apply ml-7 font-semibold text-black;
    }

    .navbar-nav{
      @apply ml-auto mr-7 flex items-center;

      .navbar-collapse-button{
        @apply text-xl block md:hidden;
      }

      @media only screen and (max-width: 768px){
        &.collapsed{
          .navbar-nav-list{
            @apply w-0 overflow-hidden;
          }
        }

        &.uncollapsed{
          .navbar-nav-list{
            width: 80vw;
            height: calc(100vh - 3.5rem);
            @apply z-20 bg-white absolute top-14 right-0 text-left flex flex-col gap-4;

            .navbar-nav-item{
              @apply ml-5 text-xl;

              &:first-child{
                @apply mt-3;
              }
            }
          }

          &::before{
            content: '';
            background-color: rgba(128, 128, 128, 0.25);
            @apply absolute w-full h-screen left-0 top-14 z-10;
          }
        }
      }

      .navbar-nav-list{
        width: 175px;

        .navbar-nav-item a{
          @apply text-black;
        }

        @screen md{
          @apply md:flex gap-7 w-auto
        }
      }
    }
  }
</style>