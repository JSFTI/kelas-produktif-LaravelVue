<script setup>
import { ref } from 'vue';
import { Button } from '@/src/components/input'
import IconHamburger from '~icons/charm/menu-hamburger';

const collapsed = ref(true);

const pages = [
  {path: '/dasar-komponen', name: "Dasar Komponen Vue"},
  {path: '/vue-router', name: "Vue Router"},
];

function handleCollapse(){
  document.body.classList.toggle('no-scroll');
  collapsed.value = !collapsed.value;
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
        </ul>
      </div>
    </nav>
  </header>
</template>
<style scoped lang="scss">
  .navbar{
    @apply h-14 shadow-lg flex items-center fixed w-full bg-white;
    .navbar-logo{
      @apply ml-7 font-semibold;
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

        @screen md{
          @apply md:flex gap-7 w-auto
        }
      }
    }
  }
</style>