function deletePage() {
   var form = document.getElementById('page_form');
   var agree = confirm('Delete page?');

   if(agree) {
      form.delete_flag.value = 1;
      form.submit();
   }
}
