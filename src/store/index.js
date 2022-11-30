import { createStore } from 'vuex'

export default createStore({
  state: {
    fullName: "Mohamed Salem Lekbar",
    count: 5,
    todoList: [
      {id: 0, ex: "HomeWork", done: true},
      {id: 1, ex: "quizes", done: true},
      {id: 2, ex: "Exams", done: false},
    ],
  },
  getters: {
    todoListDone: (state) => {
      return state.todoList.filter((v) => v.done);
    },
    getToDoListById: (state) => (id) => {
      return state.todoList.filter((v) => v.id == id);
    }
  },
  mutations: {
    increment(state) {
      state.count++;
    },
    decrement(state) {
      state.count > 0 ? state.count-- : '';
    }
  },
  actions: {
    a_increment({commit}) {
        commit('increment');
    }
  },
  modules: {
  }
})
