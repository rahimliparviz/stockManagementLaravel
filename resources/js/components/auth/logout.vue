<template>

</template>



<script type="text/javascript">
    
import {mapMutations} from 'vuex'
export default {
   created(){
    this.$router.push({ name: '/'})
    this.logout()
   }, methods: {
     ...mapMutations([
      'logout'
    ])
  },
 
}
</script>


<style type="text/css">
	
</style>