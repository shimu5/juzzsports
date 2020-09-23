<div class="head_block">
  <p class="welcome-msg">Welcome to our online store! </p>
  <form id="search_mini_form" action="#" method="get">
    <div class="form-search">
      <label for="search">Search:</label>
      <input id="search" type="text" name="q" value="" class="input-text search" autocomplete="off"/>
      <button type="submit" title="Search" class="button"><strong><i class="fa fa-search"></i></strong></button>
      <div id="result" class=""></div>
    </div>
  </form>

</div>

<script type="text/javascript">
    jQuery(function ($) {
        $(".search").keyup(function () {
            var searchid = $(this).val();
            var dataString = 'search=' + searchid;
            if (searchid != '') {
                $.ajax({
                    type: "POST",
                    url: "../search.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#result").html(html).show();
                    }
                });
            }
            return false;
        });

        jQuery("#result").live("click", function (e) {
            var $clicked = $(e.target);
            var $name = $clicked.find('.name').html();
            var decoded = $("<div/>").html($name).text();
            $('#search').val(decoded);
        });
        jQuery(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search")) {
                jQuery("#result").fadeOut();
            }
        });
        $('#search').click(function () {
            jQuery("#result").fadeIn();
        });
    });
</script>


<script type="text/javascript">
    jQuery('a').click(function(){
        window.location.href = jQuery(this).attr('href');
    });
</script>
<style type="text/css">
    #result {
        position: absolute;
        width: 445px;
        padding: 10px;
        display: none;
        margin-top: 40px;
        border-top: 0px;
        overflow: hidden;
        background-color: white;
        font-size: 13px;

    }

    .show {
        padding: 10px 10px 20px 10px;
        font-size: 13px;
        height: 40px;
    }

    .show:hover {
        color: #000000;
        cursor: pointer;
    }
</style>