function minBodyH(){
    var $winHeight=$(window).height();
    var $headHeight=$('.h-header').height();
    var $footHeight=$('.f-footer').height();


    var $bodyH =$winHeight-($headHeight+$footHeight);
    $('.b-body').css('min-height',$bodyH);
}
$(document).ready(function(){
    minBodyH();
});
$(window).resize(function(){
    minBodyH();
});