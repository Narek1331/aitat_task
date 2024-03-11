import { createStore } from 'vuex';
import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL + '/api/rfm-segments';

export default createStore({
  state: {
    segments: [],
  },
  mutations: {
    setSegments(state, segments) {
      state.segments = segments;
    },
  },
  actions: {
    async fetchSegments({ commit }) {
      try {
        const response = await axios.get(API_URL);
        commit('setSegments', response.data);
      } catch (error) {
        console.error('Error fetching segments:', error);
      }
    },
  },
  getters: {
    getSegments(state) {
      return state.segments;
    },
  },
});
