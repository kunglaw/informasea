<?php // js_under , profile?>

<script type="text/javascript">
    // $(document).ready(function(){

    // });

    var activeTab = null;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      activeTab = e.target;
      console.log(activeTab);
      if($(activeTab).attr('href') == "#resume") {
        $('#right-widget').addClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      } else {
        $('#right-widget').removeClass('hidden-lg');
        $('#main-profile').attr('class', 'col-md-12');
      }
    });

    /*function changeLayout() {
        $('#right-widget').addClass('hidden-md');
    }*/

    if($('#resume-tab').hasClass('active')) {
        //alert('done deal!');
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });
</script>