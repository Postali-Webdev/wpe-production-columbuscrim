// Read More code
	jQuery(document).ready(function() {

$j('article').readmore({
  speed: 200,
  maxHeight: 300,
  collapsedHeight: 200,
  moreLink: '<a href="#" class="read_more" title="Read more about article">Read more</a>',
  lessLink: '<a href="#" class="read_more close" title="Close article">Close</a>'
});
	
});