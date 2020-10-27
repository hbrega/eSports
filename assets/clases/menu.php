<?php

class menu {
	
//	public $id;
//	public $idCountry;
	public $menu;
	
	
	function __construct() {
		
		$conn = _connect();

        
		$sql = "	SELECT id, name, url
					FROM menu
					WHERE type = 'HEADER'
						AND deletionDate IS NULL
					ORDER by menuOrder ASC
					";
		
		$result = $conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		$x=0;
		while($row = $result->fetch_assoc() ) {
			$this->menu[$x]['name']		= $row['name'];	
			$this->menu[$x]['url']		= ($row['url'] != '' ? $row['url'] : 'javascript: void(0)');	
			
			$sql2 = "	SELECT id, name, url, type
						FROM menu
						WHERE idParent = '".$row['id']."'
							AND deletionDate IS NULL
						ORDER by menuOrder ASC
						";
			
			$result2 = $conn->query($sql2) or trigger_error("Failed! SQL: $sql2 - Error: ".mysqli_error(), E_USER_ERROR);
			
			if($result2->num_rows > 0) {
				$xx=0;
				while($row2 = $result2->fetch_assoc() ) {

					$this->menu[$x][$xx]['name']	= $row2['name'];	
					$this->menu[$x][$xx]['type']	= $row2['type'];	
					$this->menu[$x][$xx]['url']		= ($row2['url'] != '' ? $row2['url'] : 'javascript: void(0)');	

					if($row2['type'] == "MENU") {
						
						$sql3 = "	SELECT id, name, url, type
									FROM menu
									WHERE idParent = '".$row2['id']."'
										AND type = 'ITEM'
										AND deletionDate IS NULL
									ORDER by menuOrder ASC
									";

						$result3 = $conn->query($sql3) or trigger_error("Failed! SQL: $sql3 - Error: ".mysqli_error(), E_USER_ERROR);
						
						if($result3->num_rows > 0) {
							$xxx=0;
							while($row3 = $result3->fetch_assoc() ) {

								$this->menu[$x][$xx][$xxx]['name']	= $row3['name'];	
								$this->menu[$x][$xx][$xxx]['url']	= ($row3['url'] != '' ? $row3['url'] : 'javascript: void(0)');	
								
								$xxx++;
							}
						}
					}
					$xx++;
				}
			}
			$x++;
		}
		
	}

	
	
