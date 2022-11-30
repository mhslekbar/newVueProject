<template>
  <div>
    <h1 class="text-center">Action Page</h1>
    <p>{{ count }}</p>
    <button @click="a_increment">Normal Action Method</button>
    <button @click="m_increment">Dispatch Action Method</button>
    <button @click="decrement">Decrement | Mutations</button>
  </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";

export default {
  name: "ActionsPage",
  computed: {
    ...mapState(['count'])
  },
  methods: {
    ...mapActions(['a_increment']),
    ...mapMutations(['decrement']),
    m_increment() {
      this.$store.dispatch('a_increment');
    }
  }
}
</script>

<style>

</style>