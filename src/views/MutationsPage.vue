<template>
  <div>
    <h1 class="text-center">Mutations</h1>
    <p>{{ $store.state.count }}</p>
    <!-- <button @click="dec()" class="btn btn-danger">-</button>
    <button @click="inc()" class="btn btn-primary">+</button> -->
    <button @click="decrement" class="btn btn-danger">-</button>
    <button @click="increment" class="btn btn-primary">+</button>
</div>
</template>

<script>
import { mapMutations } from 'vuex';
export default {
    name: "MutationPage",
    methods: {
        dec() {
            this.$store.commit('decrement');
        },
        inc() {
            this.$store.commit('increment');
        },
        ...mapMutations(['decrement','increment'])
    },


}
</script>

<style>

</style>