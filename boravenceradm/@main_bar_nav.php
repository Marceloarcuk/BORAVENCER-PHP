<?PHP 
	$continua = True;
	$a1 = $_SERVER['PHP_SELF'];
	while ($continua) {
		$ap = strpos($a1, '/');
		if (is_bool($ap) && !$ap) {
			$continua= false;
		}
		else {
		$a2 = substr($a1, $ap+1, strlen($a1)); // retorna "d"
		$a1 = $a2;
		}
	}
	$paginaatual = $a1; 
echo     '<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">';	
//<!-- ***********************************************************************  LOGOUT -->	
echo     '<div class="navbar-header">';
echo     '	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
echo     ' 	  <span class="sr-only">Toggle navigation</span>';
echo     ' 	  <span class="icon-bar"></span>';
echo     '	  <span class="icon-bar"></span>';
echo     '	  <span class="icon-bar"></span>';
echo     '	</button>';
echo     '    <table cellpadding="0px" cellspacing="0">';
echo     '      <tr>';
echo     '	    <td> &nbsp <img src="img/logo_gov_bsb.png" height="40" width="150"/></td>';
echo     '      <td> &nbsp <a class="navbar-brand" href="index.php"><b>BORAVENCER</b></a></td>     ';
echo     '      </tr>     ';
echo     '    </table>';
echo     '</div>';
echo     '<ul class="nav navbar-top-links navbar-right">';
echo     '    <li class="dropdown">';
echo     '        <a class="dropdown-toggle" data-toggle="dropdown" href="#">';
echo     '            <i class="fa fa-user fa-fw"></i> '. $_SESSION['nome'] . ' <i class="fa fa-caret-down"></i>';
echo     '        </a>';
echo     '        <ul class="dropdown-menu dropdown-user">';
echo     '            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>';
echo     '            <li class="divider"></li>';
echo     '            <li><a href="logoff.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>';
echo     '        </ul>';
echo     '    </li>';
echo     '</ul>';
//<!-- ***********************************************************************  LOGOUT -->			


//<!-- ***********************************************************  Barra de Navegação -->					
echo     '            <div class="navbar-default sidebar" role="navigation">';
echo     '                <div class="sidebar-nav navbar-collapse">';
echo     '                    <ul class="nav" id="side-menu">';
//----------------------------
//Dashboard
								if ($paginaatual == 'index.php'){ echo '<li class="active">'; } else { echo '<li>'; };
                                //<li>
echo     '                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>';
echo     '                        </li>';

//----------------------------
//Inscritos
								if ($paginaatual == 'cad_insc.php'){ echo '<li class="active">'; } else { echo '<li>'; };
                                //<li>
echo     '                            <a href="cad_insc.php"><i class="fa fa-comment-o fa-fw"></i> Inscritos</a>';
echo     '                        </li>';
//----------------------------
//Tabelas de Sistema
								if ($paginaatual == 'cad_usu.php') { echo '<li class="active">'; } else { echo '<li>'; };
echo     '                            <a href="#"><i class="fa fa-table fa-fw"></i>Tabelas de Sistema<span class="fa arrow"></span></a>';
echo     '                            <ul class="nav nav-second-level">';
								if ($paginaatual == 'cad_usu.php') { echo '<li><a class="active" href="cad_usu.php">Usuários</a></li>'; } 
								else                                { echo '<li><a href="cad_usu.php">Usuários</a></li>'; };
echo     '                            </ul>';
echo     '                        </li>	';					
echo     '                    </ul>';
echo     '                </div>';
echo     '            </div>';
echo     '        </nav>';
?>			
