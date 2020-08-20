
  function validateForm() {


    var br=0;  
    var i = 1;
  //alert(document.get);
    while(document.getElementById("checkbox"+i)) {
  //alert("USAO");
    //document.getElementsByName("brisi"+i);
      var checkboxes = document.getElementById("checkbox"+i);
      if (checkboxes.checked) {
        br++;
       
      }
      i++;
    }
    if(br==0){
      return;
    }
  if(br==1){
    return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" ред?");
  }
  else if(br<5){
  return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" реда?");
  }
  else {return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" редова?");}
  
  }


