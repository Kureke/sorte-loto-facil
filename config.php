<?php

#CONFIGURAÇÕES
$empresaNome = 'Sorte Loto Fácil';
$empresaRazaoSocial = '';
$empresaRazaoCnpj = '';
$empresaSlogan = 'A sorte está com você';
$empresaResponsavel = 'Mestre da Loto Fácil';
$empresaEndereco = '';
$empresaBairro = '';
$empresaCidade = '';
$empresaEstado = '';
$empresaCep = '';
$empresaEmail1 = '';
$empresaEmail2 = '';
$empresaEmailOuvidoria = '';
$empresaTelefone1 = '';
$empresaTelefone2 = '';

$titulo = $empresaNome . ' - ' . $empresaSlogan . '.';
$paginaRodape = $empresaNome . ' - ' . $empresaSlogan . '.' ;
$paginaRodape.='<br />';
$paginaRodape.= 'Desenvolvido por: Mágico da Sorte';

$limitador = 200;
require_once './ultimoResultado.php';
#$globalUltimoResultado = '3 5 6 7 8 9 10 12 13 14 18 21 22 24 25';

# CONFIGURAÇÕES DOS MENUS

   function sistemaMenu(){ ?>
    <nav class="art-nav clearfix">
        <div class="art-nav-inner">
        <ul class="art-hmenu">
            <li><a href="index.php">Teste o seu jogo</a></li>
            <li><a href="index.php?acao=previsao">Previsão de Jogos</a></li>
            <li><a href="index.php?acao=resultados">Resultados e Análise</a></li>
            <li><a href="#">+</a>
                <ul>
                    <li><a href="index.php?acao=conferencia">Confira seus Volantes</a></li>
                    <li><a href="index.php?acao=downloads">Downloads</a></li>
                    <li><a href="index.php?acao=carregarResultados">Editar Resultados</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </nav>

    <?php
   }

   
   #CARREGAMENTO DE PAGINAS
    function centroPagina(){
        
        $acao = NULL;
        
        if (isset($_GET['acao'])){
             if ($_GET['acao']!=null) {
                 $acao=$_GET['acao'];
             }
        } else {
            if (isset($_POST['acao'])){
                if ($_POST['acao']!=null) {
                    $acao=$_POST['acao'];
                }
            }
        }

        if ($acao==NULL) {
            paginaInicial();
        } elseif ($acao=='inicio') {
            paginaInicial();
        } elseif ($acao=='downloads') {
            paginaDownloads();
        } elseif ($acao=='resultados') {
            paginaResultados();
        } elseif ($acao=='conferencia') {
            paginaConferencia();
        } elseif ($acao=='previsao') {
            paginaPrevisao();
        } elseif ($acao=='carregarResultados') {
            configCarregarResultados();
        } else {
            paginaInicial();
        }
        
    }
    
    
