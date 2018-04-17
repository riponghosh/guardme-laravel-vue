new window.App({
  el: '#app',
  data : function(){
    return {
      total: 0,
      after: 0,
      referral_credit_id: ''
    }
  },
  methods : {
    redeemBtn(url, id){
      const vm = this;

      window.axios.get(url)
          .then(function (response) {
            vm.total = response.data.data.credit
            vm.after = response.data.data.total_credit - vm.total
            vm.referral_credit_id = id
          })
      ;
    }
  },
  components : {

  },
  watch : {

  },
  mounted : function(){

  },
});