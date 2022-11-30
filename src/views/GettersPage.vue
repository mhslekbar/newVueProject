<template>
  <div>
    <h1>Getters Page</h1>
    <!-- <p v-for="(list, i) in todoListItems" :key="i">
      {{ list.id }} : {{ list.ex }} => {{ list.done }}
    </p> -->
    <p v-for="(list, i) in todoListDone" :key="i">
        {{ list.id }} : {{ list.ex }} => {{ list.done }}
    </p>
    <p>{{ getToDoListById(2) }}</p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  name: "GettersPage",
  computed: {
    todoListItems() {
      return this.$store.state.todoList.filter((v) => v.done);
    },
    ...mapGetters(['todoListDone','getToDoListById'])
  },
};
</script>

<style></style>