function trataJogo($jogo) {
    #Tratamento de erros

    #$jogo = nl2br($jogo);
    #$arrayJogoExplode = explode('    <br />', $jogo);$jogo = implode('',$arrayJogoExplode);
    #$arrayJogoExplode = explode('   <br />', $jogo);$jogo = implode('',$arrayJogoExplode);
    #$arrayJogoExplode = explode('  <br />', $jogo);$jogo = implode('',$arrayJogoExplode);
    #$arrayJogoExplode = explode(' <br />', $jogo);$jogo = implode('',$arrayJogoExplode);
    #$arrayJogoExplode = explode('<br />', $jogo);$jogo = implode('',$arrayJogoExplode);

    $jogo = str_replace("\r\n", "\n", $jogo);
    $jogo = str_replace("\r", "\n", $jogo);
    $jogo = str_replace("\n", "", $jogo);
    $jogo = str_replace("\r", "", $jogo);
    
    #String str = array[i].trim();  
    $jogo = trim($jogo);
    
    $arrayJogoExplode = explode('-', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode(',', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('	', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode(';', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('.', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode(':', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('       ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('      ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('     ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('    ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('   ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    $arrayJogoExplode = explode('  ', $jogo); $jogo= implode(' ', $arrayJogoExplode);
    
    #trata zeros nos resultados
    $arrayJogoIndividual = explode(' ', $jogo);
    for($j=0; $j < count($arrayJogoIndividual); $j++) {

        if ($arrayJogoIndividual[$j] < 10) {
            $tmpArrayJogoIndividual = explode('0',$arrayJogoIndividual[$j]);
            $arrayJogoIndividual[$j] = implode($tmpArrayJogoIndividual);
        }
        
        $arrayJogoIndividual[$j] = trim($arrayJogoIndividual[$j]);
        
    }
    $jogo = implode(' ', $arrayJogoIndividual);
    $jogo = trim($jogo);
    return $jogo;
}    

function validaJogo($jogo) {

    $arrayJogo=explode(" ", $jogo);
    
    if (count($arrayJogo) < 15 || count($arrayJogo) > 18) {
        return 0;
    } else {
        return 1;
    }
    
    
}    
function validaJogoAlg14($jogo) {
    $arrayJogo=explode(" ", $jogo);    
    
    $arrayJogo[count($arrayJogo) -1] = intval($arrayJogo[count($arrayJogo) -1]);
    $resultadoFinalMaior = 999;
    $contagemValor5 = 0;
    $contagemValor6 = 0;
    $contagemValor7 = 0;
    $contagemValor8 = 0;
    $bufferRf = 0;
    
    require './resultado.php';
    
    $i=0;
        while ($i < count($resultado)) {
            $jogoPesquisa = implode(" ", $resultado[$i]);
            $jogoPesquisa1 = explode(" ", $jogoPesquisa);
            $diferencas = count(array_diff($jogoPesquisa1, $arrayJogo));
            
            #echo 15 - $diferencas . ' ';
            if ($resultadoFinalMaior >= $diferencas) {
                $resultadoFinalMaior = $diferencas;
            }
            
            if ($diferencas == 10) {
                #echo $diferencas . '<br />';
                $contagemValor5++;
            }
            if ($diferencas == 9) {
                #echo $diferencas . '<br />';
                $contagemValor6++;
            }
            
            
            #if ($resultadoFinalMaior <= 1) {
                #break;
            #}
            $i++;
        }
    #calcula o jogo, e retorna o valor 0 não vale a pena jogar
    $resultado = 15 - $resultadoFinalMaior;
    return $resultado . ',' . $contagemValor5 . ',' . $contagemValor6 . ',' . $contagemValor7 . ',' . $contagemValor8;
}
function validaJogoAlgSoma($jogo) {
    $arrayJogo=explode(" ", $jogo);

    #calcula o jogo, se der 0 não vale a pena jogar
    $soma=0;
    $tamanhoArrayJogo = count($arrayJogo);
    for($i=0;$i<$tamanhoArrayJogo;$i++) {

        $soma = $soma + $arrayJogo[$i];
    }
    return $soma;
}

function validaJogoAlgP5($jogo) {
    $arrayJogo=explode(" ", $jogo);

    #calcula o jogo, se der  >= 5 não vale a pena jogar
    $resultado = 0;
    $tamanhoArrayJogo = count($arrayJogo);
    $tempTamanho = $tamanhoArrayJogo - 10;
    
    for($i=0;$i < $tamanhoArrayJogo; $i++) {
        
        $iAnterior= $i - 1;
        $valorAtual = $arrayJogo[$i];        
        if ($i == 0) {
            $iAnterior = $tamanhoArrayJogo - 1;
            $valorAtual = $valorAtual + 25;
        }
        $valorAnterior = $arrayJogo[$iAnterior];
        
        if ($resultado < $valorAtual - $valorAnterior) {
            $resultado = $valorAtual - $valorAnterior;
        }
        
    }
    return $resultado;
}
function validaJogoAlg891($jogo, $resultado) {
    $arrayJogo=explode(" ", $jogo);    
    $arrayJogo[count($arrayJogo) -1] = intval($arrayJogo[count($arrayJogo) -1]);
    
    $jogoPesquisa1 = explode(" ", $resultado);
    $diferencas = count(array_diff($jogoPesquisa1, $arrayJogo));
    $resultado = 15 - $diferencas;
    return $resultado;
}
  

function validaJogoAlgPI($jogo) {
    $arrayJogo=explode(" ", $jogo);
    
    #converte em pares e impares
    for ($i=0; $i < count($arrayJogo); $i++) {
        if ($arrayJogo[$i] % 2 == 0) {
            $arrayJogo[$i] = 0;
        } else {
            $arrayJogo[$i] = 1;
        }
        
    }
    
    #$arrayJogo[count($arrayJogo) -1] = intval($arrayJogo[count($arrayJogo) -1]);
    $contagemValor15 = 0;
    
    require './resultadoPI.php';
    $i=0;
        while ($i < count($resultadoPI)) {
            
            #$diferencas = count(array_diff($jogoPesquisa1, $arrayJogo));
            
            for($t=0; $t <= count($arrayJogo) -15 ; $t++ ) { #tamanho do jogo
                $igualdade = 0;

                for ($p=0 ; $p < 15 ; $p++){ #validacao
                        #echo $arrayJogo[$p + $t] . ' ' . $resultadoPI[$i][$p] . '<br />';
                        if ($arrayJogo[$p + $t] == $resultadoPI[$i][$p]) {
                            $igualdade++;
                        }
                }
                if ($igualdade == 15) {
                    $contagemValor15++;
                }
                #echo '<br />';
            }
            $i++;
        }
    #calcula o jogo, e retorna as diferenças
    return $contagemValor15;
}

function paginaInicial(){ ?>
        <script src="./layout-original/script.responsive.js"></script>
        <div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix">
                            <article class="art-post art-article">
                            <div class="art-postcontent art-postcontent-0 clearfix">

        <div class="art-content-layout-wrapper layout-item-0">
        <div class="art-content-layout layout-item-1">
        <div class="art-content-layout-row">
        <div class="art-layout-cell layout-item-2" style="width: 100%" >
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Sorte Loto Fácil</span></span></p>
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>
        </div>
        </div>
        </div>
        </div>





        <?php

        $jogos='';

        if (isset($_POST['acao'])) {
            if ($_POST['acao']=='checaJogo') {

                $jogos=$_POST['jogos'];
                $arrayJogo = explode("\n",$jogos);
                #echo count($arrayJogo);
                #$arrayJogo[0]=$jogos;

                echo '<div class="art-content-layout-wrapper layout-item-0">
                    <div class="art-content-layout layout-item-1">
                    <div class="art-content-layout-row">
                    <div class="art-layout-cell layout-item-3" style="width: 100%" >
                    <p><h2><b>Resultado</b></h2><br />
                    Sa aparecer "Evitar" em uma das colunas, as suas chances de obter sorte com o jogo são menores.<br /><br />';

                echo '<table><tr><th>Nº</th>
                    <th>Jogo</th>
                    <th title="Resultados que já sairam 14 números.">1</th>
                    <th title="Resultados que pegam apenas 5 números em mais de dois jogos.">2</th>
                    <th title="Utilizando a soma de cada resultado.">3</th>
                    <th title="Pulando menos que cinco números">4</th>
                    <th title="Que pegam o espelho par/impar completo de um resultado mais de duas vezes"> 5 </th>
                    <th title="Que pegaram 8, 9 ou 10 números do último jogo"> 6 </th>
                    </tr>';

                global $limitador;

                    #ultimo resultado
                    if (isset($_POST['ultimoResultado'])) {
                        #echo $_POST['ultimoResultado'];
                        $ultimoResultado = trataJogo($_POST['ultimoResultado']);
                    } else {
                        global $globalUltimoResultado;
                        $ultimoResultado = $globalUltimoResultado;
                    }

                for ($i=0; $i<count($arrayJogo) && $i < $limitador; $i++ ) {


                    $arrayJogo[$i] = trataJogo($arrayJogo[$i],0);

                    #validação
                    $numJogo = $i + 1;


                    echo '<tr>';
                    echo '<td>  <center>'. $numJogo .' </center></td>';

                    $valida = 1;
                    $valida=validaJogo($arrayJogo[$i]);
                    if ($valida==0) {
                        echo '<td>' . $arrayJogo[$i] . '</td> <td colspan=6>Jogo Incorreto</td>';
                    } else {
                        echo '<td>' . $arrayJogo[$i] .'</td>';



                    $calcularTamanhoJogo = count(explode(' ',($arrayJogo[$i]))) - 15;

                        #VERIFICA JOGO 14 e VERIFICA JOGO 15
                        echo '<td>';
                            $verificaJogoAlg14=validaJogoAlg14($arrayJogo[$i]);
                            $resultadoVJogoAlg14=explode(',',$verificaJogoAlg14);
                            if ($resultadoVJogoAlg14[0] >= 14) {
                                echo 'Evitar' ;
                            } else {
                                echo 'Jogar';
                            }
                            echo ' ' . $resultadoVJogoAlg14[0] ;
                        echo '</td>';

                        echo '<td>';
                        if ($resultadoVJogoAlg14[1+$calcularTamanhoJogo] > 2) {
                                echo 'Evitar' ;
                            } else {
                                echo 'Jogar';
                            }
                            echo ' ' . $resultadoVJogoAlg14[1+$calcularTamanhoJogo];
                        echo '</td>';


                        #VERIFICA JOGO SOMA
                        echo '<td>';
                            $verificaJogoAlgSoma=validaJogoAlgSoma($arrayJogo[$i]);
                            $calcularJogoAlgoSoma = $calcularTamanhoJogo * 12;
                            if ($verificaJogoAlgSoma < 161 + $calcularJogoAlgoSoma || $verificaJogoAlgSoma > 227  + $calcularJogoAlgoSoma) {
                                echo 'Evitar' ;
                            } else {
                                echo 'Jogar';
                            }
                            echo ' ' . $verificaJogoAlgSoma;

                        echo '</td>';


                        #VERIFICA JOGO PULAR 5 ...
                        echo '<td>';
                            $verificaJogoAlgP5=validaJogoAlgP5($arrayJogo[$i]);
                            if ($verificaJogoAlgP5 > 5 && $verificaJogoAlgP5 <= 11) {
                                echo 'Evitar ' ;
                                echo $verificaJogoAlgP5;
                            } elseif ($verificaJogoAlgP5 > 11) {
                                echo ' Erro ' ;

                            } else {
                                echo 'Jogar ';
                                echo $verificaJogoAlgP5;
                            }

                        echo '</td>';

                        #VERIFICA ESPELHO PAR IMPAR
                        echo '<td> <center>';

                            $verificaJogoAlgPI = validaJogoAlgPI($arrayJogo[$i], $ultimoResultado);
                            if ($verificaJogoAlgPI > 2 + ($calcularTamanhoJogo * 2)) {
                                echo 'Evitar' ;
                            } else {
                                echo 'Jogar';
                            }
                            echo ' ' . $verificaJogoAlgPI;

                        echo ' </center></td>';


                        #VERIFICA JOGO 8 9 10
                        echo '<td> <center>';

                            $verificaJogoAlg891=validaJogoAlg891($arrayJogo[$i], $ultimoResultado);
                            if ($verificaJogoAlg891 < (8 + $calcularTamanhoJogo) || $verificaJogoAlg891 > (10 + $calcularTamanhoJogo)) {
                                echo 'Evitar' ;
                            } else {
                                echo 'Jogar';
                            }
                            echo ' ' . $verificaJogoAlg891;

                        echo ' </center></td>';

                    }
                }
                echo '</table>';
                echo '</div></div></div></div>';
            }
        }
        ?>


        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >


            <p><b><h2>Consulte se o seu jogo está entre os mais de 1 MILHÃO de jogos com menos possibilidades de sair.</h2></b></p>
            <form name="consultaJogos" method="post">
            <p><br />
            Preencha um jogo em cada linha, e utilize jogos de 15 a 18 números.<br/>
            <p><textarea required name="jogos" maxlength="<?php global $limitador; echo $limitador * 55;?>" style="width: 100%" rows="7" placeholder="01 02 03 04 05 06 07 08 09 10 11 12 13 14 15"><?php echo $jogos; ?></textarea>
            <br /><br /><input type="hidden" name="acao" value="checaJogo">
            <input type="submit" value="            Checar Jogo              ">
            </p>
            </form>
            <br />
            1 - Resultados que já pegaram 14 e 15 números em um dos jogos sorteados.<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aproximadamente 184.000 jogos, com 5% de chances de não dar certo.<br /><br />
            2 - Resultados que pegaram apenas 5 números em mais de dois jogos sorteados.<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Estimam-se 200.000 jogos, com 5% de chances de não dar certo.<br /><br />
            3 - Utilizando a soma de cada resultado.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aproximadamente 205.000 jogos, com 10,83% de não dar certo.<br /><br />
            4 - Pulando menos que cinco números. Ex: Não pular de 1 ao 6 no resultado.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aproximadamente 380.000 jogos, com 10% de chances de não dar certo.<br /><br />
            5 - Jogos que pegam o espelho par/impar completo de um resultado mais de duas vezes.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aproximadamente 180.000 jogos, com 6% de chances de não dar certo.<br /><br />
            6 - Baseados no resultado do último jogo, repetindo 8, 9 ou 10 números.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quantidade intangível de jogos. Possibilidades de dar certo:<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8 números 23% - 9 números 32% - 10 números: 23%.<br /><br />

        </div></div></div></div>   


        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
        <p><b><h2>Regras</h2></b></p>
            <p>- Máximo de <?php global $limitador; echo $limitador; ?> jogos por vez.
            <br /><br />- Se der "Jogo Incorreto" ou "Erro" no resultado, verifique se o seu jogo foi preenchido corretamente.
            <br /><br />- Esse programa ajuda você a escolher os jogos que você deve evitar de jogar. Não nos responsabilizamos pelos seus jogos, nem pelos seus ganhos ou perdas.
        </div></div></div></div>

        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >

            <p><h2><b>Explicação:</b></h2></p>
            <p>Utilizando tecnologias e fortes algoritmos de computação, encontramos mais de 1 milhão de jogos que possuem chances menores de serem sorteados.<br></p>
            <p>As chances desses jogos não serem sorteados poderão variar de 85% a 95%, conforme a seleção de cada tipo de jogo acima. Evitando de jogar esses números sem sorte você melhorará as suas chances de ganhar algum prêmio.</p>
        <?php ?>    


        </div></div></div></div>                        



                            </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <?php
}
function paginaDownloads(){ ?>
<script src="./layout-original/script.responsive.js"></script>

<div class="art-sheet clearfix">
    <div class="art-layout-wrapper clearfix">
        <div class="art-content-layout">
            <div class="art-content-layout-row">
                <div class="art-layout-cell art-content clearfix">
                    <article class="art-post art-article">
                    <div class="art-postcontent art-postcontent-0 clearfix">
                        
                        
                        
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-2" style="width: 100%" >
                
    <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Downloads</span></span></p>
    <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>

</div></div></div></div>

                        
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
    <p><h2><b>Resultados da loto fácil</b></h2><br /><br />
    <a href="http://www1.caixa.gov.br/loterias/_arquivos/loterias/D_lotfac.zip">Resultados não organizados, direto do site da Caixa Econômica Federal</a></p>
</div></div></div></div>
                        
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
    <p><h2><b>Programas</b></h2><br /><br />
    <a href="./downloads/cologa3_5_6.zip">Cologa - Programa para gerar combinações e impreção dos volantes.</a><br />
    -> Após a instalação, extraia o programa para uma pasta do computador e execute o arquivo cologa.exe.</p>
</div></div></div></div>
                    
                    
                    </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php
   }
   
   
function paginaResultados(){
 require_once './resultado.php';
    
    $primeiroResultado = count($resultado) -19;
    $ultimoResultado = count($resultado);
    
        if(isset($_POST['primeiroResultado'])){
            $primeiroResultado = $_POST['primeiroResultado'];
        }
        if(isset($_POST['ultimoResultado'])){
            $ultimoResultado = $_POST['ultimoResultado'];
        }
        if ($primeiroResultado > count($resultado)) {
            $primeiroResultado = count($resultado);
        }
        if ($primeiroResultado < 1 ) {
            $primeiroResultado = 1;
        }
        if ($ultimoResultado > count($resultado)) {
            $ultimoResultado = count($resultado);
        }
        if ($ultimoResultado < 1 ) {
            $ultimoResultado = 1;
        }
        if ($primeiroResultado > $ultimoResultado) {
            $primeiroResultado = $ultimoResultado;
        }

    $modoOperacao = 0;
        if(isset($_POST['modoOperacao'])){
            $modoOperacao = $_POST['modoOperacao'];
        }
    
    ?>
<div class="art-sheet clearfix">
    <div class="art-layout-wrapper clearfix">
        <div class="art-content-layout">
            <div class="art-content-layout-row">
                <div class="art-layout-cell art-content clearfix">
                    <article class="art-post art-article">
                    <div class="art-postcontent art-postcontent-0 clearfix">
                        
                        
                        
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-2" style="width: 100%" >

                
    <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Resultados e Análise</span></span></p>
    <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>

    <p><h2><b><?php echo 'Exibindo '. ($ultimoResultado - $primeiroResultado +1) .' jogos de ' . $primeiroResultado .' à '. $ultimoResultado; ?>. </b></h2><br /><br />
    <?php
      
    
    echo '<center><table  style="background-color: #ffff99">';
    echo '<tr>';
    echo '<th>Jogo</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th>';
    if ($modoOperacao == 0) {echo '<th title="Média do Jogo anterior">Méd. J.Ant</th><th title="Soma dos valores do resultado">Soma</th>';}
    if ($modoOperacao == 1) {echo '<th>Par</th><th>Imp</th><th>Total</th>';}
    if ($modoOperacao == 2) {echo '';}
    
    echo '</tr>';
    
    
    $quantidadeValor = array (0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $quantidadeParImpar = array(0,0,0);
    $somaTotalFinal = 0;
    $mediaMediaJogoAnterior = 0;
    
    #Carraga Tabela
    for($i = ($primeiroResultado -1); $i < $ultimoResultado; $i++) {
        echo '<tr>';
        $iTemp = $i+1;
        echo '<td>'. $iTemp . '</td>';
        
        $resultadoSoma = 0;
        $resultadoPar = 0;
        $resultadoImpar = 0;
        
        if ($i == $primeiroResultado - 1) {
            $mediaJogoAnterior = validaJogoAlg891(implode(' ', $resultado[$i]), implode(' ', $resultado[$ultimoResultado - 1]));
        } else {
            $mediaJogoAnterior = validaJogoAlg891(implode(' ', $resultado[$i]), implode(' ', $resultado[$i-1]));
        }
        
        #cria a tabela
        for($j=1 ; $j <= 25 ; $j++) {
            echo '<td>';
            
            #verifica se o valor vai na tabela
            for ($k=0 ; $k < 15 ; $k++) {
                if ($resultado[$i][$k] == $j) {
                                       
                    #soma final
                    $l = $resultado[$i][$k] -1;
                    $quantidadeValor[$l] = $quantidadeValor[$l] + 1;
                    
                    $resultadoSoma = $resultadoSoma + $resultado[$i][$k];
                    
                    $lMod = $resultado[$i][$k] % 2;
                    if ($lMod == 0) {$resultadoPar++;($quantidadeParImpar[0]++);} else {$resultadoImpar++;($quantidadeParImpar[1]++);}
                    
                    #mostra o valor na tabela
                    if($modoOperacao==0){echo $resultado[$i][$k];}
                    if($modoOperacao==1){if ($lMod == 0) {echo '<font color=green>PR</font>';} else {echo '<font color=orange>IM</font>';}}
                    if($modoOperacao==2){echo $resultado[$i][$k];}
                    
                    
                }
                
            }
            echo '</td>';
        }
        
        $somaTotalFinal = ($somaTotalFinal + $resultadoSoma);
        $mediaMediaJogoAnterior = $mediaMediaJogoAnterior + $mediaJogoAnterior;
        
        if ($modoOperacao == 0) {echo '<td><center>' . $mediaJogoAnterior . '</center></td>';}
        if ($modoOperacao == 0) {echo '<td><center>' . $resultadoSoma . '</center></td>';}
        
        $resultadoParImpar = $resultadoImpar - $resultadoPar;
        if ($modoOperacao == 1) {echo '<td>' . $resultadoPar . '</td><td>' . $resultadoImpar . '</td><td>' . $resultadoParImpar . '</td>';}
        
        echo '</tr>';
    }
    
    #Termina Tabela
    if ($modoOperacao == 0 || $modoOperacao == 1) {
        echo '<tr>';
        echo '<td><b>Soma</b></td>';

        #Valores totais no final da tabela
        for($l=0 ; $l < 25 ; $l++) {
            echo '<td><b>'.$quantidadeValor[$l].'</b></td>';
            #$somaTotalFinal = $somaTotalFinal + $quantidadeValor[$l];
        }        
    }

    if ($modoOperacao == 0) {
        echo '<td><b><center>'. substr($mediaMediaJogoAnterior / ($ultimoResultado +1 - $primeiroResultado),0,4) .'</center></b></td>';
        echo '<td><b><center>'.$somaTotalFinal.'</center></b></td>';
    }
    
    
    if ($modoOperacao == 1) {
        echo '<td><b>'.$quantidadeParImpar[0].'</b></td>';
        echo '<td><b>'.$quantidadeParImpar[1].'</b></td>';
        echo '<td><b>'.($quantidadeParImpar[1] - $quantidadeParImpar[0]).'</b></td>';
    }
    
    echo '</tr>';
    #print($quantidadeValor);
    echo '</table></center>';
    ?>
    
    <form name="quantidadeJogos" method="post">
    <input type="hidden" name="acao" value="resultados">
    
    <br />

</div></div></div></div>
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >    
    
    <p>Mostrar Jogos entre 
    <input type="number" value="<?php echo $primeiroResultado ;?>" name="primeiroResultado">
    e
    <input type="number" value="<?php echo $ultimoResultado ;?>" name="ultimoResultado">
    .
    
    Modo de operação: 
    <select name="modoOperacao">
        <option value="2" <?php if($modoOperacao==2){echo 'selected';}?> >Resultados Simples</option>
        <option value="0" <?php if($modoOperacao==0){echo 'selected';}?> >Resultados Avançados</option>
        <option value="1" <?php if($modoOperacao==1){echo 'selected';}?> >Pares e Impares</option>
    </select>
    <br /><input type="submit" value="   Alterar    "></p>
    </form>
    
</div></div></div></div>
                 
                        
                    
                    
                    </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php
   }
   
function configCarregarResultados(){
    ?>



<script src="./layout-original/script.responsive.js"></script>

<div class="art-sheet clearfix"><div class="art-layout-wrapper clearfix"><div class="art-content-layout"><div class="art-content-layout-row"><div class="art-layout-cell art-content clearfix"><article class="art-post art-article"><div class="art-postcontent art-postcontent-0 clearfix">
                        
    <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-2" style="width: 100%" >
        <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Edição de resultados</span></span></p>
        <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>
    </div></div></div></div>
                            
                            
<?php
$senhaResultadosValidar = 'invalida';

if (isset($_POST['senhaResultados'])) {
    $senhaResultadosValidar = $_POST['senhaResultados'];
}
if (isset($_POST['jogos'])) {
    $senhaResultadosValidar = 'sorte';
}

if ($senhaResultadosValidar != 'sorte') {
    ?>
    <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
                    <form method="post">
                        <h2>Acesso Restrito. Informe a sua senha.</h2>
                        <br />
                        <input required type="password" name="senhaResultados"> <input type="submit" value="   Acessar   ">
                        <br /><br />
                        
                    </form>
    </div></div></div></div>                        
    <?php
} else {


if (isset($_POST['jogos'])) {
    echo '<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >';
    
    $conteudoArquivo = '<?php ';
    $conteudoArquivoPI = '<?php ';
    
    #echo '<?php';
    $resultadoNovo = explode("\r\n",  $_POST['jogos']);
    
    for($i = 0; $i < count($resultadoNovo); $i++) {
        $resultadoNovo[$i] = trataJogo($resultadoNovo[$i]);
        
        if ($i == count($resultadoNovo) -1 ) {
            #salva ultimo resultado
            $fp = fopen("./ultimoResultado.php", "w");
            fwrite($fp, '<?php $globalUltimoResultado = ' ."'". $resultadoNovo[$i] ."'". ';');
        }
        
        $resultadoNovo[$i] = explode(' ', $resultadoNovo[$i]);
        
        for($p=0; $p < count($resultadoNovo[$i]); $p++) {
            if ($resultadoNovo[$i][$p] % 2 == 0) {
                $resultadoNovoPI[$i][$p] = 0;
            } else {
                $resultadoNovoPI[$i][$p] = 1;
            }
        }
        
        $resultadoNovo[$i] = implode(',', $resultadoNovo[$i]);
        $resultadoNovoPI[$i] = implode(',', $resultadoNovoPI[$i]);
        
        $conteudoArquivo .= '$resultado[' . $i .'] = array('. $resultadoNovo[$i] . '); ';
        $conteudoArquivoPI .= '$resultadoPI[' . $i .'] = array('. ($resultadoNovoPI[$i]) . '); ';

    }
    
    $fp = fopen("./resultado.php", "w");
    fwrite($fp, $conteudoArquivo);
    fclose($fp);
    
    $fp = fopen("./resultadoPI.php", "w");
    fwrite($fp, $conteudoArquivoPI);
    fclose($fp);
    
    echo '<h2><b>Os resultados foram salvos com sucesso.</b></h2>';
    echo '</div></div></div></div>';
    
}
    require_once './resultado.php';
?>                            


    <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >    

        <form name="alterarJogos" method="post">
        <input type="hidden" name="acao" value="ConfigCarregarResultados">
            <p>
            <h2>Alterar Resultados </h2>
            <br />Digite os resultados na caixa Abaixo, um em cada linha, em ordem do primeiro para o ultimo, e em seguida clique em Salvar Resultados.<br />
            <br />Não deixe linhas vázias, e cuide para não deixar a ultima linha em branco.<br />
                <br /><input type="submit" value="   Salvar Resultados    "><br />
                <br />
                <textarea required name="jogos" style="width: 100%" rows="30" placeholder="01 02 03 04 05 06 07 08 09 10 11 12 13 14 15"><?php

                    for($i=0 ; $i<count($resultado) ; $i++) {
                        echo implode(' ', $resultado[$i]);
                        if ($i != count($resultado) -1 ) {
                             echo "\r\n";
                        }
                    }
                    
                ?></textarea>
            </p>

            <br /><input type="submit" value="   Salvar Resultados    "></p>
        </form>
    </div></div></div></div>
                 
                        
</div></article></div></div></div></div></div>

    <?php
}#final do ELSE de ACESSO RESTRITO COM SENHA
}



function paginaConferencia(){
?>

    <script src="./layout-original/script.responsive.js"></script>

    <div class="art-sheet clearfix"><div class="art-layout-wrapper clearfix"><div class="art-content-layout"><div class="art-content-layout-row"><div class="art-layout-cell art-content clearfix"><article class="art-post art-article"><div class="art-postcontent art-postcontent-0 clearfix">

        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-2" style="width: 100%" >
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Confira seus jogos</span></span></p>
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>
        </div></div></div></div>


    <?php

    require_once './resultado.php';

    if (isset($_POST['acao'])) {
        if ($_POST['acao']=='conferirResultados') {
            
            $jogoConferir = $_POST['jogo'];
            
            if ($jogoConferir > count($resultado)){
                $jogoConferir = count($resultado);
            }
            if ($jogoConferir < 1){
                $jogoConferir = 1;
            }
            
            
            $jogoConferir = $jogoConferir - 1;
            $jogoConferirResultado = implode(' ', $resultado[$jogoConferir]);
            $arrayJogo=$_POST['jogos'];
            $arrayJogo = explode("\n",$arrayJogo);
            
            echo '<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >';
            echo '<h2><b>Conferência dos Jogos - Resultado ' . ($jogoConferir + 1). ' </b>';
            echo '<br />' . implode(' ', $resultado[$jogoConferir]).'</h2></b>';
            echo '<br />';
            echo '<br />';
            
            echo '<table>';
            echo '<tr>';
            echo '<th>Nº</th><th>Jogo</th><th>Resultado</th>';
            echo '</tr>';

            for($i = 0 ; $i < count($arrayJogo); $i++) {
                
                $arrayJogo[$i] = trataJogo($arrayJogo[$i]);
                $jogoValido = validajogo($arrayJogo[$i]);
                $comparaJogo = 0;
                
                echo '<tr>';
                    if ($jogoValido == 1) {
                        $comparaJogo = validaJogoAlg891($arrayJogo[$i], $jogoConferirResultado);
                        if ($comparaJogo >= 11) {
                            echo '<td><font color=blue><b>' . ($i + 1) . '</b></font></td>';
                            echo '<td><font color=blue><b>' . $arrayJogo[$i] . '</b></font></td>'; 
                            echo '<td><center><font color=blue><b>' . $comparaJogo . '</b></font></center></td>'; 
                        } else {
                            echo '<td>' . ($i + 1) . '</td>';
                            echo '<td>' . $arrayJogo[$i] . '</td>'; 
                            echo '<td><center>' . $comparaJogo . '</center></td>'; 
                        }
                    } else {
                        echo '<td>' . ($i + 1) . '</td>'; 
                        echo '<td>Jogo Incorreto</td>'; 
                        echo '<td></td>'; 
                    }
                echo '</tr>';
                
            }
            
            echo '</table>';
            
            
            echo '</div></div></div></div>';

        }
    }
    ?>                            


        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >    

            <form name="alterarJogos" method="post">
            <input type="hidden" name="acao" value="conferirResultados">
                <p>
                <h2>Conferência de Resultados </h2>
                <br />Digite os resultados na caixa Abaixo, um em cada linha, em ordem do primeiro para o ultimo, e em seguida clique em "Conferir Resultados".<br />
                <br />Não deixe linhas vázias, e cuide para não deixar a ultima linha em branco.<br />
                <br />Jogo: <input type="number" name="jogo" value="<?php if (isset($_POST['jogo'])) {echo $jogoConferir +1;} else { echo(count($resultado));} ?>">
                    <input type="submit" value="   Conferir Resultados    "><br />
                    <br />
                    <textarea required name="jogos" style="width: 100%" rows="10" placeholder="01 02 03 04 05 06 07 08 09 10 11 12 13 14 15"><?php

                        if (isset($_POST['jogos'])) {echo $_POST['jogos'];}

                    ?></textarea>
                </p><input type="submit" value="   Conferir Resultados    "></p>
            </form>
        </div></div></div></div>


    </div></article></div></div></div></div></div>

    <?php
}
function paginaPrevisao(){
?>


    <div class="art-sheet clearfix"><div class="art-layout-wrapper clearfix"><div class="art-content-layout"><div class="art-content-layout-row"><div class="art-layout-cell art-content clearfix"><article class="art-post art-article"><div class="art-postcontent art-postcontent-0 clearfix">

        <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-2" style="width: 100%" >
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px; text-align: center;"><img width="87" height="88" alt="" src="layout-original/images/logo-lf-2.png"><span style="color: rgb(225, 228, 221);"><span style="font-weight: bold; font-family: 'Lucida Sans Unicode'; font-size: 48px; text-shadow: #171717 1px 0px 0px, #171717 -1px 0px 0px, #171717 0px -1px 0px, #171717 0px 1px 0px, rgba(0, 0, 0, 0.984375) 0px 0px 10px; color: #F5F7F2;">Previsão de Jogos</span></span></p>
            <p style="margin-top: 0px; margin-right: 5px; margin-bottom: 0px; margin-left: 5px;"><br></p>
        </div></div></div></div>

                                
                                
    <div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
    <h2>Análise circular de resultados</h2>
    <br />Previsão para o próximo jogo baseada no último resultado cadastrado no site, em relação a sequência de números que deverão ser sorteados. 
    <h3>Último Resultado: <?php global $globalUltimoResultado; echo $globalUltimoResultado;?></h3>
    <br /><br />
    
     <?php
    $casas = 3;
    $casaInicial = 0;
    $casaFinal = 14;
    
    if(isset($_POST['casas'])) { $casas = $_POST['casas'];}
    if(isset($_POST['casaInicial'])) { $casaInicial = $_POST['casaInicial'] -1;}
    if(isset($_POST['casaFinal'])) { $casaFinal = $_POST['casaFinal'] -1 ;}
    ?>
    
    <form method="post">
        <div style="float: left; width: 25%">Casas a validar:<br /> <input required type="number" name="casas" value="<?php echo $casas; ?>"/></div>
        <div style="float: left; width: 25%">Casa Inicial:<br /><input required type="number" name="casaInicial" value="<?php echo $casaInicial +1; ?>"/></div>
        <div style="float: left; width: 25%">Casa Final:<br /><input required type="number" name="casaFinal" value="<?php echo $casaFinal +1; ?>"/></div>
        <div style="float: left; width: 25%"><br /><input type="submit" value="       Processar       " /></div>
        <br /><br />
    </form>
</div></div></div></div>
<div class="art-content-layout-wrapper layout-item-0"><div class="art-content-layout layout-item-1"><div class="art-content-layout-row"><div class="art-layout-cell layout-item-3" style="width: 100%" >
<div style="float: left; width: 33%">
  <?php
    echo '<h2>Múltiplas posições</h2>';
    $previsaoCircular = previsaoAnaliseCircular($casaInicial, $casaFinal, $casas);
    
    
    echo '<table  style="background-color: #ffff99">';
    echo '<tr>';
    echo '<th>Repetições</th><th>Casas<br />Posições</th><th>Valores</th>';
    echo '</tr>';
    
    for($y = 0 ; $y < count($previsaoCircular) ; $y++) {
        echo '<tr>';
            $yTemp = explode(',', $previsaoCircular[$y]);
            $yTemp[1]++;
            $yTemp[2]++;
            
            echo '<td><b><center>' . $yTemp[0] . '</center></b></td>';
            echo '<td>' . $yTemp[1] . ' a ' . $yTemp[2] . '</td>';
            echo '<td>' . $yTemp[3] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    
    ?>
</div>
<div style="float: left; width: 33%">
<h2>Posição por valor</h2>
<?php
    echo '<table  style="background-color: #ffff99">';
    echo '<tr>';
    echo '<th>Casa</th><th>Valor</th><th>Chances</th>';
    echo '</tr>';
    
    $analisePosicao = previsaoAnalisePosicao();
    
    
    for($y = 0 ; $y <= 3000 ; $y++) {
        for($x = 0 ; $x < 3000 ; $x++) {
            if(isset($analisePosicao[$y][$x]) ) {
                
                $casaY = $y +1;
                echo '<td><b><center>' . $casaY . '</center></b></td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' .$analisePosicao[$y][$x] . '</td>';
                echo '</tr>';                
            }
        }
    }
    
    echo '</table>';
        
?>
</div>
                
<div style="float: left; width: 34%">
<h2>Quantidade por número</h2>
<?php
    echo '<table  style="background-color: #ffff99">';
    echo '<tr>';
    echo '<th>Valor</th><th>Chances</th><th>Casas</th><th>Total<br />Casas</th>';
    echo '</tr>';
    
    $quantidadeNumero = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    $quantidadeNumeroCasa = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    for($y = 0 ; $y <= 3000 ; $y++) {
            for($x = 0 ; $x <= 3000 ; $x++) {
                if(isset($analisePosicao[$y][$x]) ) {
                    $quantidadeNumero[$x] = $quantidadeNumero[$x] + $analisePosicao[$y][$x];
                    $yCasa = $y + 1;
                    $quantidadeNumeroCasa[$x] = $quantidadeNumeroCasa[$x] . ' ' . $yCasa;
                }
            }
    }
    for($y = 1 ; $y < count($quantidadeNumero) ; $y++) {
        echo '<tr>';
            echo '<td><b><center>' . $y . '</center></b></td>';
            echo '<td>' . $quantidadeNumero[$y] . '</td>';
            echo '<td>' . $quantidadeNumeroCasa[$y] . '</td>';
            $totalCasas = count(explode(' ', $quantidadeNumeroCasa[$y])) -1;
            echo '<td>' . $totalCasas . '</td>';
        echo '</tr>';
    }
    
    
    
    
    echo '</table>';
    ?>
    
    </div></div></div></div>
    </div></article></div></div></div></div></div>

    <?php
}

function previsaoAnaliseCircular($inicial, $final , $tamanho) { #tamanho das casas, 1 posições fixas, 0 não
    require'./resultado.php';
    
    if ($final > 14) { $final = 14;}
    if ($final < $inicial) { $final = $inicial;}
    if ($inicial < 0) { $inicial = 0;}
    #$inicial = 0;
    #$final = 14;
    
    #INICIA A PROCURA POR RESULTADOS
    $resultadoProcurar = $resultado[count($resultado) -1];
    $resultadosEncontrados = 0;
    
    #FOR QUE PERCORRE TODOS OS RESULTADOS i<jogos-1
    for($i = 0; $i < count($resultado) -1; $i++) {
    #for($i = 0; $i < 1; $i++) {

        #FOR QUE PERCORRE UM RESULTADO PROCURANDO COMBINACOES
        for($j = $inicial; $j <= $final; $j++) {

            $encontrado = 0;
            #FOR QUE PERCORRE AS CASAS DE UM RESULTADO PROCURANDO COMBINACOES
            for($k = $j; $k < $j + $tamanho; $k++) {
                
                $kProc = $k;
                if ($k > 14) {
                    $kProc = $k - 15;
                } 
                $jProc = $j;
                
                if ($resultadoProcurar[$kProc] == $resultado[$i][$kProc]) {
                    $encontrado++;

                }

                
                #carrega os valores encontrados na variavel - $i jogo, $j posicao inicial $kProc posicao final
                if ($encontrado == $tamanho){

                    $campoI = $j;
                    $campoF = $kProc;
                    
                    
                    if ($campoI > 14) {
                        $campoI = $campoI -15;
                    }
                    if ($campoF > 14) {
                        $campoF = $campoF -15;
                    }
                    
                    $resultFuncao[$resultadosEncontrados] = $campoI . ' ' . $campoF .' ' . $i;
                    $resultadosEncontrados++;

                }
            }

            
        }
    }          
    
       
    #realiza as acoes caso encontradas combinacoes

    #ORDENA O ARRAY DE RESULTADOS
    array_multisort($resultFuncao);
    
    #TENDO OS RESULTADOS, VERIFICA...
    
    for ($t = 0 ; $t < count($resultFuncao) ; $t++) {
        $tTemp = explode(' ', $resultFuncao[$t]);
        
        $uInicio = $tTemp[0]; $uFim = $tTemp[1];
        if ($uFim < $uInicio) {$uFim = $uFim + 15; }
        
        for($u = $uInicio ; $u<= $uFim; $u++) {
            
            $uProc = $u;
            if ($u > 14) {
                $uProc = $u - 15;
            } 
            
            if (isset($resultAnalise[$t])) {
                $resultAnalise[$t] .= ' ' .  $resultado[$tTemp[2]+1][$uProc];
            } else {
                $resultAnalise[$t] = $tTemp[0]. ',' . $tTemp[1] . ',' . $resultado[$tTemp[2]+1][$uProc];
            }
            
        }

    }
    
    #ORDENA O ARRAY DE RESULTADOS DA ANALISE
    array_multisort($resultAnalise);
    
    
    #CONTA QUANTAS VEZES SAIU NA MESMA POSICAO
    for($v = 0 ; $v < count($resultAnalise) ; $v++) { #VETOR PRIMEIRO VALOR
        $contagemV = 0;
        
        for($x = 0 ; $x < count($resultAnalise) ; $x++) {
            if ($resultAnalise[$v] == $resultAnalise[$x]) {
                $contunarX = 0;
                if ($v >= $x) {
                    $contagemV++;
                } else {
                    $contunarX = 1;
                }
            }
        }
        if ($contunarX == 0){
            $resultFinal[$v] = $contagemV . ',' . $resultAnalise[$v];
            $contagemFinalTemp[$v] = $contagemV;
        }
    }
        array_multisort($contagemFinalTemp,SORT_DESC, $resultFinal,SORT_DESC);
        
        #for($y = 0 ; $y < count($resultFinal) ; $y++) { #VETOR PRIMEIRO VALOR
        #    echo $resultFinal[$y] . '<br />';
        #}

        return $resultFinal;
}
function previsaoAnalisePosicao() { #tamanho das casas, 1 posições fixas, 0 não
    require'./resultado.php';
    
    #COLETA AS POSICOES DO ULTIMO JOGO
    $ultResultado = count($resultado) -1;
    
    for($i = 0; $i < count($resultado[$ultResultado]); $i++) {
        $campo[$i] = $resultado[$ultResultado][$i] ;
        #echo $campo[$i] . '<br />';
    }
    
    #PROCURA AS POSICOES EM TODOS OS JOGOS
    for($i = 0; $i < count($resultado) -1; $i++) { #percorre jogos i=jogo
        for($j = 0; $j < count($resultado[$i]); $j++) { #compara jogos j=casa
            if ($resultado[$i][$j] == $campo[$j]) {
                
                if (isset($casaValorChance[$j][$resultado[$i+1][$j]])){ #ENCONTRADO O VALOR JÁ PEGA A PREVISAO
                    $casaValorChance[$j][$resultado[$i+1][$j]]++;
                } else {
                    $casaValorChance[$j][$resultado[$i+1][$j]]= 1;
                }
            }
        }
    }
    
    echo '<pre>';
    return $casaValorChance;
}