	function ShowMenu($menuType) {

		$ret="";
		switch($menuType) {
			case 'header':
				
				foreach($this->menu as $m) {
					
					$ret.='
						<li>
							<a href="'.$m['url'].'">'.$m['name'].'</a>					
						';
					
					//para saber si tiene algun indice contable
					if(count($m) > 2) {
						$ret.='<ul class="main-nav__sub main-nav__sub--dropup">';

						for($x=0; $x < (count($m) -2); $x++) {
							if($m[$x]['type']=="MENU") {

								$ret.='	<li>
											<a href="'.$m[$x]['url'].'">'.$m[$x]['name'].'</a>';

								$ret.='<ul class="main-nav__sub main-nav__sub--dropup">';
								for($xx=0; $xx < (count($m[$x]) -3); $xx++) {
									$ret.='	<li>
												<a href="'.$m[$x][$xx]['url'].'">'.$m[$x][$xx]['name'].'</a>
											</li>';
								}
								$ret.='</ul>';
								
							}
							else {
								$ret.='	<li>
											<a href="'.$m[$x]['url'].'">'.$m[$x]['name'].'</a>';
							}
						}
						
						$ret.='		
								</li>
							</ul>';
					}

					$ret.='
						</li>			
						';
				}
				
				if(isset($_SESSION['idUser']) && isset($_SESSION['loginTime'])) {
					$ret.="	<li class=''>
								<a href='perfil.php'>Mi Perfil</a>
							</li>";
				}
				else {
					$ret.="	<li class=''>
								<a href='login.php'>Iniciar sesión</a>
							</li>";
				}

                
				break;

				
			case 'desktop':
	
				foreach($this->menu as $m) {
					
					$ret.='
						<li>
							<a href="'.$m['url'].'">'.$m['name'].'</a>					
						';
					
					//para saber si tiene algun indice contable
					if(count($m) > 2) {
						$ret.='<ul class="dl-submenu">';

						for($x=0; $x < (count($m) -2); $x++) {
							if($m[$x]['type']=="MENU") {

								$ret.='	<li>
											<a href="'.$m[$x]['url'].'">'.$m[$x]['name'].'</a>
											<ul class="dl-submenu">
								';
								
								for($xx=0; $xx < (count($m[$x]) -3); $xx++) {
									$ret.='	<li>
												<a href="'.$m[$x][$xx]['url'].'">'.$m[$x][$xx]['name'].'</a>
											</li>
									';
								}
								$ret.='</ul>
									</li>
								';
								
							}
							else {
								$ret.='	<li>
											<a href="'.$m[$x]['url'].'">'.$m[$x]['name'].'</a>
										</li>
								';
							}
						}
						
						$ret.='		
								
							</ul>';
					}

					$ret.='
						</li>			
						';
				}
				
				if(isset($_SESSION['idUser']) && isset($_SESSION['loginTime'])) {
					$ret.="	<li class=''>
								<a href='perfil.php'>Mi Perfil</a>
							</li>";
				}
				else {
					$ret.="	<li class=''>
								<a href='login.php'>Iniciar sesión</a>
							</li>";
				}
				
                
                
                
				break;		

				
			case 'mobile':
				
				$y=0;
				foreach($this->menu as $m) {
					
					//para saber si tiene algun indice contable
					if(count($m) > 2) {

						$ret.='
						<li class="mobile-bar-item">
							<a class="mobile-bar-item__header collapsed" data-toggle="collapse" href="#mobile_collapse_'.$y.'" role="button" aria-expanded="false" aria-controls="mobile_collapse_'.$y.'" href="'.$m['url'].'">
								'.$m['name'].'
								<span class="main-nav__toggle">&nbsp;</span>		
							</a>
							<div id="mobile_collapse_'.$y.'" class="collapse mobile-bar-item__body">
								<nav class="mobile-nav">
									<ul class="mobile-nav__list">
										<li class="">
						';

						for($x=0; $x < (count($m) -2); $x++) {

							if($m[$x]['type']=="MENU") {

								
								$ret.='	<li>
											<a href="javascript: void(0)">'.$m[$x]['name'].'</a>
											<ul class="mobile-nav__sub">
								';
											
											
								for($xx=0; $xx < (count($m[$x]) -3); $xx++) {
									$ret.='	<li>
												<a href="'.$m[$x][$xx]['url'].'">'.$m[$x][$xx]['name'].'</a>
											</li>';
								}


								$ret.='		</ul>
										</li>	
								';

							}
							else {
								
								$ret.='	<li>
											<a href="'.$m[$x]['url'].'">'.$m[$x]['name'].'</a>
										</li>	
										';

							}
						}

						$ret.='
										</li>
									</ul>
								</nav>
							</div>';
						
					}
					else {
						
						$ret.='
						<li class="mobile-bar-item">
							<a class="mobile-bar-item__header" href="'.$m['url'].'">'.$m['name'].'</a>
						</li>
						';
					}
					
					$y++;
				}
				
				
				if(isset($_SESSION['idUser']) && isset($_SESSION['loginTime'])) {
					$ret.="	<li class='mobile-bar-item'>
								<a class='mobile-bar-item__header' href='perfil.php'>
									Mi Perfil
								</a>
							</li>";
				}
				else {
					$ret.="	<li class='mobile-bar-item'>
								<a class='mobile-bar-item__header' href='login.php'>
									Registrarse / Iniciar Sesión
								</a>
							</li>";
				}

                
				break;		
		}
		
		return $ret;
	} 

}


?>