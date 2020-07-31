<template>

</template>



<script type="text/javascript">

import {mapMutations} from 'vuex'
export default {
   created(){
       this.logout()
   }, methods: {
     ...mapMutations([
      'logout'
    ])
  },

}
</script>

