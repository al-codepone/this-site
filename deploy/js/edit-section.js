function deleteSection() {
   var form = document.getElementById('section_form');
   var agree = confirm('Delete section?');

   if(agree) {
      form.delete_flag.value = 1;
      form.submit();
   }
}
