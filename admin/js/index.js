var working = false;
$('.login').on('submit', function(e) {
  e.preventDefault();
  var user = $(".login input[type='text']").val();
  var pass = $(".login input[type='password']").val();
  $.post('php/login.php',{user:user,pass:pass},function(data){
    if(data != 0){
      if (working) return;
      working = true;
      var $this = $(".login"),
        $state = $this.find('button > .state');
      $this.addClass('loading');
      $state.html('Authenticating');
      setTimeout(function() {
        $this.addClass('ok');
        $state.html('Welcome back!');
        setTimeout(function() {
          $state.html('Log in');
          $this.removeClass('ok loading');
          working = false;
        }, 4000);
        setTimeout(5000);
        window.location.replace("html/");
      }, 3000);
      
    }else{
      alert("Failure on submission.");
    }
  });
  
});