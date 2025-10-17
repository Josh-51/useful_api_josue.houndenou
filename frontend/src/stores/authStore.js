import { defineStore } from 'pinia'
import api  from '../api/utils';


export const useUsersStore = defineStore('board', {
  state: () => ({
    loading: false,
    error: null,
    currentUser: null,
  }),
  actions: {

    async register (data) {
      this.loading = true;
      try {
        const res =  await api.post("/register", data)
        return res.data
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
        return null;
      } finally {
        this.loading = false;
      }
    },

    async login (data) {
      this.loading = true;
      try {
        const res =  await api.post("/login", data)
        this.currentUser = res.data;

        // localStorage.setItem("user", JSON.stringify( res.data ) );

        return res.data
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
        console.log(this.error);

        return null;
        // throw e;
      } finally {
        this.loading = false;
      }
    },
  },

  persist: true,
})
