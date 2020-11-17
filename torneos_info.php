<?php

require("_header.php");


$torneo = new Torneo($_GET['id']);

if($torneo->nombre == "") {
    echo("<script>window.location='index.php'</script>");
    die();
}





?>




		<main class="site-content" id="wrapper">
			<div class="site-content__inner" style="background-color: transparent !important">
				<div class="site-content__holder">
					
					<figure class="page-thumbnail page-thumbnail--default">
						<img class="page-bg-logo" src="<?=$torneo->juego->logo?>" alt="">
						<div class="ncr-page-decor">
							<div class="ncr-page-decor__layer-1">
								<div class="ncr-page-decor__layer-bg"></div>
							</div>
							<div class="ncr-page-decor__layer-2"></div>
							<div class="ncr-page-decor__layer-3">
								<div class="ncr-page-decor__layer-bg"></div>
							</div>
							<div class="ncr-page-decor__layer-4"></div>
							<div class="ncr-page-decor__layer-5"></div>
							<div class="ncr-page-decor__layer-6"></div>
						</div>
					</figure>

						
					<article class="post post--single">
						<div class="page-content">
							<div class="post__header">
								<div class="post__cats h6">
									<span>ESPORTS</span>
								</div>

								<h2 class="post__title h3"><?=$torneo->nombre?></h2>
							</div>

                            
                            
							<div class="post__body">
								
                                <?=$torneo->descripcion?>
                                
							</div>
						</div>
					</article>

                
                
                
                
                </div>
			</div>
		</main>




<?php

require("_middle.php");

?>



<?php

require("_footer.php");

?>