$(function() {
  $('#display-interest-tags').tagit({
    readOnly: true
  });
  $("#display-tags").tagit({
    readOnly: true,
    allowSpaces: true
  });
});


$.ajax({
  url: 'gettags.php?id=' + getParameterByName("id"),
  dataType: 'json',
  success:function (data){
      //data should be a json object that returns an array
      $.each(data,function(i,v){
        $('#display-tags li.tagit-new input').val(v);
        $('#display-tags li.tagit-new input').blur();
      });
      $('#display-tags li.tagit-new').remove();
    }
  });

  $.ajax({
    url: 'getinteresttags.php?id=' + getParameterByName("id"),
    dataType: 'json',
    success:function (data){
      //data should be a json object that returns an array
      $.each(data,function(i,v){
        $('#display-interest-tags li.tagit-new input').val(v);
        $('#display-interest-tags li.tagit-new input').blur();
    });
      $('#display-interest-tags li.tagit-new').remove();
  }
});

