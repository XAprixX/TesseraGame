<?php
session_start(); // Inicie a sessão
include_once("conexao.php");


if (isset($_SESSION['user_id'])) {
    // O usuário está autenticado, recupere o ID do usuário da sessão
    $userId = $_SESSION['user_id'];
} else {
    // Redirecione o usuário ou retorne uma mensagem de erro
    echo "erro";
}

// Consulta SQL para obter os valores de money, hunger, happiness e wisdom
$getStatsQuery = "SELECT money, hunger, happiness, wisdom, Job FROM usuario WHERE ID = ?";
$stmt = $conn->prepare($getStatsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$statsResult = $stmt->get_result();

if ($statsResult->num_rows > 0) {
  $statsRow = $statsResult->fetch_assoc();
  $money = $statsRow['money'];
  $hunger = $statsRow['hunger'];
  $happiness = $statsRow['happiness'];
  $wisdom = $statsRow['wisdom'];
  $job = $statsRow['Job'];

  // Após recuperar os valores do banco de dados
  $_SESSION['hunger'] = $hunger;
  $_SESSION['happiness'] = $happiness;
  $_SESSION['job'] = $job;

  echo "<script>var fome = " . (isset($_SESSION['hunger']) ? $_SESSION['hunger'] : 0) . ";</script>";
  echo "<script>var happiness = " . (isset($_SESSION['happiness']) ? $_SESSION['happiness'] : 0) . ";</script>";
  echo "<script>var job = '" . (isset($_SESSION['job']) ? $_SESSION['job'] : '') . "';</script>";

} else {
  echo "Erro ao obter os valores!";
}
if (!$statsResult) {
  echo "Erro ao executar a consulta: " . $conn->error;
}

echo "<script>var money = $money;</script>";
echo "<script>var happiness = $happiness;</script>";
echo "<script>var hunger = $hunger;</script>";
echo "<script>var Job =  '$job' </script>";
echo "<script>var wisdom = $wisdom;</script>";

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" media="screen">
    <title>Mega-sena</title>
</head>
<body>
    <div class="alternarTema">
        <label class="switch">
            <input type="checkbox" id="checkbox">
            <span class="slider round"></span>
        </label>
    </div>
    <div class="container">
        <header>
            <img src="https://i.postimg.cc/tRFn2v50/mega-sena-logo.png" alt="logotipo mega-sena">
        </header>
        <main>
            <div>
                <button onclick="selecionarNumeros(1)" id="num_1">01</button>
                <button onclick="selecionarNumeros(2)" id="num_2">02</button>
                <button onclick="selecionarNumeros(3)" id="num_3">03</button>
                <button onclick="selecionarNumeros(4)" id="num_4">04</button>
                <button onclick="selecionarNumeros(5)" id="num_5">05</button>
                <button onclick="selecionarNumeros(6)" id="num_6">06</button>
                <button onclick="selecionarNumeros(7)" id="num_7">07</button>
                <button onclick="selecionarNumeros(8)" id="num_8">08</button>
                <button onclick="selecionarNumeros(9)" id="num_9">09</button>
                <button onclick="selecionarNumeros(10)" id="num_10">10</button>
            </div>
            <div>
                <button onclick="selecionarNumeros(11)" id="num_11">11</button>
                <button onclick="selecionarNumeros(12)" id="num_12">12</button>
                <button onclick="selecionarNumeros(13)" id="num_13">13</button>
                <button onclick="selecionarNumeros(14)" id="num_14">14</button>
                <button onclick="selecionarNumeros(15)" id="num_15">15</button>
                <button onclick="selecionarNumeros(16)" id="num_16">16</button>
                <button onclick="selecionarNumeros(17)" id="num_17">17</button>
                <button onclick="selecionarNumeros(18)" id="num_18">18</button>
                <button onclick="selecionarNumeros(19)" id="num_19">19</button>
                <button onclick="selecionarNumeros(20)" id="num_20">20</button>
            </div>
            <div>
                <button onclick="selecionarNumeros(21)" id="num_21">21</button>
                <button onclick="selecionarNumeros(22)" id="num_22">22</button>
                <button onclick="selecionarNumeros(23)" id="num_23">23</button>
                <button onclick="selecionarNumeros(24)" id="num_24">24</button>
                <button onclick="selecionarNumeros(25)" id="num_25">25</button>
                <button onclick="selecionarNumeros(26)" id="num_26">26</button>
                <button onclick="selecionarNumeros(27)" id="num_27">27</button>
                <button onclick="selecionarNumeros(28)" id="num_28">28</button>
                <button onclick="selecionarNumeros(29)" id="num_29">29</button>
                <button onclick="selecionarNumeros(30)" id="num_30">30</button>
            </div>
            <div>
                <button onclick="selecionarNumeros(31)" id="num_31">31</button>
                <button onclick="selecionarNumeros(32)" id="num_32">32</button>
                <button onclick="selecionarNumeros(33)" id="num_33">33</button>
                <button onclick="selecionarNumeros(34)" id="num_34">34</button>
                <button onclick="selecionarNumeros(35)" id="num_35">35</button>
                <button onclick="selecionarNumeros(36)" id="num_36">36</button>
                <button onclick="selecionarNumeros(37)" id="num_37">37</button>
                <button onclick="selecionarNumeros(38)" id="num_38">38</button>
                <button onclick="selecionarNumeros(39)" id="num_39">39</button>
                <button onclick="selecionarNumeros(40)" id="num_40">40</button>
            </div>
            <div>
                <button onclick="selecionarNumeros(41)" id="num_41">41</button>
                <button onclick="selecionarNumeros(42)" id="num_42">42</button>
                <button onclick="selecionarNumeros(43)" id="num_43">43</button>
                <button onclick="selecionarNumeros(44)" id="num_44">44</button>
                <button onclick="selecionarNumeros(45)" id="num_45">45</button>
                <button onclick="selecionarNumeros(46)" id="num_46">46</button>
                <button onclick="selecionarNumeros(47)" id="num_47">47</button>
                <button onclick="selecionarNumeros(48)" id="num_48">48</button>
                <button onclick="selecionarNumeros(49)" id="num_49">49</button>
                <button onclick="selecionarNumeros(50)" id="num_50">50</button>
            </div>
            <div>
                <button onclick="selecionarNumeros(51)" id="num_51">51</button>
                <button onclick="selecionarNumeros(52)" id="num_52">52</button>
                <button onclick="selecionarNumeros(53)" id="num_53">53</button>
                <button onclick="selecionarNumeros(54)" id="num_54">54</button>
                <button onclick="selecionarNumeros(55)" id="num_55">55</button>
                <button onclick="selecionarNumeros(56)" id="num_56">56</button>
                <button onclick="selecionarNumeros(57)" id="num_57">57</button>
                <button onclick="selecionarNumeros(58)" id="num_58">58</button>
                <button onclick="selecionarNumeros(59)" id="num_59">59</button>
                <button onclick="selecionarNumeros(60)" id="num_60">60</button>
            </div>
        </main>
        <button class="btn" id="btnApostar" onclick="apostar(<?php echo $userId; ?>)">Apostar</button>
        <section class="resultado" id="resultado"></section>
        <footer>
            <div id="valor"></div>
            <div id="qtdNumeros"></div>
            <div id="acertos"></div>
        </footer>
    </div>
    <button class="btn" id="btnReiniciar">Reiniciar</button>
    <script src="js/index.js" type="text/javascript"></script>
</body>
</html>