import { TweenLite, Elastic, CSSPlugin, TimelineLite } from "gsap";

require ("Draggable");
module.exports = {
    priority: 1000,
    params: ['btnid'],
    bind: function () {
        var dragbtn = $(this.el);
        console.log('btnid=' + this.params.btnid)
        Draggable.create(dragbtn, {
            type:"x,y",
            bounds: $(this.$parent),
            onClick:function() {
                      console.log("clicked");
                  },
            onDragEnd:function() {
                      console.log("drag ended");
                  }
        });
        // this.el.addEventListener(
        //     'submit', this.onSubmit.bind(this)
        // );
    }
}
