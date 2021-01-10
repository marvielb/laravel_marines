import axios from "axios";

const state = () => ({
  endpoint: '',
  response: {},
  searchField: '',
  searchTerm: '',
});

const getters = {
  contents(state) {
    if (state.response) {
      return state.response.data;
    } else {
      return [];
    }
  },
  pagination_info(state) {
    if (state.response) {
      return {
        prev_page_url: state.response.prev_page_url,
        next_page_url: state.response.next_page_url,
        from: state.response.from,
        to: state.response.to,
        total: state.response.total,
      };
    } else {
      return {};
    }
  },
}

const actions = {
  async getContents({ commit, state }) {
    const { endpoint } = state;
    let url = '';
    try {
      url = new URL(location.origin + endpoint);
    } catch {
      url = new URL(endpoint);
    }
    if (state.searchTerm) {
      url.searchParams.set('searchField', state.searchField);
      url.searchParams.set('searchTerm', state.searchTerm);
    }
    try {
      const response = await axios.get(url);
      commit('setResponse', { response: response.data })
    } catch (res) {
      alertify.error(res.response.data.message);
    }
  },
  async setEndPoint({ commit, dispatch }, endpoint) {
    commit('setEndPoint', { endpoint });
    dispatch('getContents');
  },
  async setSearchParams({ commit, dispatch }, { searchField, searchTerm }) {
    commit('setSearchParams', { searchField, searchTerm })
    dispatch('getContents');
  }
}

const mutations = {
  setResponse(state, { response }) {
    state.response = response;
  },
  setEndPoint(state, { endpoint }) {
    state.endpoint = endpoint;
  },
  setSearchParams(state, { searchField, searchTerm }) {
    state.searchField = searchField;
    state.searchTerm = searchTerm;
  }
}


export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}