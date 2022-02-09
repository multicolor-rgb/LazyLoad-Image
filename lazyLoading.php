<?php
 
# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'LazyLoading', 	//Plugin name
	'1.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://www.multicolor.stargard.pl/', //author website
	'lazy Loading for images on page content', //Plugin description
	'plugins', //page type - on which admin tab to display
	'lazyloading'  //main function (administration)
);
 
add_action( 'theme-footer', 'lazyLoadingScript', array() );
add_action( 'content-top', 'lazyLoadingStartDiv', array() );
add_action( 'content-bottom', 'lazyLoadingEndDiv', array() );


function lazyLoadingStartDiv(){
	echo'<div class="lazyloading-content">';
};

function lazyLoadingEndDiv(){
	echo'</div>';
}


function lazyLoadingScript(){
echo <<<END
<style>
.lazyLoading{
opacity:0;
animation:lazyLoading 250ms 500ms linear;
animation-fill-mode:forwards;
}

@keyframes lazyLoading{
from{
opacity:0;
}
to{
opacity:1;
}}
</style>


<script>
document.querySelectorAll('.lazyloading-content img').forEach((e)=>{	
	e.setAttribute('data-lazyloading',e.getAttribute('src'));
	e.removeAttribute('src');
});


const images = document.querySelectorAll('.lazyloading-content img');
observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.intersectionRatio > 0) {
let entryImg = entry.target.getAttribute('data-lazyloading');
	 entry.target.setAttribute('src',entryImg);
	 entry.target.classList.add('lazyLoading');
    }
  });
});

images.forEach(image => {
  observer.observe(image);
});
</script>
END;
}


function lazyloading(){
};

?>