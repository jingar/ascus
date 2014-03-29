  $.ajax({
    url: 'gettags.php',
    dataType: 'json',
    success:function (data){
      //data should be a json object that returns an array
      $.each(data,function(i,v){
        $('#tags li.tagit-new input').val(v);
        $('#tags li.tagit-new input').blur();
      })
    }
  });

  $.ajax({
    url: 'getinteresttags.php',
    dataType: 'json',
    success:function (data){
      //data should be a json object that returns an array
      $.each(data,function(i,v){
        $('#interest-tags li.tagit-new input').val(v);
        $('#interest-tags li.tagit-new input').blur();
      })
    }
  });