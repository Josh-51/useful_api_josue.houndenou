import { defineStore } from 'pinia'
import api  from '../api/utils';


export const useModuleStore = defineStore('board', {
  state: () => ({
    loading: false,
    error: null,

  }),
  actions: {

    async fetchModuleActive () {
      this.loading = true;
      try {
        const res =  await api.get("/modules")
        return res.data
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
        return null;
      } finally {
        this.loading = false;
      }
    },

    async activateModule (id) {
      this.loading = true;
      try {
        const res =  await api.post(`/modules/${id}/activate`)
        return res.data
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
        return null;
      } finally {
        this.loading = false;
      }
    },

    async deactivateModule (id) {
      this.loading = true;
      try {
        const res =  await api.post(`/modules/${id}/deactivate`)
        return res.data
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
        return null;
      } finally {
        this.loading = false;
      }
    },
  }
})
