import axios from "axios";
import { defineStore } from "pinia";

export const useUser = defineStore('user', {
  state: () => {
    return {
      id: null,
      username: null,
      email: null
    }
  },
  actions: {
    getLogin(){
      return new Promise((resolve, reject) => {
        axios.get('/user')
          .then((res) => {
            resolve(true);
            Object.assign(this, res.data);
          })
          .catch((err) => {
            reject(err)
          });
      }); 
    }
  }
});