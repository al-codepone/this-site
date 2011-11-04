function deleteSection() {
   var form = document.getElementById('f1i9j');
   var agree = confirm("Delete section?");

   if(agree) {
      form.x7n.value = 1459;
      form.submit();
   }
}
