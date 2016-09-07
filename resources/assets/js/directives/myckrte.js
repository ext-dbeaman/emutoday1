module.exports = {
    twoWay: true,
    priority: 1000,
    params: ['content','fresh'],
    paramWatchers: {
    content: function (val, oldVal) {
      console.log('a changed!')
    }
},
    bind: function () {
        console.log(this.setupEditor);
        this.vm.$nextTick(this.setupEditor.bind(this));

    },
    setupEditor: function(){
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
           if (self.params.fresh) {
               self.params.fresh = false
               self.vm.onContentChange();
           }
          self.set(CKEDITOR.instances[self.el.id].getData());

        });
    },
    update: function (value) {
        let self = this
        if (!CKEDITOR.instances[this.el.id])
           return self.vm.$nextTick(self.update.bind(this, value));
       CKEDITOR.instances[this.el.id].setData(value);
         $(this.el).trigger('change');
    },
    unbind: function () {
         CKEDITOR.instances[this.el.id].destroy();
     }
 }
