import { createStore } from 'vuex';
import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL + 'auth/';

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
        const response = await axios.get('http://localhost/api/rfm-segments');
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
