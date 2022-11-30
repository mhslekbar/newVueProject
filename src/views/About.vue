<template>
  <div class="about">
    <h1>This is an about page</h1>
    <p>FullName : {{ aliasFullName }}</p>
    <p>Combine : {{ combinePlusLocalState }}</p>    
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "About",
  data() {
    return {
      localCount: 10,
    };
  },
  computed: {
    ...mapState({
        count: state => state.count,
        aliasFullName: 'fullName',
        combinePlusLocalState(v) {
            return v.count * this.localCount;            
        }
        
    }),
  },
};
</script>
