// route 
var r_proses_login = server + "login/proses";
console.log(r_proses_login);
// vue object 
var app_login = new Vue({
  el : '#login-app',
  data : {

  },
  methods : {
    masuk_atc : function()
    {
      axios.post(r_proses_login).then(function(res){
        let dr = res.data;
        console.log(dr);
      });
    }
  }
});
// insialisasi 
document.querySelector("#txt_username").focus();