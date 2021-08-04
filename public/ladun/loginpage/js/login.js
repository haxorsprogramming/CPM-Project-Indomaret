// route 
var r_proses_login = server + "login/proses";
var r_dashboard = server + "dashboard/";
// vue object 
var app_login = new Vue({
  el : '#login-app',
  data : {

  },
  methods : {
    masuk_atc : function()
    {
      let username = document.querySelector("#txt_username").value;
      let password = document.querySelector("#txt_password").value;
      let ds = {'username':username, 'password':password}
      if(username === '' || password === ''){
        pesanUmumApp('warning', 'Isi field!!!', 'Lengkapi field yang ada !!!');
      }else{
        axios.post(r_proses_login, ds).then(function(res){
          let dr = res.data;
          if(dr.status === 'no_user'){
            pesanUmumApp('warning', 'No user!!!', 'Tidak ada user yang terdaftar !!!');
          }else if(dr.status === 'wrong_password'){
            pesanUmumApp('warning', 'Wrong password!!!', 'Username / password salah !!!');
          }else{
            window.location.assign(r_dashboard);
          }
        });
      }
      
    }
  }
});
// insialisasi 
document.querySelector("#txt_username").focus();

function pesanUmumApp(icon, title, text)
{
  Swal.fire({
    icon : icon,
    title : title,
    text : text
  });

}