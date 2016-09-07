<template>

</template>
 <style>

 </style>
 <script>

 export default  {
     components: {

     },
     props: [

     ],
     ready() {
         console.log('RichTextEditor');
     },
     data: function() {
         return {

         }
     },
     computed: {
         canCreate: function() {
             if(this.formView === 'create'){
                 return true
             } else {
                 return false
             }


         },
         canListView: function() {
             if(this.formView != 'list' ){
                 return false
             } else {
                 return true
             }

         },
         canPreview: function() {
             if(this.formView === 'edit'){
                 return false
             } else {
                 return true
             }
         },
     },

     methods : {
         vcbind: function () {
            var self = this;
            CKEDITOR.replace(this.el.id, {
                filebrowserWindowFeatures: 'resizable=no',
                filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
            });
            CKEDITOR.instances[this.el.id].setData(this.params.content);
            CKEDITOR.instances[this.el.id].on('change', function () {
               self.set(CKEDITOR.instances[self.el.id].getData());
               $(this.el).trigger('makedirty');
             });
         },
         vcupdate: function (value) {
              $(this.el).trigger('change');
         },
         vcunbind: function () {
              CKEDITOR.instances[this.el.id].destroy();
          }


     },


     // the `events` option simply calls `$on` for you
     // when the instance is created
     events: {

     }
 }
 </script>
