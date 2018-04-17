new window.App({
  el: '#app',
  data : function(){
    return {
      url: null,
      copyText: 'Copy',
      copyBtn: false
    }
  },
  methods : {
    saveUrlButton(){
      if(this.url == null) {
        alert('Please fill the url')
        return false
      }

      let vm = this
      window.axios.get(`/loyalty/insertReferralCode?code=${this.url}`)
          .then(function (response) {
            alert(response.data.message)
            console.log(response.data.status)
            if(response.data.status === 1){
              vm.copyBtn = true
              vm.copyText = 'copy'
              vm.url = response.data.code
            }
          })
    },
    copyUrl(){
      let textArea = document.createElement("textarea");
      textArea.style.position = 'fixed';
      textArea.style.top = 0;
      textArea.style.left = 0;
      textArea.style.width = '2em';
      textArea.style.height = '2em';
      textArea.style.padding = 0;
      textArea.style.border = 'none';
      textArea.style.outline = 'none';
      textArea.style.boxShadow = 'none';
      textArea.style.background = 'transparent';
      textArea.value = $("#linkUrl").val();
      document.body.appendChild(textArea);
      textArea.select();

      try {
        document.execCommand('copy');
        this.copyText = 'copied'
      } catch (err) {
        console.log('Oops, unable to copy');
      }

      document.body.removeChild(textArea);
    },
    random4(){
      let vm = this
      window.axios.get('/loyalty/getRandom4')
          .then(function (response) {
            vm.url = response.data.data.number
          })
    }
  },
  components : {

  },
  watch : {

  },
  mounted : function(){
    this.random4()
  },
});