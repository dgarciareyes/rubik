function SoloNumeros(evt) {
    if (window.event) {
      keynum = evt.keyCode;
    } else {
      keynum = evt.which;
    }
    if ((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13) {
      return true;
    } else {
      alert("Ingrese solo números!!");
      return false;
    }
  }
  
 
  
  function rutdv(T) {
    var M = 0,
      S = 1;
    for (; T; T = Math.floor(T / 10)) S = (S + (T % 10) * (9 - (M++ % 6))) % 11;
    //return S?S-1:'k';
    //alert(S?S-1:'k');
    document.getElementById("dv").value = S ? S - 1 : "k";
  }
  