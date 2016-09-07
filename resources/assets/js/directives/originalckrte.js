module.exports = {
    twoWay: true,
    priority: 1000,
    deep:true,
    params: ['content'],
    bind: function () {
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
        });
    },
    update: function (value) {
         $(this.el).trigger('change');
    },
    unbind: function () {
         CKEDITOR.instances[this.el.id].destroy();
     }
 }
