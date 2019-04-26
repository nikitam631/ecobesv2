<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- EMOJI PICKER -->
<script src="./js/emojiPicker.min.js"></script>
<script src="https://raw.githubusercontent.com/alexcorvi/anchorme.js/gh-pages/dist-browser/anchorme.min.js" charset="utf-8"></script>
<script src="./js/autolink.js"></script>

<script type="text/javascript">
jQuery(function ($) {
  $('.taskbody').autolink();
});
</script>

<script>
  (() => {
    new EmojiPicker()
  })()
</script>

<script type="text/javascript">
    $('.dropdown').click(function(){
      $(this).find('ul').toggle();
      $('.dbzm').hide();
      $('.dbznm').hide();
      console.log('jhjk');
    });
    $(document).click( function(){
    $('.dropdown-menu').hide();
});
</script>
@yield('scripts')
